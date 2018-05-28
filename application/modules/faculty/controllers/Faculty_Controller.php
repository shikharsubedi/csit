<?php

use faculty\models\Applytofaculty;

class Faculty_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index($slug = NULL) {

        $faculty = $this->doctrine->em->getRepository("faculty\models\Faculty")->findAll();

        if ($slug != '') {
            $sfaculty = $this->doctrine->em->getRepository("faculty\models\Faculty")->findBy(array('slug' => $slug, 'status' => TRUE), array('order' => 'ASC'));
            $this->_t['selected'] = $sfaculty;
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('faculty', 'Faculty', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('captchacode', 'Captcha', 'required|callback_capCheck');

            if ($this->form_validation->run($this)) {

                $student = new Applytofaculty();
                $student->setName(strip_tags($this->input->post('name')));
                $student->setPhone(strip_tags($this->input->post('phone')));
                $sid = strip_tags($this->input->post('faculty'));
                $sFaculty = $this->doctrine->em->find("faculty\models\Faculty", $sid);
                $student->setFaculty($sFaculty);
                $student->setAddress(strip_tags($this->input->post('address')));
                $student->setEmail(strip_tags($this->input->post('email')));
                $student->setComments(strip_tags($this->input->post('message')));
                $this->doctrine->em->persist($student);
                $this->doctrine->em->flush();

                $_CONFIG = Options::get('siteconfig');
                $adminEmail = $_CONFIG['admin_email'];
                $email = $sFaculty->getEmail() ? $sFaculty->getEmail() : $adminEmail;
                $subject = 'Online Form Submission';

                $data['apply'] = &$student;

                $this->load->library('email');
                $this->email->from(strip_tags(trim($this->input->post('email'))), strip_tags(trim($this->input->post('name'))));
                $this->email->to($email);
                $this->email->subject($subject);
                $message = $this->load->view('apply-online-email', $data, TRUE);
                $this->email->message($message);
                $this->email->send();

                $this->session->set_success_flashdata('feedback', 'Your application has been submitted successfully. Thank You for Applying.');
                redirect('applyonline');
            }
        }
        $this->_t['faculty'] = $faculty;
        $this->_t['slug'] = $slug;

        $this->_t['metatitle'] = Options::get('meta_title') . " - Apply Online";
        $this->_t['metadescription'] = Options::get('meta_description');
        $this->_t['metakeywords'] = Options::get('meta_keyword');

        $this->load->theme('apply_online', $this->_t);
    }

    public function capCheck($str) {
        $code = $this->session->userdata('edocpac');
        if (strcasecmp($code, $str) == 0) {
            $this->session->unset_userdata('edocpac');
            return true;
        } else {
            $this->session->unset_userdata('edocpac');
            $this->form_validation->set_message('capCheck', 'The Captcha Code is Wrong.<br/>');
            return false;
        }
    }

    public function academic() {

        $academic = $this->doctrine->em->getRepository('faculty\models\Faculty')->findBy(array('status' => TRUE), array('order' => 'ASC'));

        $this->_t['academic'] = $academic;
        $this->load->theme('academic_list', $this->_t);
    }

    public function academicrightbar() {

        $academic = $this->doctrine->em->getRepository('faculty\models\Faculty')->findBy(array('status' => TRUE), array('order' => 'ASC'));

        $this->_t['academic'] = $academic;
        $this->load->theme('academic_right_bar_list', $this->_t);
    }

}
