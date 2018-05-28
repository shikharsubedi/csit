<?php

use faq\models\Faqcat;
use faq\models\faqs;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('administer faq'))
            admin_redirect();
        $this->breadcrumb->append_crumb('FAQ', admin_url('faq'));
    }

    public function index($offset = 0) {
        $faqcatRepo = &$this->doctrine->em->getRepository('faq\models\Faqcat');

        $faqcats = $faqcatRepo->getFaqcats();

        if ($this->input->post('saveorder')) {
            $ord = explode('&', $this->input->post('order'));
            $index = 1; // 0 reserved for default
            foreach ($ord as $o) {
                $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $o);
                $faqcat->setVal('order', $index++);
                $this->doctrine->em->persist($faqcat);
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Faqcat order sorted successfully.');
            admin_redirect('faq');
        }

        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    foreach ($checked as $k => $v) {
                        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $v);
                        $faqcat->activate();
                        $this->doctrine->em->persist($faqcat);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $v);
                        $faqcat->deactivate();
                        $this->doctrine->em->persist($faqcat);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $v);
                        if ($faqcat)
                            $this->doctrine->em->remove($faqcat);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('faq');
        }
        $this->breadcrumb->append_crumb('FAQ Category', admin_url(''));
        $this->templatedata['faqcats'] = $faqcats;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run()) {
                $faqcatRepo = &$this->doctrine->em->getRepository('faq\models\Faqcat');
                $faqcat = new Faqcat;

                $fieldArray = $faqcatRepo->getFieldArray();

                foreach ($fieldArray as $k => $v) {
                    if (isset($_POST[$k])) {

                        $faqcat->setVal($v, $_POST[$k]);
                    }
                }

                $faqcat->setUser(Current_User::user());


                $this->doctrine->em->persist($faqcat);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqcat added successfully.');
                admin_redirect('faq');
            }
        }
        $this->breadcrumb->append_crumb('Add FAQ Category', admin_url(''));
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {

        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $id);
        $faqcatRepo = &$this->doctrine->em->getRepository('faq\models\Faqcat');

        $fieldArray = $faqcatRepo->getFieldArray();

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run()) {
                foreach ($fieldArray as $k => $v) {
                    if (isset($_POST[$k]))
                        $faqcat->setVal($v, $_POST[$k]);
                }



                $this->doctrine->em->persist($faqcat);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqcat saved successfully.');
                admin_redirect('faq');
            }
        }
        $this->breadcrumb->append_crumb('Edit Faqcat', admin_url(''));
        $this->templatedata['faqcat'] = $faqcat;
        $this->templatedata['fieldArray'] = $fieldArray;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/edit';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {

        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $id);

        if ($faqcat) {
            foreach ($faqcat->getFaqs() as $f) {
                $faq = $this->doctrine->em->find('faq\models\Faqs', $f->id());
                $this->doctrine->em->remove($faq);
                $this->doctrine->em->flush();
            }
            $this->doctrine->em->remove($faqcat);
            $this->doctrine->em->flush();
            $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqcat deleted successfully.');
            admin_redirect('faq');
        }
    }

    public function viewfaqs($id) {

        $faqsRepo = &$this->doctrine->em->getRepository('faq\models\Faqs');

        $faqss = $faqsRepo->getFaqss($id);

        if ($this->input->post('saveorder')) {
            $ord = explode('&', $this->input->post('order'));
            $index = 1; // 0 reserved for default
            foreach ($ord as $o) {
                $faqs = &$this->doctrine->em->find('faq\models\Faqs', $o);
                $faqs->setVal('order', $index++);
                $this->doctrine->em->persist($faqs);
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Faqs order sorted successfully.');
            admin_redirect('faq/viewfaqs/' . $id);
        }

        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    foreach ($checked as $k => $v) {
                        $faqs = &$this->doctrine->em->find('faq\models\Faqs', $v);
                        $faqs->activate();
                        $this->doctrine->em->persist($faqs);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $faqs = &$this->doctrine->em->find('faq\models\Faqs', $v);
                        $faqs->deactivate();
                        $this->doctrine->em->persist($faqs);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $faqs = &$this->doctrine->em->find('faq\models\Faqs', $v);
                        if ($faqs)
                            $this->doctrine->em->remove($faqs);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('faq/viewfaqs/' . $id);
        }
        $this->breadcrumb->append_crumb('View Faqs', admin_url(''));
        $this->templatedata['faqss'] = $faqss;
        $this->templatedata['mid'] = $id;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/listitem';
        $this->load->view('admin/master', $this->templatedata);
    }

    // Add FAQs.
    public function addfaqs($id) {

        // $failed checks if the form is validated or not.
        // This is used to repopulate the array field value in the form.
        $failed = FALSE;

        // Posted questions. (initialization)
        $questions = array();

        // Posted answers. (initialization)
        $answers = array();


        // Fetching a particular FAQ Category.
        $faqcat = &$this->doctrine->em->find('faq\models\Faqcat', $id);

        $faqsRepo = &$this->doctrine->em->getRepository('faq\models\Faqs');

        if ($this->input->post()) {
            $this->load->library('form_validation');

            // Set rules for question and answer fields. (array values)
            $this->form_validation->set_rules('question[]', 'Question', 'required');
            $this->form_validation->set_rules('answer[]', 'Answer', 'required');

            if ($this->form_validation->run()) {

                // $answers stores all the answers posted in the form. ($answers = array value)
                $answers = $this->input->post('answer');

                // We use "$answers" array just for the loop.
                // We use the post values to persist in the database. 
                foreach ($answers as $key => $value) {
                    $faqs = new Faqs;

                    // Fetches the serialized value for answer and questions.
                    $fieldArray = $faqsRepo->_getFieldArray();

                    foreach ($fieldArray as $k => $v) {

                        // Saves the individual answers and questions in the database.
                        $faqs->setVal($v, $_POST[$k][$key]);
                    }
                    // Setting the current user in the database.
                    $faqs->setUser(Current_User::user());

                    // Setting the current category in the database.
                    $faqs->setFaqcat($faqcat);

                    if($this->input->post('isActive')=='1'){
                        $faqs->activate();
                    }else{
                        $faqs->deactivate();
                    }
                    
                    // Persisting individual faq object in the database.
                    $this->doctrine->em->persist($faqs);
                    $this->doctrine->em->flush();
                }

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqs added successfully.');
                admin_redirect('faq/viewfaqs/' . $id);
            } else {

                // $answers stores all the answers posted in the form. ($answers = array value)
                $answers = $this->input->post('answer');

                // $questions stores all the questions posted in the form ($questions = array value)
                $questions = $this->input->post('question');

                $failed = TRUE;
            }
        }

        $this->breadcrumb->append_crumb('Add FAQs', admin_url(''));

        $this->templatedata['answers'] = $answers;
        $this->templatedata['questions'] = $questions;
        $this->templatedata['failed'] = $failed;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/additem';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editfaqs($id) {

        $faqcat = $this->doctrine->em->find('faq\models\Faqcat', $id);
        $faqs = &$this->doctrine->em->find('faq\models\Faqs', $id);


        //$faqs = $this->doctrine->em->find('faq\models\Faqs', $_id);
        //$fieldArray = $faqsRepo->_getFieldArray();

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('question', 'Question', 'required');
            $this->form_validation->set_rules('answer', 'Answer', 'required');

            if ($this->form_validation->run()) {
//                foreach ($fieldArray as $k => $v) {
//                    if (isset($_POST[$k]))
//                        $faqs->setVal($v, $_POST[$k]);
//                }
                $faqs->setQuestion($this->input->post('question'));
                $faqs->setAnswer($this->input->post('answer'));
                if (($this->input->post('isActive')) == '1') {
                    $faqs->activate();
                } else {
                    $faqs->deactivate();
                }
                $cateId = $faqs->getFaqcat()->id();

                $this->doctrine->em->persist($faqs);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqs saved successfully.');
                admin_redirect('faq/viewfaqs/' . $cateId);
            }
        }
        $this->breadcrumb->append_crumb('Edit Faqs', admin_url(''));
        $this->templatedata['faqcat'] = $faqcat;
        $this->templatedata['faqs'] = $faqs;
        //$this->templatedata['fieldArray'] = $fieldArray;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faq/admin/edititem';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deletefaqs($id) {

        $faqs = &$this->doctrine->em->find('faq\models\Faqs', $id);
        $faqsCatId = $faqs->getFaqcat()->id();
        if ($faqs) {
            $this->doctrine->em->remove($faqs);
            $this->doctrine->em->flush();
            $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faqs deleted successfully.');
            admin_redirect('faq/viewfaqs/' . $faqsCatId);
        }
    }

}

?>