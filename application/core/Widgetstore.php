<?php
class Widgetstore
{
	
	public static $dashboard_widgets = array();
	
	public static $sidebar_widgets = array();
	
	static function register_dashboard_widget($widget = array())
	{
		array_push(self::$dashboard_widgets,$widget);
	}
	
	
	static function render_dashboard()
	{
		if(count(self::$dashboard_widgets) == 0)
			return '';
				
		foreach(self::$dashboard_widgets as $w)
		{
			$controller = $w['controller'];
			$permissions = $w['permissions'];
			
			if(!user_access($permissions))
				continue;
			
			//render the header first for the controls
			
			Widget::run($controller);
		}
	}
}
?>