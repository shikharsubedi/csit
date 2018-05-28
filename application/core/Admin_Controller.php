<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Controller extends MY_Controller
{
	
	var $templatedata = array();
	
	var $mainmenu = NULL;
	
	public function __construct()
	{
		parent::__construct();
		System::init();
		//$this->output->enable_profiler(TRUE);
		
		

		$this->load->library('session');
		$this->load->library('breadcrumb');
		if (!$this->session->userdata('user_id'))
		{
			redirect('console/login');
		}
		
		$this->load->helper('sidebar');
		$this->load->helper('form');
		
		$this->load->model('admin/menu_model','menu');

		$this->breadcrumb->append_crumb('Dashboard', admin_url());

		$this->templatedata['mainmenu'] = $this->mainmenu;

		$this->templatedata['_CONFIG']	= $this->_CONFIG;
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		
		$this->templatedata['scripts'] = array();
		$this->templatedata['stylesheets'] = array();
		$this->benchmark->mark('admin_controller_end');
	}
}