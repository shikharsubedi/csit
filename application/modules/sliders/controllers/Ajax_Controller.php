<?php
use slider\models\Slider;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controller extends Xhr
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function updateOrder()
	{
		sleep(3);
		$arr	=	explode('|',$this->input->post('ordering'));
		
		for($i=0; $i<count($arr);$i++)
		{
			$slider = $this->doctrine->em->find('slider\models\Slider',$arr[$i]);
			$slider->setOrder($i+1);
			$this->doctrine->em->persist($slider);
		}
		
		$this->doctrine->em->flush();
	}
	
	public function setActivate()
	{
		$sn = $this->input->post('id');
		$value = $this->input->post('value');
		
		$data = array(	'isactive'	=>	$value);
		
		$this->db->where('sn',$sn);
		$this->db->update('slider',$data);
		
	}
}