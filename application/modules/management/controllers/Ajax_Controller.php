<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controller extends Xhr
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function updateOrder()
	{
		/*$arr	=	explode('|',$this->input->post('order'));
		
		for($i=0; $i<count($arr);$i++)
		{
			$this->db->where(	array(	'id'	=>	$arr[$i]));
			
			$data = array(	'orderby'	=>	$i+1);
			
			$this->db->update('mgmt-team',$data);
		}*/
		
		echo "asdasd";
	}
	
}