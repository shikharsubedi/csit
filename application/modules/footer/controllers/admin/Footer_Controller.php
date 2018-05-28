<?php

use footer\models\Footer,
	footer\models\FooterGroup;


class Footer_Controller extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!user_access('administer footer'))
			admin_redirect();
		$this->breadcrumb->append_crumb('Footer', admin_url('footer'));
	}

	public function index(){

		$repo = &$this->doctrine->em->getRepository('footer\models\Footer');
		$groups = $repo->getGroups();

		if ($this->input->post('saveorder'))
		{
			$ord = explode('&',$this->input->post('order'));
			$start=0;
			foreach ($ord as $o) {
				$group = $this->doctrine->em->find('footer\models\FooterGroup',$o);
				$group->setOrder($start);
				$this->doctrine->em->persist($group);
				$start++;
			}
		$this->doctrine->em->flush();
		$this->session->set_success_flashdata('feedback', 'Footer Groups order sorted successfully.');
		admin_redirect('footer');
		}

		if($this->input->post('update')){

				$checked = $this->input->post('check');
				$action = $this->input->post('action');
				
				switch($action){
					case "publish":
						foreach($checked as $k => $v)
						{
							$grp = &$this->doctrine->em->find('footer\models\FooterGroup',$v);
							$grp->activate();
							$this->doctrine->em->persist($grp);
						}
					break;
					
					case "unpublish":
						foreach($checked as $k => $v)
						{
							$grp = &$this->doctrine->em->find('footer\models\FooterGroup',$v);
							$grp->deactivate();
							$this->doctrine->em->persist($grp);
						}
					break;
					
					default:
						foreach($checked as $k => $v)
						{
							$grp = &$this->doctrine->em->find('footer\models\FooterGroup',$v);
							if ($grp) $this->doctrine->em->remove($grp);
						}
						
				}
				
				$this->doctrine->em->flush();
				$this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
				admin_redirect('footer');
			}

		$this->templatedata['groups'] = $groups;
		$this->templatedata['maincontent'] = 'footer/admin/list';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	

################################################
## 			    GROUP FUNCTIONS                ##
################################################	
	
	public function addgroup()
	{
		$repo = &$this->doctrine->em->getRepository('footer\models\Footer');

		if($this->input->post())
		{
			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			if($this->form_validation->run($this))
			{
			
				$group = new FooterGroup;
				$group->setName($this->input->post('group_name'));
				($this->input->post('is_active')) ? $group->activate() : $group->deactivate();
				$this->doctrine->em->persist($group);
				$this->doctrine->em->flush();
				
				if($group->id())
				{
					$this->session->set_success_flashdata('feedback', 'Footer Group added successfully.');
					admin_redirect('footer');
				}
			}
		}
		
		$this->breadcrumb->append_crumb('Add a Group', admin_url('#'));
		$this->templatedata['maincontent'] = 'footer/admin/addgroup';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function editgroup($group_id)
	{
		$group = $this->doctrine->em->find('footer\models\FooterGroup',$group_id);
		
		if($this->input->post())
		{	
			$this->form_validation->set_rules('group_name', 'Name', 'required');
			if($this->form_validation->run($this))
			{
				$group->setName($this->input->post('group_name'));
				($this->input->post('is_active')) ? $group->activate() : $group->deactivate();
				$this->doctrine->em->persist($group);
				$this->doctrine->em->flush();
				
				$this->session->set_success_flashdata('feedback', 'Footer Group saved successfully.');
					admin_redirect('footer');
			}
		}
		
		$this->breadcrumb->append_crumb('Edit Group', admin_url('#'));
		$this->templatedata['group'] =& $group; 
		$this->templatedata['maincontent'] = 'footer/admin/editgroup';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}

	public function deletegroup($group_id)
	{
	$group = $this->doctrine->em->find('footer\models\FooterGroup',$group_id);	
	if ($group) {
		$this->doctrine->em->remove($group);
		$this->doctrine->em->flush();
		$this->session->set_success_flashdata('feedback', 'Footer Group deleted successfully.');
		}
	admin_redirect('footer');
	}



################################################
##		 	FOOTER LINK FUNCTIONS             ##
################################################
	
	public function viewfooters($group_id)
	{
		
		$ftrRepo = $this->doctrine->em->getRepository('footer\models\Footer');
		$footers = $ftrRepo->getFooters($group_id);
		
		$group = $ftrRepo->getGroups($group_id);
		$gname = $group[0]['name'];
		
		$this->breadcrumb->append_crumb('View Footer Links', admin_url('#'));
		
		if ($this->input->post('saveorder'))
		{
			$ord = explode('&',$this->input->post('order'));
			$start=0;
			foreach ($ord as $o) {
				$footer = $this->doctrine->em->find('footer\models\Footer',$o);
				$footer->setOrder($start);
				$this->doctrine->em->persist($footer);
				
				$start++;
			}
		$this->doctrine->em->flush();
		$this->session->set_success_flashdata('feedback', 'Footer Links order sorted successfully.');
		admin_redirect('footer/viewfooters/'.$group_id);
		}


		if ($this->input->post('update'))
		{
				$checked = $this->input->post('check');
				$action = $this->input->post('action');
				
				switch($action){
					case "publish":
						foreach($checked as $k => $v)
						{
							$ftr = &$this->doctrine->em->find('footer\models\Footer',$v);
							$ftr->activate();
							$this->doctrine->em->persist($ftr);
						}
					break;
					
					case "unpublish":
						foreach($checked as $k => $v)
						{
							$ftr = &$this->doctrine->em->find('footer\models\Footer',$v);
							$ftr->deactivate();
							$this->doctrine->em->persist($ftr);
						}
					break;
					
					default:
						foreach($checked as $k => $v)
						{
							$ftr = &$this->doctrine->em->find('footer\models\Footer',$v);
							if ($ftr) $this->doctrine->em->remove($ftr);
						}
						
				}
				
				$this->doctrine->em->flush();
				$this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
				admin_redirect('footer/viewfooters/'.$group_id);
		}


		$this->templatedata['group_id'] = $group_id;
		$this->templatedata['group'] = $gname;
		$this->templatedata['footers'] = $footers;
		
		$this->templatedata['maincontent'] = 'footer/admin/viewfooters';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	
	public function addfooter($group_id){
		
		$group = $this->doctrine->em->find('footer\models\FooterGroup',$group_id);

		$ftrRepo = $this->doctrine->em->getRepository('footer\models\Footer');
		//$tname = $ftrRepo->getFooters($group_id);
		//$tname = $tname[0]['name'];

		if($this->input->post())
		{
			$this->form_validation->set_rules('link_label', 'Link Label', 'required');
			
			if($this->form_validation->run($this))
			{	
				$footer = new Footer;
				//$this->load->helper('url');
				$footer->setTitle(trim($this->input->post('link_label')));
				//$u_ = ($this->input->post('target_url')!='' or $this->input->post('target_url')!='#');
				$u = ($this->input->post('type')=='external') ? trim($this->input->post('target_url')) : $this->input->post('target_page');
				$footer->setUrl($u);
				$footer->setType($this->input->post('type'));
				
				($this->input->post('is_active')) ? $footer->activate() : $footer->deactivate();
				
				//$group->addLink($footer);
				$footer->setGroup($group);
				
				$this->doctrine->em->persist($footer);
				$this->doctrine->em->persist($group);
				$this->doctrine->em->flush();
				
				if($footer->id())
				{
					$this->session->set_success_flashdata('feedback', 'New footer link added successfully.');
					admin_redirect('footer');
				}
			}
		}
		
		$this->breadcrumb->append_crumb($group->getName(), admin_url('footer/viewfooters/'.$group->id()));
		$this->breadcrumb->append_crumb('Add Footer Link', admin_url('#'));
		
		$this->templatedata['maincontent'] = 'footer/admin/addfooter';
		//$this->templatedata['tname'] = $tname;
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	
	public function editfooter($footer_id,$group_id=NULL)
	{
		
		$footer = $this->doctrine->em->find('footer\models\Footer',$footer_id);
		
		$ftrRepo = $this->doctrine->em->getRepository('footer\models\Footer');
		$gname = $ftrRepo->getFooters($group_id);
		//$gname = $gname[0]['name'];
		
	if($this->input->post())
		{
			$this->form_validation->set_rules('link_label', 'Link Label', 'required');
			
			if($this->form_validation->run($this))
			{
				$footer->setTitle(trim($this->input->post('link_label')));
				$u = ($this->input->post('type')=='external') ? trim($this->input->post('target_url')) : $this->input->post('target_page');
				$footer->setUrl($u);
				$footer->setType($this->input->post('type'));
				
				($this->input->post('is_active')) ? $footer->activate() : $footer->deactivate();
			
				$this->doctrine->em->persist($footer);
				$this->doctrine->em->flush();
				
				$this->session->set_success_flashdata('feedback', 'Footer Link details saved successfully.');
					admin_redirect('footer');
			}
		}
		
		$this->breadcrumb->append_crumb('Edit Footer Link', admin_url('#'));
		$this->templatedata['footer'] =& $footer; 
		$this->templatedata['maincontent'] = 'footer/admin/editfooter';
		$this->templatedata['gname'] = $gname;
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);	
	
		
	}
	
	public function deletefooter($footer_id)
	{
	$footer = $this->doctrine->em->find('footer\models\Footer',$footer_id);	
	if ($footer) {
		$this->doctrine->em->remove($footer);
		$this->doctrine->em->flush();
		$this->session->set_success_flashdata('feedback', 'Footer Link deleted successfully.');
		}
	admin_redirect('footer');	
	}
	
}
?>