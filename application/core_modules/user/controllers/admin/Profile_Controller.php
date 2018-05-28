<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile_Controller extends Admin_Controller
{
	public function __construct()
	{
		$this->mainmenu = MAINMENU_PROFILE;
		parent::__construct();
		$this->load->library('form_validation');
		
		$this->breadcrumb->append_crumb('Profile', admin_url('user/profile'));
	}
	
	public function index()
	{
		$this->templatedata['maincontent'] = 'user/admin/profile/view';
		
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function edit()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
			
			if($this->form_validation->run($this))
			{
				$user = &Current_User::user();
				
				$user->setFirstname($this->input->post('first_name'));
				$user->setLastname($this->input->post('last_name'));
				$user->setMiddlename($this->input->post('middle_name'));
				$user->setEmail($this->input->post('email'));
				$user->setPhone($this->input->post('phone'));
			//	$user->setDesignation($this->input->post('designation'));
			
				$this->doctrine->em->persist($user);
				$this->doctrine->em->flush();
			
				$this->session->set_success_flashdata('feedback', 'Profile saved successfully.');
				admin_redirect('user/profile');
			}
		}
		
		$this->breadcrumb->append_crumb('Edit Profile', admin_url('#'));
		$this->templatedata['maincontent'] = 'user/admin/profile/edit';
		
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function changepwd()
	{
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|callback_checkPassword');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('new_password_confirm', 'Password Confirm', 'required');
			
			if($this->form_validation->run($this))
			{
				$user = &Current_User::user();
				$user->setPassword(md5($this->input->post('new_password')));	
				$this->doctrine->em->persist($user);
				$this->doctrine->em->flush();		
				$this->session->set_success_flashdata('feedback', 'Password changed successfully.');
				admin_redirect('user/profile');
			}
		}
		$this->breadcrumb->append_crumb('Change Password', admin_url('#'));
		$this->templatedata['maincontent'] = 'user/admin/profile/changepwd';
		
		$this->load->view('admin/master',$this->templatedata);
	}
	
	
	public function checkPassword($password)
	{
		if(md5($password) != Current_User::user()->getPassword())
		{
			$this->form_validation->set_message('checkPassword', 'The %s does not match.');
			return FALSE;
		}else return TRUE;
	}
}