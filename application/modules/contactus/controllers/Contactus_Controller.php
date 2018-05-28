<?php
 use contactus\models\ContactUs;
 use outletlocator\models\Outlet;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|alpha_modified');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('comments', 'Message', 'required|alpha_modified');
            //revise validation
            if ($this->form_validation->run($this)) {
				
				$post = $this->input->post();
                $object = new ContactUs();
                $object->setName(strip_tags(trim($this->input->post('name'))));              
                $object->setEmail(strip_tags(trim($this->input->post('email'))));
                $object->setMessage(strip_tags(trim($this->input->post('comments'))));
                $this->doctrine->em->persist($object);
                $this->doctrine->em->flush();
				
				$feedbackEmail 	= Options::get('feedback_email');
				$subject		= 'Feedback Email from website';
				
				$data['contact'] 	= &$object;
				
				$this->load->library('email');
				$this->email->from(strip_tags(trim($this->input->post('email'))), strip_tags(trim($this->input->post('name'))));
				$this->email->to($feedbackEmail);
				$this->email->subject($subject);
				$message = $this->load->view('feedback-email', $data, TRUE);
				$this->email->message($message);
				$this->email->send();
			
                $this->session->set_success_flashdata('feedback', 'Form submitted successfully.');
                redirect('contactus');
            }
        } 
        $outlet=  $this->doctrine->em->getRepository('outletlocator\models\Outlet');
        $outlet=$outlet->findBy(array("status"=>'active'),array('id'=>'DESC'),1);
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - Contact Us";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->_t['outlet']=$outlet;
        $this->load->theme("contact_us",  $this->_t);
        
    }
}
