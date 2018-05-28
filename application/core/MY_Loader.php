<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	
	public function theme($view, $vars = array(), $return = FALSE) {
		//CI::$APP->router->fetch_module();
		$current_theme = CI::$APP->config->item('current_theme');
		
		//echo $current_theme;exit;
		$path = './assets/themes/'.$current_theme.'/';
		
		//list($path, $view) = Modules::find($view, $this->_module, 'views/');
		$this->_ci_view_path = $path;
		
		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}	
	
	
}