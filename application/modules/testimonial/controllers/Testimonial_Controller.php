<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial_Controller extends Front_Controller {

    public function index() {
        $repo = &$this->doctrine->em->getRepository('testimonial\models\Testimonial');
        $testimonial = $repo->findBy(array('status' => '1'));
		
		$this->_t['testimonial'] = $testimonial;
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - Testimonials";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->load->theme("testimonial_list", $this->_t); 
    }

    public function showFront() {
        $repo = &$this->doctrine->em->getRepository('testimonial\models\Testimonial');
        $testimonial = $repo->findBy(array('status' => '1', 'showFront' => '1'), array('id' => 'DESC'),1);
        $this->load->theme("testimonial", array('testimonial' => $testimonial)); 
    }
    

}
