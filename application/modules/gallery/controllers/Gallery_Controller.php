<?php

use gallery\models\Album;
use gallery\models\Image;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($offset = 0) {
        //for album data
        $albumRepo = $this->doctrine->em->getRepository('gallery\models\Album');

        $per_page = 10;

        $albums = $albumRepo->getAlbums($per_page, $offset);
        
       
        $this->_t['albums'] = $albums['albums'];

        $numIndexes  = count($albumRepo->findAll());
        
        if ($numIndexes >= $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = base_url() . "gallery";
            $config['total_rows'] = $numIndexes;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 3;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';

            $this->pagination->initialize($config);
            $this->_t['pagination'] = $this->pagination->create_links();
        }
		
		$this->_t['metatitle'] 			= Options::get('meta_title'). " - Gallery";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->load->theme('gallery_album', $this->_t);
    }

    public function viewAlbum($slug, $offset = 0) {
        $album = $this->doctrine->em->getRepository("gallery\models\Album")->findBy(array('slug' => $slug, 'status' => STATUS_ACTIVE), array('order'=>'ASC'));
        $perpage = 10;
        $albumRepo = $this->doctrine->em->getRepository("gallery\models\Album");
        $aPhotos = $albumRepo->findPhotosByAlbum($slug, $perpage, $offset);
        if ($aPhotos) {
            $numContent = $aPhotos['total'];
            if ($numContent > $perpage) {
                $this->load->library('pagination');
                $config['base_url'] = base_url() . "gallery/view/".$slug;
                $config['total_rows'] = $numContent;
                $config['per_page'] = $perpage;
                $config['uri_segment'] = 4;
                $config['prev_link'] = 'Previous';
                $config['next_link'] = 'Older';

                $this->pagination->initialize($config);
                $pg = $this->pagination->create_links();
                $this->_t['pagination'] = $pg;
            }
        }
        
		$this->_t['metatitle'] 			= "Gallery - ". $album[0]->getName();
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');

        $this->_t['singleAlbum'] = $aPhotos;
        $this->load->theme('gallery_image', $this->_t);
    }

}
