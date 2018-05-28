<?php

use emailsubscription\models\EmailSubscription;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EmailSubscription_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('email subscription list'))
            admin_redirect();
        $this->load->library('ThumbLib');
        $this->breadcrumb->append_crumb('Email Subscription', admin_url('emailsubscription'));
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('emailsubscription\models\EmailSubscription');
        $emails = $repo->findAll();
        $this->templatedata['emails'] = $emails;
        $this->templatedata['maincontent'] = 'emailsubscription/admin/list';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }
    
    public function add() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Name', 'required');

            if ($this->form_validation->run($this)) {
                $_qI = new EmailSubscription();
                $_qI->setEmail($this->input->post('email'));
                $_qI->setActive($this->input->post('status'));
                $this->doctrine->em->persist($_qI);
                $this->doctrine->em->flush();

                if ($_qI->getId()) {
                    $this->session->set_success_flashdata('feedback', 'Email added successfully.');
                    admin_redirect('emailsubscription');
                }
            }
        }
        $this->breadcrumb->append_crumb('Add Email', admin_url('#'));
        $this->templatedata['maincontent'] = 'emailsubscription/admin/add';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }
     public function edit($id) {
        $_qL = $this->doctrine->em->find('emailsubscription\models\EmailSubscription', $id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Name', 'required');
            //revise validation
            if ($this->form_validation->run($this)) {
                $_qL->setEmail($this->input->post('email'));
                $_qL->setActive($this->input->post('status'));
                $this->doctrine->em->persist($_qL);
                $this->doctrine->em->flush();

                $this->session->set_success_flashdata('feedback', 'Email saved successfully.');
                admin_redirect('emailsubscription');
            }
        }

        $this->breadcrumb->append_crumb('Edit Email\'s', admin_url('#'));
        $this->templatedata['email'] = $_qL;
        $this->templatedata['maincontent'] = 'emailsubscription/admin/edit';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $_qL = $this->doctrine->em->find('emailsubscription\models\EmailSubscription', $id);
        $this->doctrine->em->remove($_qL);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'The Email was deleted successfully.');
        admin_redirect('emailsubscription');
    }
}
