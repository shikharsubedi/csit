<?php

class SideMenu
{
	public static $sidemenu = array();
	
	public function register($menuName , $details = array())
	{
		if(isset(self::$sidemenu[$menuName])){
			show_error("The menu named $menuName already exists.");
			return;
		}
		$parent_id = $details['parent'];
		if($parent_id == NULL){
			self::$sidemenu[$menuName] = $details;
			return;
		}else{
			//echo $parent_id;exit;
			if(isset(self::$sidemenu[$parent_id]))
			{
				if(!isset(self::$sidemenu[$parent_id]['children']))
					self::$sidemenu[$parent_id]['children'] = array();
				
				self::$sidemenu[$parent_id]['children'][$menuName] = $details;
			}else{
				show_error("The specified parent menu $parent_id does not exist.");
			}
		}
		
	}
}
?>