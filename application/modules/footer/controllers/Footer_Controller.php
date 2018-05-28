<?php

class Footer_Controller extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
		
		$footerRepo = $this->doctrine->em->getRepository('footer\models\Footer');
		$groups 	= $footerRepo->getGroups(NULL,TRUE);
		
		foreach ($groups as $g) {
			$data['group'] 		= $g['name'];
			$data['footers'] 	= $footerRepo->getFooters($g['id'],TRUE);
			$this->load->view('footer/front/footer',$data);			
		}
	}
	
	public function _data() {
		
		$footerRepo		= $this->doctrine->em->getRepository('footer\models\Footer');
		$footerGroups 	= $footerRepo->getGroups(NULL, TRUE);
		foreach ($footerGroups as &$g) {
			$g['footers'] = $footerRepo->getFooters($g['id'], TRUE);
		}
		
		return $footerGroups;
	}
	
		
	public function _remap($method)
	{
		show_404();
	}
}
?>