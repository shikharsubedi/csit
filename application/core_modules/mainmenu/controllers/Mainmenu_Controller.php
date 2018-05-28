<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use mainmenu\models\Mainmenu;

class Mainmenu_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->helper('mainmenu/mainmenu');
    }

    public function index() {
		
		$this->load->model('mainmenu/mainmenu_model', 'mm');
    	$menu = $this->mm->getTopmenuTree();
		
		$individualmenu = &getTopmenuTreeChild(1);
		$businessmenu 	= &getTopmenuTreeChild(2);
		
		$this->_t['topmenu'] 		= $menu;
		$this->_t['individualmenu'] = $individualmenu;
		$this->_t['businessmenu'] 	= $businessmenu;
		
		$this->load->theme('topmenu', $this->_t);        
    }
}
