<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include APPPATH."controllers/front_controller.php";
class Captcha_Controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() {

		$this->load->library('captcha', array(
					//	'type' 			=> 'equation',
						'operand_count' => 3,
						'image_width'	=> 100,
						'image_height'	=> 30,
					));
		
		$this->captcha->render();
		
	}
	

	
}