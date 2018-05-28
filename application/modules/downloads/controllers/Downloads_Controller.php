<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Downloads_Controller extends Front_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('downloads\models\Download_category');
        $downloads = $repo->findBy(array('status' => STATUS_ACTIVE), array('order' => 'ASC'));
        $this->_t['downloads'] = $downloads;
		
		$this->_t['metatitle'] 			= Options::get('meta_title')." - Downloads";
		$this->_t['metadescription'] 	= Options::get('meta_description');
		$this->_t['metakeywords'] 		= Options::get('meta_keyword');
		
        $this->load->theme('downloads_list', $this->_t);
    }

    public function showFront() {
        $repo = $this->doctrine->em->getRepository('downloads\models\Download');
        $downloads = $repo->findBy(array('status' => STATUS_ACTIVE, 'showFront' => '1'), array('order' => 'ASC'), 3);
        $this->_t['downloads'] = $downloads;
        $this->load->theme('downloads', $this->_t);
    }
    
    public function download($slug = '') {
        $file = $this->doctrine->em->getRepository('downloads\models\Download')->findBy(array('slug' => $slug));
        $nameOld = base_url() . "assets/upload/downloads/" . $file[0]->getFile();
        $pathinfo = (pathinfo($nameOld));
        $extension = $pathinfo['extension'];
        $nameNew = str_replace(' ', '-', $file[0]->getSlug());
        header("Content-Transfer-Encoding: binary");
        header('Content-type: application/' . $extension);
        header("Content-disposition: attachment; filename=$nameNew");
        readfile($nameOld);
    }

//    public function homeDownloads() {
//        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');
//
//        $category = $downloadRepo->getDLCategory();
//
//        $this->_t['categories'] = $category;
//        $this->load->theme('home-downloads', $this->_t);
//    }

//    public function get($slug) {
//        $this->load->helper('file');
//
//        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');
//
//        $item = $downloadRepo->getItemFromSlug($slug);
//        $item = $item[0];
//
//        if ($item) {
//            $this->load->helper('download');
//            $file = './assets/upload/downloads/' . $item['file'];
//            $data = file_get_contents($file); // Read the file's contents
//            $name = $item['file'];
//
//            force_download($name, $data);
//        } else
//            show_404();
//    }
//
//    public function _type($id = '') {
//
//        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');
//        $items = $downloadRepo->getDLItems($id);
//
//        $data['items'] = & $items;
//        $this->load->theme('downloads', $data);
////    }
//
//    public function _item($id = '') {
//
//        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');
//        $items = $downloadRepo->getDLItems($id);
//
//        $data['items'] = & $items;
//
//        $this->load->theme('downloads', $data);
//    }
//
//    public function downloadsmobile() {
//        $this->load->library('breadcrumb');
//
//        $active = $this->uri->segment(3, 0);
//
//
//        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');
//
//        $categories = $downloadRepo->getDLMobileapp();
//
//        $cat = array();
//
//        foreach ($categories as $c) {
//            $items = $downloadRepo->getDLItems($c['id']);
//
//            $c['items'] = $items;
//            $cat[] = $c;
//        }
//
//        $this->_t['download_cat'] = &$cat;
//        $this->_t['active'] = $active;
//        $this->load->view('downloads/front/downloads', $this->_t);
//    }

}

?>