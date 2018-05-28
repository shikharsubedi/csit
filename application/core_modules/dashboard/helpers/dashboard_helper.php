<?php
function the_dashboard()
{
	$order = Options::get('dashboardOrder_' . Current_User::user()->id(), '');
	$orders = explode('-',$order); 
	$shortcuts = Dashboardshortcut::$shortcuts; 

		foreach($orders as $s) 
		{
			if (empty($s) or $s=='') continue; 
			if(isset($shortcuts[$s]) and user_access($shortcuts[$s]['permission']))
			{
				echo '<li id="-'.$shortcuts[$s]['controller'].'"><a href="' .admin_url($shortcuts[$s]['controller']). '"><img src="' .base_url().'assets/images/'.$shortcuts[$s]['icon']. '"><span>' .$shortcuts[$s]['name']. '</span></a></li>';
				unset($shortcuts[$s]);
			}
		}

		foreach($shortcuts as $s) 
		{
			if(user_access($s['permission']))
			{
				echo '<li id="-'.$s['controller'].'"><a href="' .admin_url($s['controller']). '"><img src="' .base_url().'assets/images/'.$s['icon']. '"><span>' .$s['name']. '</span></a></li>';
			}
		}

}