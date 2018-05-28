<?php
use content\models\Content,
	Doctrine\Common\Util\Debug;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Controller extends Admin_Controller
{
	public function __construct()
	{
		$this->mainmenu = MAINMENU_CONTENT;
		
		parent::__construct();
		//check for permissions
		if(!user_access('administer content'))
			admin_redirect();
			
		$this->breadcrumb->append_crumb('Content', admin_url('content'));
		$this->breadcrumb->append_crumb('Categories', admin_url('content/category'));
	}
	
	public function index($offset = 0)
	{
		$this->templatedata['maincontent'] = 'content/admin/cat_list';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function add()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('cat_name','Category Name', 'required');
			if($this->form_validation->run($this)){
				$_new_term = new \content\models\Term($this->input->post('cat_name'));
				$_new_taxonomy = new \content\models\Taxonomy($_new_term,TAXONOMY_CATEGORY);
				
				if($this->input->post('parent_cat') != 0)
				{
					$_parent = $this->doctrine->em->find('content\models\Taxonomy',$this->input->post('parent_cat'));
					$_new_taxonomy->setParent($_parent);
				}
				
				$this->doctrine->em->persist($_new_term);
				$this->doctrine->em->persist($_new_taxonomy);
				
				$this->doctrine->em->flush();
				
				if($_new_taxonomy->id())
				{
					$this->session->set_success_flashdata('feedback', 'Category added successfully.');
						admin_redirect('content/category');
				}
			}
		}
		$this->breadcrumb->append_crumb('Add Category', admin_url('#'));
		$this->templatedata['maincontent'] = 'content/admin/add_cat';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function edit($cat_id)
	{
		$category = $this->doctrine->em->find('content\models\Taxonomy',$cat_id);
		if($this->input->post())
		{
			$this->form_validation->set_rules('cat_name','Category Name', 'required');
			if($this->form_validation->run($this)){
				
				$category->getTerm()->setName($this->input->post('cat_name'));
				
				$parent = $this->input->post('parent_cat');
			//	$_parent = $category->getParent();
			//	if($_parent && $_parent->id() != $parent)
			//	{
						$_new_parent = $this->doctrine->em->find('content\models\Taxonomy',$parent);
						$category->setParent($_new_parent);
			//	}
				
				$this->doctrine->em->persist($category);
				$this->doctrine->em->flush();
				
				$this->session->set_success_flashdata('feedback', 'Category saved successfully.');
					admin_redirect('content/category');
			}
		}
		
		$this->breadcrumb->append_crumb('Edit Category', admin_url('#'));
		$this->templatedata['category'] = $category;
		$this->templatedata['maincontent'] = 'content/admin/editcat';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function delete($cat_id)
	{
		$category = $this->doctrine->em->find('content\models\Taxonomy',$cat_id);
		
		//Find all the contents and set category 1
		foreach($category->getContents() as $c)
		{
			if($c->getTaxonomy()->count() == 1)
			//assign them to the default category
			$_default = $this->doctrine->em->find('content\models\Taxonomy',1);
			$c->setTaxonomy($_default);
			
			$c->removeTaxonomy($category);
			$this->doctrine->em->persist($c);
			
		}
		
		$this->doctrine->em->remove($category);
		$this->doctrine->em->flush();
		
		$this->session->set_success_flashdata('feedback', 'Category deleted successfully.');
			admin_redirect('content/category');
	}
}
?>