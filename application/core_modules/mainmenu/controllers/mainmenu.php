<?php

class Mainmenu extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->model('mainmenu/mainmenu_model','mm');
		$this->load->helper('mainmenu/mainmenu');
		
		$data = array();
		$data['mainmenu'] = $this->mm->listMenu(0,TRUE);
		
		$this->load->view('mainmenu/front/mainmenu',$data);
	}
	
	public function _remap()
	{
		show_404();
	}
}