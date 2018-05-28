<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->_t['sitetitle'] = $this->_CONFIG['admin_name'];
    }

    public function index($offset = 0) {

        $per_page = 6;

        $vidRepo = $this->doctrine->em->getRepository('video\models\Video');
        $videos = $vidRepo->getFrontVideos($per_page, $offset);
        $this->_t['videos'] = $videos['videos'];

        $numIndexes = $videos['total'];

        if ($numIndexes >= $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = base_url() . "videos";
            $config['total_rows'] = $numIndexes;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 2;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';

            $this->pagination->initialize($config);
            $this->_t['pagination'] = $this->pagination->create_links();
        }
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - Videos";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->load->theme('videos', $this->_t);
    }

}
