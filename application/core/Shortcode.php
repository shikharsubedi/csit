<?php

class Shortcode{
	
	static $shortcodes = array();
	
	
	static function register($shortcode,$function)
	{
		self::$shortcodes[$shortcode] = $function;
	}
	
	static function run($shortcode,$args = NULL)
	{
		//show_pre($args);
		if(isset(self::$shortcodes[$shortcode])){
			$_method = self::$shortcodes[$shortcode];
			return call_user_func($_method,$args);
			//return "Hi";
		}
		else return FALSE;
	}
}
?>