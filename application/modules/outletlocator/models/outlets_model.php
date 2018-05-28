<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Outlets_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getActive()
	{
		//qry = "";
		$this->db->where('isactive',"Y");
		return $this->db->get('outlet_locations');
	}
	
	
	public function getCategorised()
	{
		$ret = array();
		
		$this->db->where('type','atm');
		$ret['atms'] = $this->db->get('outlet_locations')->result();
		
		$this->db->where('type','branch');
		$ret['branches'] = $this->db->get('outlet_locations')->result();
		
		return $ret;
	}
}