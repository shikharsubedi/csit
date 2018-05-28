<?php

use user\models\User,
	Doctrine\Common\Util\Debug;
	
class Current_User {
	private static $user;
	
	private static $permissions = array();

	private function __construct() { 
	
			parent::__construct();
			
			}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
			$CI->load->library('session');

			if (!$user_id = $CI->session->userdata('user_id')) {
				return FALSE;
			}

			$query = $CI->doctrine->em->createQuery("SELECT DISTINCT u FROM user\models\User u WHERE u.id = '$user_id'");
			$user = $query->getResult();
			
			if(count($user) == 0) return FALSE;
			
			self::$user =& $user[0];
		}

		return self::$user;
	}

	public static function login($username, $password ,$admin_email=NULL ,$admin_name = NULL) {
		
		$CI =& get_instance();
		
		$query = $CI->doctrine->em->createQuery("SELECT u FROM user\models\User u WHERE u.username = '$username'");
		$user = $query->getResult();
		
		
		if($user)
		{
			$user = $user[0];
			if($user->getPassword() == md5($password) && $user->getStatus() == STATUS_ACTIVE)
			{
					$user->setLastLoginDate();
					$user->setLoginAttempts(NULL);
					$CI->doctrine->em->persist($user);
					$CI->doctrine->em->flush();	
				$CI->load->library('session');
				$CI->session->set_userdata('user_id',$user->id());
				self::$user = $user;
					
				return TRUE;
			}/**/
			
				if($user->getPassword()!= md5($password) && $user->getStatus() == STATUS_ACTIVE){
				$last_login = $user->getLastLoginDate()->format('Y-m-d H:i:s') ;
				$end = $user->getLastLoginDate();
				$date = new \DateTime();
				
				$present_login = $date->format('Y-m-d H:i:s');
				
					$out_in_array=false;
					$intervalo = date_diff(date_create(),date_create($last_login));
					$out = $intervalo->format("Days:%d,Hours:%H");
					$a_out = array();
					array_walk(explode(',',$out),
					function($val,$key) use(&$a_out){
						$v=explode(':',$val);
						$a_out[$v[0]] = $v[1];
      				  });
				
				$no_of_att = ($a_out['Days']>=1) ? NULL : $user->getLoginAttempts() ;
				$forfresh =  ($a_out['Days']>=1) ? NULL : 1 ;
				$setAttempts = ($no_of_att>0) ? $no_of_att+1 : $forfresh ; 
				
				if($no_of_att < 3){
					$user->setLastLoginDate();      
					$user->setLoginAttempts($setAttempts);
					$CI->doctrine->em->persist($user);
					$CI->doctrine->em->flush();
					if($no_of_att==2){
						echo "<div align='center'>Wrong Password !! One More Attempt,Your Username Will Be Blocked....!!! 
						<a href=''>Back</a> </div>"  ; exit;
						
						}
				}	
				else {
				/********* Set New Password**********/
				$CI->load->helper('string');
				$new_password = random_string('alpha',8);
				$user->setPassword(md5($new_password));
				$CI->doctrine->em->persist($user);
				$CI->doctrine->em->flush();
				/*******************************/
				
				/************ Send Email *********/	
				$CI->load->library('email');
				$message = "Your password has been reset.<br/><br />
				Your new password is $new_password.<br /><br />
				Click <a href='".site_url('console/login')."'>here</a> to log in.";
				$CI->email->from($admin_email,$admin_name);
				$CI->email->to($user->getEmail()); 
				
				$subject = $admin_name.' :: Password Assistance';
				
				$CI->email->subject($subject);
				
				$CI->email->message($message);	
				$CI->email->send();
				
				/**** Set Attempts to NULL ******/
				$user->setLoginAttempts(NULL);
				$CI->doctrine->em->persist($user);
				$CI->doctrine->em->flush();
				/********************************/
				
				echo "<div align='center'>After Several Attempts Of Password Entry,Your Username Is  Blocked....!!! Please Check Your Email To Reset The Password. </div>"  ; exit;
					}
				
			}
		
		}
		
		return FALSE;

	}
	
	public static function can($permission)
	{
		$CI =& get_instance();
		$CI->load->library('session');

		if (!$user_id = $CI->session->userdata('user_id')) {
			return FALSE;
		}
		$permissions = array();
		
		//check if we have it cached
		//if(isset(self::$permissions[$permission]))
			//return TRUE;
			
		//we cannot cache the permissions as when an admin is editing the permissions then the changes dont come in action immediately if we cache it
		
		
		foreach(self::user()->getGroups() as $ur){
			//Debug::dump($ur);
			foreach($ur->getPermissions() as $rp){
				$p = strtolower($rp->getName());
				$permissions[$p] = TRUE;
				//Debug::dump($rp);		
			}
		}
		//check if multiple permissions were sent
		$_permission = explode('|',$permission);
		//show_pre($permissions);
		//show_pre($_permission);
		if(count($_permission) == 1)
			return isset($permissions[$permission]);
		else{
			foreach($_permission as $_p)
			{
				$_p = trim($_p);
				if(!isset($permissions[$_p])) 
					return FALSE;
			}
			return TRUE;
		}
				
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}
