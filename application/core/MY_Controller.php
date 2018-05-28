<?php use Symfony\Component\EventDispatcher\EventDispatcher;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends MX_Controller
{
	
	//var $templatedata = array();
	var $_CONFIG ;
	
	
	//var $dbFilters = array();
	
	public function __construct()
	{
		parent::__construct();
		
		\CI::$APP->eventDispatcher = new EventDispatcher();
		
		// see if the options table exists
		$this->load->helper('content/content');
		//if not create it.
		if(!$this->db->table_exists($this->config->item('options_table')))
			$this->createOptionsTable();
			
		if(!$this->db->table_exists($this->config->item('sess_table_name')))
			$this->createSessionTable();
		
		//parent::__construct();
		$this->_CONFIG = Options::get('siteconfig');
		
		//get the current theme settings
		$current_theme = $this->config->item('current_theme');
		$template_path = './assets/themes/'.$current_theme.'/';
		Modules::load_file('template'.EXT,$template_path);
		
		foreach (Modules::$locations as $location => $offset)
		{		
			$dh = opendir($location);
			while($file = readdir($dh))
			{
				$path = $location.$file;
				if($file != "." AND $file != ".." AND is_dir($path))
				{
					$module = $file;
					if(file_exists($path."/setup.php"))
					{
						Modules::load_file("setup.php",$path.'/');
					}
				}
			}
		}
	}
	
	public function addFilter($key,$value)
	{
		global $db_filters;
		array_push($db_filters,array($key => $value));
	}
	
	
	function createOptionsTable()
	{
		$this->load->dbforge();
		$this->dbforge->add_field("id");
		$this->dbforge->add_field("`option_name` VARCHAR(100) NOT NULL");
		$this->dbforge->add_field("`option_value` TEXT NOT NULL");
		$this->dbforge->add_field("`autoload` TINYINT(1) NOT NULL DEFAULT '1'");
		$this->dbforge->add_key('option_name', TRUE);
		
		$this->dbforge->create_table($this->config->item('options_table'));
		
		$this->db->query("CREATE UNIQUE INDEX IDX_option_name ON dtn_options (option_name); ");
	}
	
	function createSessionTable()
	{
		$this->load->dbforge();
		$this->dbforge->add_field("`session_id` VARCHAR(40) NOT NULL DEFAULT '0'");
		$this->dbforge->add_field("`ip_address` VARCHAR(16) NOT NULL DEFAULT '0'");
		$this->dbforge->add_field("`user_agent` VARCHAR(50) NOT NULL");
		$this->dbforge->add_field("`last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0'");
		$this->dbforge->add_field("`user_data` TEXT NOT NULL");
		$this->dbforge->add_key('session_id', TRUE);
		
		$this->dbforge->create_table($this->config->item('sess_table_name'));
	}
	
	public function verifyCaptcha( $str ) {
	
		$code = $this->session->userdata('captcha_code');
		if (strcasecmp($code,$str) == 0) {
			$this->session->unset_userdata('captcha_code');
			return TRUE;
		} else {
			$this->session->unset_userdata('captcha_code');
			$this->form_validation->set_message('verifyCaptcha', 'The Captcha Code is Wrong.<br/>');
			return FALSE;
		}
	}
}