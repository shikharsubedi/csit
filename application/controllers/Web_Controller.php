<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include APPPATH."controllers/front_controller.php";
class Web_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        // load meta tags
        $meta = $this->doctrine->em->getRepository('content\models\Content')->getAllTags();

        $tags = array();
        foreach ($meta as $at) {
            $tags[$at->getTerm()->id()] = $at->getTerm()->getName();
        }
        
        $this->_t['metatags'] 			= $tags;
        $this->_t['sitetitle'] 			= $this->_CONFIG['admin_name'];
        $this->_t['sitename'] 			= $this->_CONFIG['admin_name'];
		$this->_t['metatitle'] 			= Options::get('meta_title');
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
        $this->load->theme('index', $this->_t);       
    }

}
