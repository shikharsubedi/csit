<?php

class Faq_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $faqcatRepo = $this->doctrine->em->getRepository('faq\models\Faqcat');
        $faqcats 	= $faqcatRepo->findBy(array('status' => '1'),array('order'=>'ASC'));        
        $this->_t['faqcats'] = $faqcats;
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - FAQs";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->load->theme('faq_list', $this->_t);
    }   
}

?>