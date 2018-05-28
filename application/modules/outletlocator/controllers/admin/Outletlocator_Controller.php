<?php

use outletlocator\models\Outlet;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OutletLocator_Controller extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		if(!user_access('administer outlets'))
			admin_redirect();
		
		$this->breadcrumb->append_crumb('Outlets', admin_url('outletlocator'));
	}
	
	public function index($offset = 0)
	{	
	
		$per_page = 20;
		$filters = array();
		$outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
		
		$outlets = $outlet_repo->getOutlets($offset,$per_page,$filters);
		//echo "test";exit;
		$numOutlets = $outlets['total'];
		
		if($numOutlets > $per_page)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = admin_base_url()."outletlocator/index";
			$config['total_rows'] = $numOutlets;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 4;
			$config['prev_link'] = 'Previous';
			$config['next_link'] = 'Next';
			$this->pagination->initialize($config);
			$this->templatedata['pagination'] = $this->pagination->create_links();
		}
		$this->templatedata['outlets'] = $outlets['outlets'];
		$this->templatedata['maincontent'] = 'outletlocator/admin/list';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function add()
	{
		
		$outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
		if($this->input->post())
		{
			$lat = $this->input->post('lat');
			//echo $lat;exit;
			$_out = new Outlet($this->input->post('name'));
			$_out->setLocation($this->input->post('location'));
			$_out->setLatitude($this->input->post('lat'));
			$_out->setLongitude($this->input->post('long'));
			$_out->setDescription($this->input->post('description'));
			$_out->setPhone($this->input->post('phone'));
			$_out->setEmail($this->input->post('email'));
			
			
			
			$this->doctrine->em->persist($_out);
			$this->doctrine->em->flush();
			
			if($_out->id()){
				$this->session->set_success_flashdata('feedback', 'Outlet added successfully.');
				admin_redirect('outletlocator');
			}
		}
		
		$this->breadcrumb->append_crumb('Add an Outlet', admin_url('outletlocator/add'));
		
		$this->templatedata['maincontent'] = 'outletlocator/admin/add';
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function edit($id)
	{
		$outlet_repo = &$this->doctrine->em->getRepository('outletlocator\models\Outlet');
		$outlet = &$this->doctrine->em->find('outletlocator\models\Outlet',$id);
		if($this->input->post())
		{
			//echo $this->input->post('lat');exit;
			$outlet->setName($this->input->post('name'));
			$outlet->setLocation($this->input->post('location'));
			$outlet->setLatitude($this->input->post('lat'));
			$outlet->setLongitude($this->input->post('long'));
			$outlet->setDescription($this->input->post('description'));
			$outlet->setPhone($this->input->post('phone'));
			$outlet->setEmail($this->input->post('email'));
			
			$this->doctrine->em->persist($outlet);
			$this->doctrine->em->flush();
			
			$this->session->set_success_flashdata('feedback', 'Outlet updated successfully.');
			admin_redirect('outletlocator');
		}
		
		$this->breadcrumb->append_crumb('Edit an Outlet', admin_url('outletlocator/edit'));
		
		$this->templatedata['maincontent'] = 'outletlocator/admin/edit';
		$this->templatedata['outlet'] = $outlet;
		$this->templatedata['flashdata'] = $this->session->flashdata('feedback');
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function delete($id)
	{
		$outlet = &$this->doctrine->em->find('outletlocator\models\Outlet',$id);
		$this->doctrine->em->remove($outlet);
		$this->doctrine->em->flush();
		admin_redirect('outletlocator');
	}

}