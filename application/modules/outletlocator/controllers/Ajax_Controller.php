<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controller extends Xhr
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getOutlets()
	{
		
		$outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
		
		$type = $this->input->post('type');
		$target = $this->input->post('target');
		
		$filter = array();
		
		
		$filter['type'] = $type;
		
		$filter['regions'] = $target;
		
		$outlets = $outlet_repo->getOutletsSearch($filter);
		
		if(count($outlets) > 0)
			echo json_encode($outlets);
		else echo 0;
	}
	
	public function getDistricts()
	{
		$type = $this->input->post('type');
		$outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
		$districts = $outlet_repo->getSpecificDistricts($type);
		
		if(count($districts) > 0)
			echo json_encode($districts);
		else echo 0;
	}
}