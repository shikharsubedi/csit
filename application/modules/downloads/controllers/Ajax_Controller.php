<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controller extends Xhr
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function updateOrder()
	{
		$arr	=	explode('|',$this->input->post('ordering'));
		
		for($i=0; $i<count($arr);$i++)
		{
			$this->db->where(	array(	'id'	=>	$arr[$i]));
			
			$data = array(	'orderby'	=>	$i+1);
			
			$this->db->update('dtn_download_category',$data);
		}
	}
	
	public function updateDownloadOrder()
	{
		$arr	=	explode('|',$this->input->post('ordering'));
		
		for($i=0; $i<count($arr);$i++)
		{
			$this->db->where(	array(	'id'	=>	$arr[$i]));
			
			$data = array(	'orderby'	=>	$i+1);
			
			$this->db->update('dtn_download',$data);
		}
	}
	
	public function setActivate()
	{
		$sn = $this->input->post('id');
		$value = $this->input->post('value');
		
		$data = array(	'status'	=>	$value);
		
		$this->db->where('id',$sn);
		$this->db->update('dtn_download_category',$data);
		
	}
	
	public function setActivateItem()
	{
		$sn = $this->input->post('id');
		$value = $this->input->post('value');
		
		$data = array(	'status'	=>	$value);
		
		$this->db->where('id',$sn);
		$this->db->update('dtn_download',$data);
		
	}
	
	public function setQuickLinks()
	{
		$id = $this->input->post('id');
		$chk = $this->input->post('chk');
		$status = ($chk == 'true') ? 1 : 0;
		
		$data = array(	'showFront'	=>	$status);
		
		$this->db->where('id',$id);
		$this->db->update('dtn_download',$data);
		
	}
}