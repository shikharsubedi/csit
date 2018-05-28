<?php

class Dashboard_Controller extends Admin_Controller
{
	public function __construct()
	{
		$this->mainmenu = MAINMENU_DASHBOARD;
		parent::__construct();
	}	
	
	public function index()
	{
		user_access('administer user');

		$allowed_ip = Options::get('allowed_ip','');
		if (!empty($allowed_ip)) {
			$restriction = Options::get('ip_filter','NO');
			$restriction = ($restriction=='YES') ? TRUE : FALSE;
			
		if ($restriction) {
			$current_ip = $_SERVER['REMOTE_ADDR'];
			if ($current_ip != $allowed_ip) header('Location: '.site_url());
			}
		}

		$this->load->helper('dashboard/dashboard');		

		if ($this->input->post()) {
			Options::update('dashboardOrder_' . Current_User::user()->id(),$this->input->post('order'));
			$this->session->set_success_flashdata('feedback', 'Dashboard items order saved successfully.');
			admin_redirect('dashboard');
		}
		$this->templatedata['maincontent'] = 'dashboard/admin/dashboard';
		$this->load->view('admin/master',$this->templatedata);
	}
}
?>