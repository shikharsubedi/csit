<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Xhr
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
			
			$this->db->update('mainmenu',$data);
		}
	}
	
	public function setActivate()
	{
		$sn = $this->input->post('id');
		$value = $this->input->post('value');
		
		$data = array(	'isactive'	=>	$value);
		
		$this->db->where('id',$sn);
		$this->db->update('mainmenu',$data);
		
	}
	
	public function updateHeirarchy()
	{
		
		$menu_id = $this->input->post('id');
		$parent_id = $this->input->post('parent_id');
		
		$this->db->where('id',$menu_id);
		$this->db->update('mainmenu',array('parent_id'	=>	$parent_id));
		
		
		/*$arr	=	explode('||',$this->input->post('data'));
		
		foreach($arr as $a)
		{
			$s = explode('|',$a);
			$parent_id = $s[0];
			
			$children = explode(',',$s[1]);
			
			foreach($children as $c)
			{
				$this->db->where('id',$c);
				$this->db->update('mainmenu',array('parent_id'	=>	$parent_id));
			}
		}*/
		
	}
}