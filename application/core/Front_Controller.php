<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_Controller extends MY_Controller
{
	var $_t = array();
	
	public function __construct()
	{
		parent::__construct();

		$maintenance = Options::get('site_maintenance','NO');
		$maintenance = ($maintenance=='YES') ? TRUE : FALSE;
		
		if ($maintenance) {
			if (!$this->checkAdmin()) $this->load->theme('maintain');
			$this->_t['site_maintenance'] = TRUE;
		}
		$this->load->library('parser');
		$this->_t['scripts'] = array();
		$this->_t['styles'] = array();
		
		$this->_t['siteconfig'] = $this->_CONFIG;
		$this->_t['isHomePage'] = FALSE;
	}


	public function checkAdmin() {

		$this->load->library('session');
		$sessID = $this->session->userdata('session_id');
		
		$this->load->database();
		$query = $this->db->query("SELECT user_data FROM dtn_sessions 
					WHERE session_id = '$sessID' LIMIT 1");
		$result = $query->row_array();

		if (isset($result['user_data'])) {
			$data = unserialize($result['user_data']);
			if (isset($data['user_id']) and is_numeric($data['user_id'])) {
				return TRUE;
			}
		}
		else return FALSE;
	}

}

