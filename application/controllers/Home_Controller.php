<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include APPPATH."controllers/front_controller.php";
class Home_Controller extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{

// load meta tags
		$meta = $this->doctrine->em->getRepository('content\models\Content')->getAllTags();
		$tags = array();
		
		foreach ($meta as $at) {
				$tags[$at->getTerm()->id()] = $at->getTerm()->getName();
			}
		
		$this->_t['isHomePage'] = TRUE;
		$this->_t['metatags'] = $tags;
//		$this->_t['title'] = $this->_CONFIG['admin_name'];

		$this->load->theme('index',$this->_t);
	}

	
}