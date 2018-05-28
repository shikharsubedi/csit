<?php
 use college\models\College;


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class College_Controller extends Front_Controller {

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

    public function getCollegelist(){
        $repo = $this->doctrine->em->getRepository('college\models\College');
        $college = $repo->getList();
        $this->_t['college']=$college;
        $this->load->view('college/front/list',$this->_t);
    }

    public function collegeDetail($slug){
        $college = $this->doctrine->em->getRepository('college\models\College')->findBy(array('slug' => $slug));
        // show_pre($college); exit;
        $this->_t['college']=$college[0];
         $this->load->theme("college-detail",  $this->_t);
    }

    public function getAllCollegelist($offset = 0){
        $repo = $this->doctrine->em->getRepository('college\models\College');
        $perpage = 5;
        $college = $repo->getFrontListCollege($perpage, $offset);
         $numContent = $college['total'];
            
        if($numContent > $perpage)
        {
            $this->load->library('pagination');
            
            $config['base_url'] = base_url()."collegelist";
            $config['total_rows'] = $numContent;
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 2;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';
            
            $this->pagination->initialize($config);
            $pg = $this->pagination->create_links();
            $this->_t['pagination'] = $pg;
        }
        $this->_t['college']=$college['college'];
        $this->load->theme("college-list",  $this->_t);
    }
}
