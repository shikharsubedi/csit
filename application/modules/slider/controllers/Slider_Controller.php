<?php 
(defined('BASEPATH')) OR exit('No direct script access allowed');


class Slider_Controller extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->_t['sitetitle'] = $this->_CONFIG['admin_name'];
	}
	
	public function index()
	{
		
		$sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');
		
		$images = $sliderRepo->getMainSlider($filters = NULL, $perpage = NULL);
		
		$this->load->view('slider/front/index',array('images'=>$images));
	}
	
	public function entertainment()
	{
		
		$sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');
		
		$images = $sliderRepo->getEntertainmentSlider($filters = NULL, $perpage = NULL);
		
		$this->load->view('slider/front/entertainment',array('images'=>$images));
	}
	
	
	
	public function view()
	{
		$sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');
		
		$images = $sliderRepo->getImages(array('status' => STATUS_ACTIVE), 10);
		$this->_t['images'] = $images;
		$this->load->view('slider/front/view',$this->_t);
	}
	
	public function viewall()
	{
		$sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');
		
		$images = $sliderRepo->getImages(array('status' => STATUS_ACTIVE), NULL);
		$this->_t['images'] = $images;
		$this->load->view('slider/front/viewall',$this->_t);
	}
}