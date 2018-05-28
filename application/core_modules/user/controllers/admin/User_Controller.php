<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Controller extends Admin_Controller {
	
	public function __construct()
	{
		$this->mainmenu = MAINMENU_USER;
		parent::__construct();
		if(!user_access('administer user'))
			admin_redirect('dashboard');
		
		
		$this->load->library('form_validation');
		$this->breadcrumb->append_crumb('Users and Groups', admin_url('user'));
   }
	   
	public function index($offset = 0)
	{
		$per_page = 10;
		$repo = $this->doctrine->em->getRepository('user\models\User');
		$users = & $repo->getUsers($offset,$per_page);
		
		if($users['total'] > $per_page)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = admin_url("user/index");
			$config['total_rows'] = $numUser;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 4;
			$config['prev_link'] = 'Previous';
			$config['next_link'] = 'Next';
			
			$this->pagination->initialize($config);
			$this->templatedata['pagination'] = $this->pagination->create_links();
		}
		
		$this->templatedata['maincontent'] = 'user/admin/list';
		$this->templatedata['users'] = $users['users'];
		$this->templatedata['groups'] = & $repo->getGroups();
		
		$this->load->view('admin/master',$this->templatedata);
	}
		
	public function add()
	{
		$repo = $this->doctrine->em->getRepository('user\models\User');
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('username', 'Username', 'required|callback_checkUsername');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
			$this->form_validation->set_rules('group_id', 'Group', 'numeric');
			
			if($this->form_validation->run($this))
			{
				$status = ($this->input->post('isActive') == 1 ) ? "active":"inactive";
				
				$user = new user\models\User;
				$firstname = $this->input->post("first_name");
				$middlename = $this->input->post("middle_name");
				$lastname = $this->input->post("last_name");
				$user->setFirstname($firstname);
				$user->setMiddlename($middlename);
				$user->setLastname($lastname);
				
			//	$user->setDesignation($this->input->post('designation'));
				$user->setEmail($this->input->post("email"));
				$user->setPhone($this->input->post("phone1"));
				$user->setUsername($this->input->post("username"));
				$user->setPassword(md5(123456));
				$user->setStatus($status);
				
				foreach($this->input->post("groups") as $r)
				{
					$_group = $this->doctrine->em->find("user\models\Group",$r);
					$user->assignGroup($_group);
				}
				
				$this->doctrine->em->persist($user);
				$this->doctrine->em->flush();
								
				if($user->id()){
					$this->session->set_success_flashdata('feedback', 'User added successfully.');
					admin_redirect('user');
				}
			}
		}
		
		$this->breadcrumb->append_crumb('Add User', admin_url('user/add'));
		$this->templatedata['groups'] =& $repo->getGroups();
		$this->templatedata['maincontent'] = 'user/admin/add';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function edit($user_id)
	{
		$repo = $this->doctrine->em->getRepository('user\models\User');
		
		$user =& $this->doctrine->em->find('user\models\User',$user_id);
		$groups = & $repo->getGroups();
		$user_roles = '' ;
		//$user_group = array();
		
		$user_group = array();
		foreach($user->getGroups() as $ur)
			$user_group[]= $ur->id();

		if($this->input->post())
		{
			$allroles = array();
			foreach($groups as $ar)
				$allroles[]= $ar->id();
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
			$this->form_validation->set_rules('group_id', 'Group', 'numeric');
			
			if($this->form_validation->run())
			{
				$status = ($this->input->post('isActive') == 1 ) ? "active":"inactive";
				
				$firstname = $this->input->post("first_name");
				$middlename = $this->input->post("middle_name");
				$lastname = $this->input->post("last_name");
				$user->setFirstname($firstname);
				$user->setMiddlename($middlename);
				$user->setLastname($lastname);
				
			//	$user->setDesignation($this->input->post('designation'));
				$user->setEmail($this->input->post("email"));
				$user->setPhone($this->input->post("phone1"));
				$user->setStatus($status);
				
				foreach($this->input->post("groups") as $r)
				{
					$key = array_search($r,$user_group);
					if( $key === FALSE)
					{
						$_group = $this->doctrine->em->find("user\models\Group",$r);
						$user->assignGroup($_group);
					}else
						unset($user_group[$key]);
				}
				//now remove the unwanted roles
				foreach($user_group as $ur)
				{
					$role = $this->doctrine->em->find("user\models\Group",$ur);
					$user->unassignGroup($role);
				}
				
				
				$this->doctrine->em->persist($user);
				$this->doctrine->em->flush();
				
				$this->session->set_success_flashdata('feedback', "User saved successfully.");
					admin_redirect('user');
			}
		}
		$this->breadcrumb->append_crumb('Edit User', admin_url('user/edit'));
		$this->templatedata['usergroups'] = $user_group;
		$this->templatedata['groups'] = $groups;
		$this->templatedata['maincontent'] = 'user/admin/edit';
		$this->templatedata['user'] = $user;
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function delete($user_id)
	{
		if($user_id == 1)
			admin_redirect('user');
		$user =& $this->doctrine->em->find('user\models\User',$user_id);
		
		$user->setStatus(STATUS_INACTIVE);
		//$this->doctrine->em->remove($user);
		$this->doctrine->em->persist($user);
		$this->doctrine->em->flush();
		admin_redirect('user');
		
		$this->breadcrumb->append_crumb('Delete User', admin_url('#'));
		$this->templatedata['user'] = $user;
		$this->templatedata['maincontent'] = 'user/admin/delete';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function addgroup()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			if($this->form_validation->run($this))
			{
				$status = ($this->input->post('isActive') == 1 ) ? "active":"inactive";
				
				$group = new user\models\Group;
				$group->setName($this->input->post('group_name'));
				$group->setStatus($status);
				
				$this->doctrine->em->persist($group);
				$this->doctrine->em->flush();
				
				if($group->id()){
					$this->session->set_success_flashdata('feedback', "Group added successfully.");
					admin_redirect('user#group');
				}
				
			}
		}
		$this->breadcrumb->append_crumb('Add Group', admin_url('user/addgroup'));
		$this->templatedata['maincontent'] = 'user/admin/group/add';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function editgroup($group_id)
	{
		if($group_id == ROLE_SUPER_ADMIN)
			admin_redirect('user#group');
		
		$group = $this->doctrine->em->find('user\models\Group',$group_id);
		
		$this->templatedata['group'] = &$group;
		if($this->input->post())
		{
			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			if($this->form_validation->run($this))
			{
				$status = ($this->input->post('isActive') == 1 ) ? "active":"inactive";
								
				$group->setName($this->input->post('group_name'));
				$group->setStatus($status);		
					
				$this->doctrine->em->persist($group);
				$this->doctrine->em->flush();
					
				
				$this->session->set_success_flashdata('feedback', 'Group saved successfully.');
				admin_redirect('user#group');
			}
		}
		$this->breadcrumb->append_crumb('Edit Group', admin_url('user/editgroup'));
		$this->templatedata['maincontent'] = 'user/admin/group/edit';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function deletegroup($group_id)
	{
		if($group_id == ROLE_SUPER_ADMIN)
			admin_redirect('user#group');
		$group = $this->doctrine->em->find('user\models\Group',$group_id);
		
		//remove this group from all the user associations and assign the unassign group to those users if they were associated with only this group
		foreach($group->getUsers() as $u)
		{
			$_user_groups = &$u->getGroups();
			if($_user_groups->contains($group) AND $_user_groups->count() == 1)
			{
				$u->unassignGroup($group);
				
				//set unassigned group
				$_ug = $this->doctrine->em->find('user\models\Group',ROLE_UNASSIGNED);
				$u->assignGroup($_ug);
			}
			$this->doctrine->em->persist($u);
		}
		
		
		$this->doctrine->em->remove($group);
		$this->doctrine->em->flush();
		
		admin_redirect('user#group');
	}
	
	public function editgrouppermissions($group_id)
	{
		$repo = $this->doctrine->em->getRepository('user\models\User');
		
		if($group_id == ROLE_SUPER_ADMIN)
			admin_redirect('user#group');

		$group = $this->doctrine->em->find('user\models\Group',$group_id);
		
		$allpermissions =& $repo->getPermissions();
		
		$role_permission = array();
		foreach($group->getPermissions() as $ur)
			$role_permission[]= $ur->id();
		
		$_allpermissions = array();
		foreach($allpermissions as $ar)
			$_allpermissions[]= $ar->id();
				
		if($this->input->post())
		{
			foreach($this->input->post('permissions') as $p)
			{
				$key = array_search($p,$role_permission);
				if( $key === FALSE)
				{
					$permission = $this->doctrine->em->find("user\models\Permissions",$p);
					$group->assignPermission($permission);
				}else
					unset($role_permission[$key]);
			}
				
			foreach($role_permission as $ur)
			{
				$permission = $this->doctrine->em->find("user\models\Permissions",$ur);
				$role->unassignPermission($permission);
			}
			
			$this->doctrine->em->persist($group);
			$this->doctrine->em->flush();
			
			$this->session->set_success_flashdata('feedback', 'Permissions saved successfully.');
				admin_redirect('user#group');
		}
		
		//show_pre($groupPermissions);exit;
		
		$this->templatedata['groupPermissions'] = $role_permission;
		$this->templatedata['allpermissions'] = $allpermissions;
		$this->templatedata['group'] = &$group;
		$this->templatedata['maincontent'] = 'user/admin/editgrouppermission';
		$this->load->view('admin/master',$this->templatedata);
	}
	
		public function checkUsername($username)
	{
		$userRepo = &$this->doctrine->em->getRepository('user\models\User');	
		$user = $userRepo->findBy(array('username' =>$username));		
		if($user)
		{
			$this->form_validation->set_message('checkUsername', 'Username Already Exists');
			return FALSE;
		}else return TRUE;
	}
	
	
}