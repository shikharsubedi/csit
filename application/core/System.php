<?php

class System
{
	
	public static function init()
	{
		//initialize the options
		//Options::__init();
		//initialize the admin main menu
		
		
		
		//read modules information
		CI::$APP->benchmark->mark('Module_read_start');
		ModuleManager::readModules();
		
		CI::$APP->benchmark->mark('Module_read_end');
		
		//read the theme and apply the theme specific settings
		CI::$APP->benchmark->mark('Themeprepare_start');
		
		CI::$APP->benchmark->mark('Themeprepare_end');
		
	}
}
?>