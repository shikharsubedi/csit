<?php

use outletlocator\models\Outlet;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Outletlocator_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->_t['sitetitle'] = $this->_CONFIG['admin_name'];
        $this->_t['slogan'] = $this->_CONFIG['slogan'];
    }

    public function index() {
//        $outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
//        $outlets = $outlet_repo->getOutlets(NULL, NULL, array('status' => STATUS_ACTIVE));
//        $contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
//
//        $data['outlets'] = &$outlets['outlets'];
//        $data['districts'] = $outlet_repo->getAddedDistricts();
//        $data['countries'] = $outlet_repo->getAddedCountries();
//        $data['regions'] = $outlet_repo->getAddedRegions();
//
//        //$this->tempVars['maincontent'] = 'outletlocator/front/index';
//        $this->load->view('outletlocator/front/newspare', $data);

        $outlet = $this->doctrine->em->getRepository('outletlocator\models\Outlet');
        $outlet = $outlet->findBy(array("status" => 'active'), array('id' => 'DESC'), 1);
        $this->_t['outlet'] = $outlet;
        $this->load->theme('map',  $this->_t);
    }

    public function contact() {
        $data = array();
        $outlets_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
        $data = $outlets_repo->getoutletrepo();
        //$this->tempVars['maincontent'] = 'outletlocator/front/index';
        //show_pre($data);exit;
        $data_t['outletdata'] = $data;
        $this->load->view('outletlocator/front/contactform', $data_t);
    }

    public function showFront() {
        $outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
        $address = $outlet_repo->findBy(array('status' => STATUS_ACTIVE), array('id' => 'DESC'), 1);
        $this->_t['address'] = $address;
        $this->load->theme("our_location", $this->_t);
    }

    function __remap() {
        show_404();
    }

}
