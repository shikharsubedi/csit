<?php
class Captcha {
	
	var $CI;
	var $type = 'image';
	
// image options	
	var $image_width 		= 120;
	var $image_height 		= 40;
	var $characters_length  = 6;
	var $font 				= './assets/fonts/font.ttf';
	var $random_fonts		= FALSE;
	var $random_dots 		= 50;
	var $random_lines 		= 10;
	var $text_color 		= "0x123456";
	var $noise_color 		= "0x192864";
	
// for equation only
	var $operand_count 		= 2; // max = 3	
	
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		@$this->CI->load->library('session');
		
		if (count($config) > 0)	$this->initialize($config);
		
		if (!is_file($this->font) or $this->random_fonts) {
			$fonts = glob('./assets/fonts/font.ttf');
			if (empty($fonts)) {
				show_error("No fonts in path: '.assets/fonts/'");
			}
			$this->font = count($fonts) > 1 ? $fonts[array_rand($fonts)] : $fonts[0];
		}
	}
	
	function render(){
		$this->type == 'equation' ? $this->equation() : $this->image();
	}

	function initialize($config = array()) {
		
		foreach ($config as $key => $val) {
			if (isset($this->$key))	{
				$this->$key = $val;
			}
		}
		
		if ( $this->operand_count > 3 ) $this->operand_count = 3;
	}
	
	private function image($code = ''){
		
		$i 		= 0;
		$pool 	= '23456789bcdfghjkmnpqrstvwxyzABCDEFGHJKLMNQRTVWXYZ';
		
		if (! $code) {
			$sess_write = TRUE;
			while ( $i < $this->characters_length ) {
				$code .= substr($pool, mt_rand(0, strlen($pool)-1), 1);
				$i++;
			}
		} else {
			$sess_write = FALSE; 
		}
		
		$font_size  = $this->image_height * 0.75;
		$image 		= @imagecreate($this->image_width, $this->image_height);
		
		$background_color = imagecolorallocate($image, 255, 255, 255);
		
		$arr_text_color = $this->hexrgb($this->text_color);
		$text_color 	= imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);
		
		$arr_noice_color   = $this->hexrgb($this->noise_color);
		$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);
		
		for ( $i=0; $i < $this->random_dots; $i++ ) {
			imagefilledellipse($image, mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), 2, 3, $image_noise_color);
		}
		
		for ( $i=0; $i < $this->random_lines; $i++ ) {
			imageline($image, mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), 
					mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), $image_noise_color);
		}
		
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x 		= ($this->image_width - $textbox[4]) / 2;
		$y 		= ($this->image_height - $textbox[5]) / 2;
		
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		
		if ( $sess_write ) {
			$this->CI->session->set_userdata('captcha_code', $code);
		}
		
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		
	}
	
	private function hexrgb( $hexstr ) {
	
		$int = hexdec($hexstr);
		return array(
					"red" => 0xFF & ($int >> 0x10),
					"green" => 0xFF & ($int >> 0x8),
					"blue" => 0xFF & $int
				);
	}
	
	private function equation() {
		
		$equation  = '';
		$operators = array();
		$operators = array('+', '-');
		
		for ( $i = 1; $i <= $this->operand_count; $i++) {
			
			$equation .= mt_rand(10, 100);
			if ($i < $this->operand_count) $equation .= $operators[array_rand($operators)];
			
		}
		
		$ans = '';
		eval("\$ans" . '=' . $equation . ';');
		
		$this->CI->session->set_userdata('captcha_code', $ans);
		if ($ans and $this->CI->session->userdata('captcha_code') == $ans) {
			$this->random_dots = 0;
			$this->random_lines = 0;
			$this->image($equation . '=');
		}
	
		
	}
}