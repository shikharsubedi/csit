<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Slider_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get($id = NULL,$activeOnly = FALSE)
	{
		if($id != NULL)
			$this->db->where('sn',$id);
			
		if($activeOnly != FALSE)
			$this->db->where('isactive','Y');
		
		$this->db->order_by('order','asc');
		return $this->db->get('slider');
	}
	
	
	public function insert($data = array())
	{
		$this->db->insert('slider',$data);
		return $this->db->insert_id();
	}
	
	public function update($data = array(),$id)
	{
		$this->db->where('sn',$id);
		return $this->db->update('slider',$data);
	}
	
}