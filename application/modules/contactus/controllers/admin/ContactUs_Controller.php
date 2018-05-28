<?php

use contactus\models\ContactUs;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ContactUs_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('contact us list'))
            admin_redirect();
        $this->load->library('ThumbLib');

        $this->breadcrumb->append_crumb('Contact Us', admin_url('contactus'));
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('contactus\models\ContactUs');
        $contacts = $repo->findAll();
        $this->templatedata['contacts'] = $contacts;
        $this->templatedata['maincontent'] = 'contactus/admin/list';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }
    
    public function view($id) {
        $repo = $this->doctrine->em->find('contactus\models\ContactUs',$id);
        $this->templatedata['contact'] = $repo;
        $this->templatedata['maincontent'] = 'contactus/admin/view';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->breadcrumb->append_crumb('view', admin_url('contactus'));
        $this->load->view('admin/master', $this->templatedata);
    }

}
