<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Xhr
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function setActivate()
	{
		$sn = $this->input->post('id');
		$value = $this->input->post('value');
		
		$data = array(	'is_active'	=>	$value);
		
		$this->db->where('id',$sn);
		$this->db->update('popup',$data);
		
	}
}