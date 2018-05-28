<?php

function theme_url()
{
	$current_theme = CI::$APP->config->item('current_theme');
	$path = base_url().'assets/themes/'.$current_theme.'/';
	
	return $path;
}


function theme_path()
{
	$current_theme = CI::$APP->config->item('current_theme');
	$path = './assets/themes/'.$current_theme.'/';
	
	return $path;
}

function get_header()
{
	//$current_theme = CI::$APP->config->item('current_theme');
	//$path = './assets/themes/'.$current_theme.'/header';
	CI::$APP->load->theme('header');
}
function get_rightfirst()
{
	//$current_theme = CI::$APP->config->item('current_theme');
	//$path = './assets/themes/'.$current_theme.'/header';
	CI::$APP->load->theme('right-first');
}

function get_rightsecond()
{
	//$current_theme = CI::$APP->config->item('current_theme');
	//$path = './assets/themes/'.$current_theme.'/header';
	CI::$APP->load->theme('right-second');
}

function get_rightthird()
{
	//$current_theme = CI::$APP->config->item('current_theme');
	//$path = './assets/themes/'.$current_theme.'/header';
	CI::$APP->load->theme('right-third');
}

function get_middle()
{
	CI::$APP->load->theme('middle');
}
function  get_right()
{
        CI::$APP->load->theme('right');
}

function get_bottom()
{
	CI::$APP->load->theme('bottom');
}

function get_footer()
{
	CI::$APP->load->theme('footer');
}

function get_insidesidebar()
{
	CI::$APP->load->theme('insidesidebar');
}

function get_contact()
{
	CI::$APP->load->theme('contact_front');
}

function get_slogan(){
	CI::$APP->load->theme('slogan');
}
	
function get_right_bar()
{
	CI::$APP->load->theme('right_bar');
}

function get_academic(){
	CI::$APP->load->theme('academic');
}	

function get_academic_right_bar(){
	CI::$APP->load->theme('academic_right_bar');
}	

function get_why_us(){
	CI::$APP->load->theme('why_us');
}	


/**
*	global function to get the theme configs
*	defined in template.php within the theme
*/
function _t($config)
{
	$args = func_get_args();
	$current_theme = CI::$APP->config->item('current_theme');
	$function = $current_theme.'_'.$config;
	
	if(function_exists($function))
		return call_user_func_array($function,array_slice($args, 1));
	else return FALSE;
}


function select_country($selected = 'nepal')
{
	CI::$APP->db->select('id,name');
	$res = CI::$APP->db->get('dtn_country');
	$html = '';
	foreach($res->result() as $c)
	{
		$sel = (strtolower($selected) == strtolower($c->name)) ? ' selected="selected"':'';
		$html .= "<option value='{$c->name}'{$sel}>{$c->name}</option>";
	}
	
	return $html;
}
?>