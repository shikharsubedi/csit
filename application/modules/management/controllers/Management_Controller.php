<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * * front controller
 */

class Management_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('breadcrumb');
        $this->breadcrumb->append_crumb('About Us', 'content/about-us');
    }

    public function index() {
        
        $memberRepo = &$this->doctrine->em->getRepository('management\models\Management');
        $profile = $memberRepo->getProfiles();
		
		if(!$profile)
			redirect();

        $this->_t['profile'] = & $profile;
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - Our Team";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
		$this->load->theme('management_profiles', $this->_t);
        //$this->load->theme("mgmt_team_list", $data);
    }
	
	public function profile($slug) {
        $profile = &$this->doctrine->em->getRepository('management\models\Management')->findBySlug($slug);
        
		if(!$profile)
			redirect();

        $this->_t['profile'] = & $profile[0];
		
		$this->_t['metatitle'] 			= "Texas International College Our Team - ".$profile[0]->getName();
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');

        $this->load->theme('profile', $this->_t);
    }
    
    public function indexA() {
        $id = Options::get('homepage_message');
		if($id !=''){
        
        	$management=  $this->doctrine->em->find('management\models\Management',$id);
        	$data['message'] = $management;

        	$this->load->theme("homepage_message", $data);
		}
    }

    public function showFront() {
        $repo = $this->doctrine->em->getRepository('management\models\Management');
        $showFront = $repo->findBy(array('active' => '1', 'showFront' => '1'), array('order' => 'DESC'),2);
        $data['showFront']=$showFront;
        $this->load->theme("mgmt_team_front", $data);
    }	
}
