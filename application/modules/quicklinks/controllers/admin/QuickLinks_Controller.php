<?php

use quicklinks\models\QuickLinks,
    Doctrine\Common\Util\Debug;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuickLinks_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //check for permissions
        if (!user_access('quick links'))
            admin_redirect();

        //$this->load->model('popup/popup','p');
        $this->breadcrumb->append_crumb('Quick Links', admin_url('quicklinks'));
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('quicklinks\models\QuickLinks');
        $quickLinks = $repo->getAll();
        $this->templatedata['quickLinks'] = $quickLinks;
        $this->templatedata['maincontent'] = 'quicklinks/admin/list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('quicklinks_title', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Name', 'required');
            $this->form_validation->set_rules('type', 'Name', 'required');

            //revise
            if (($this->input->post('type')) == 'internal') {
                $this->form_validation->set_rules('target_page', 'Name', 'required');
            } else {
                $this->form_validation->set_rules('target_url', 'Name', 'required');
            }
            //revise

            if ($this->form_validation->run($this)) {
                $_qI = new QuickLinks();
                $_qI->setTitle($this->input->post('quicklinks_title'));
                $_qI->setStatus($this->input->post('status'));
                $_qI->setType($this->input->post('type'));
                if (($_qI->getType()) == 'internal')
                    $_qI->setContent($this->doctrine->em->find('content\models\Content', $this->input->post('target_page')));
                else
                    $_qI->setLink($this->input->post('target_url'));

                $this->doctrine->em->persist($_qI);
                $this->doctrine->em->flush();

                if ($_qI->getId()) {
                    $this->session->set_success_flashdata('feedback', 'QuickLink added successfully.');
                    admin_redirect('quicklinks');
                }
            }
        }

        $this->breadcrumb->append_crumb('Add Quicklink', admin_url('#'));
        $this->templatedata['maincontent'] = 'quicklinks/admin/add';
        //$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $_qL = $this->doctrine->em->find('quicklinks\models\QuickLinks', $id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('link_label', 'Name', 'required');
            //revise validation
            if ($this->form_validation->run($this)) {
                $_qL->setTitle($this->input->post('link_label'));
                $_qL->setType($this->input->post('type'));
                if (($_qL->getType()) == 'internal')
                    $_qL->setContent($this->doctrine->em->find('content\models\Content', $this->input->post('target_page')));
                else
                    $_qL->setLink($this->input->post('target_url'));
                $this->doctrine->em->persist($_qL);
                $this->doctrine->em->flush();

                $this->session->set_success_flashdata('feedback', 'Quicklink saved successfully.');
                admin_redirect('quicklinks');
            }
        }

        $this->breadcrumb->append_crumb('Edit Quicklinks', admin_url('#'));
        $this->templatedata['quicklinks'] = $_qL;
        $this->templatedata['maincontent'] = 'quicklinks/admin/edit';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $_qL = $this->doctrine->em->find('quicklinks\models\QuickLinks', $id);
        $this->doctrine->em->remove($_qL);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'The Quicklink was deleted successfully.');
        admin_redirect('quicklinks');
    }

}
