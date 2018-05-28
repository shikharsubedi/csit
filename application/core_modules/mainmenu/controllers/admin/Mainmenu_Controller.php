<?php
use mainmenu\models\Mainmenu,
	Doctrine\Common\Util\Debug;


class Mainmenu_Controller extends Admin_Controller
{
	var $tokenId = '';
	
	public function __construct()
	{
		parent::__construct();
		
		if(!user_access('administer mainmenu'))
			admin_redirect();
		
		$this->load->library('form_validation');
		$this->load->model('mainmenu/mainmenu_model','mm');
		
		// $this->tokenId 		= get_tokenID();	
		$this->templatedata['tokenId'] = $this->tokenId;
		
		$this->breadcrumb->append_crumb('Mainmenu', admin_url('mainmenu'));
	}
	
	public function index()
	{
		$this->load->helper('mainmenu/mainmenu');
		$menu = _getMenuTree();		

		if($this->input->post())
		{
			if($this->input->post('token_id') !='' and $this->input->post('token_id') !=$this->tokenId)
				admin_redirect();
			
			$this->mm->_process_tree();
			
			$this->session->set_success_flashdata('feedback', 'Mainmenu saved successfully.');
				admin_redirect('mainmenu');			
		}
		
		array_push($this->templatedata['scripts'],'jquery.ui.nestedSortable');
		//array_push($this->templatedata['scripts'],'json');
		$this->templatedata['tree'] = &$menu;
		$this->templatedata['maincontent'] = 'mainmenu/admin/index';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function add()
	{
		
		if($this->input->post())
		{
			if($this->input->post('token_id') !='' and $this->input->post('token_id') !=$this->tokenId)
				admin_redirect();
			
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
			if($this->form_validation->run($this))
			{
				
				$data = array(	"name"			=>	$this->input->post('menu_name'),
								"type"			=>	$this->input->post('menu_type'),
								"isactive"		=>	$this->input->post('isActive'),
								"permalink"		=>	$this->input->post('target_url'),
								"page_id"		=>	$this->input->post('page_id'),
								"attributes"	=>	$this->input->post('attributes'));
									
				if($_FILES['img_file']['name'] != '')
				{
					//upload the file
					$config['upload_path'] = './assets/upload/images/mainmenu/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '400';
					$config['max_width']  = '920';
					$config['max_height']  = '370';	
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('img_file'))
					{
						$this->templatedata['upload_error'] = $this->upload->display_errors();
					}
					else
					{
						$up_data = $this->upload->data();
					
						$data['image'] = $up_data['file_name'];
					}
					
				}
				
				if($this->mm->add($data)){
					$this->session->set_success_flashdata('feedback', 'Menu Item added successfully.');
					admin_redirect('mainmenu');
				}
		
			}
		}
		
		$this->templatedata['pages'] =& $this->page->listPages();
		$this->breadcrumb->append_crumb('Add Mainmenu', admin_url('mainmenu/add'));
		$this->templatedata['maincontent'] = 'mainmenu/admin/add';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function edit($id)
	{
		$this->templatedata['menus'] = $this->mm->listMenu();
		
		$this->templatedata['menu'] = $this->mm->getMenu($id);
		
		if($this->input->post())
		{
			
			if($this->input->post('token_id') !='' and $this->input->post('token_id') !=$this->tokenId)
				admin_redirect();
			
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
			if($this->form_validation->run($this))
			{
				$data = array(	"name"			=>	$this->input->post('menu_name'),
								"isactive"		=>	$this->input->post('isActive'),
								"type"			=>	$this->input->post('menu_type'),
								"permalink"		=>	$this->input->post('target_url'),
								"page_id"		=>	$this->input->post('page_id'),
								"attributes"	=>	$this->input->post('attributes'));
				if($_FILES['img_file']['name'] != '')
				{
					//upload the file
					$config['upload_path'] = './assets/upload/images/mainmenu/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '400';
					$config['max_width']  = '920';
					$config['max_height']  = '370';	
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('img_file'))
					{
						$this->templatedata['upload_error'] = $this->upload->display_errors();
					}
					else
					{
						$up_data = $this->upload->data();
					
						$data['image'] = $up_data['file_name'];
						//delete the old files
						$oldfile = './assets/upload/images/mainmenu/'.$this->templatedata['menu']->image;
						
						@unlink($oldfile);
					}
					
				}
				if($this->mm->update($data,$id)){
					$this->session->set_success_flashdata('feedback', 'Menu Item saved successfully.');
					admin_redirect('mainmenu');
				}
			}
		}
		$this->templatedata['pages'] =& $this->page->listPages();
		$this->breadcrumb->append_crumb('Edit Mainmenu', admin_url('mainmenu/edit'));
		$this->templatedata['maincontent'] = 'mainmenu/admin/edit';
		$this->load->view('admin/master',$this->templatedata);
	}
	
	public function delete($id)
	{
		
		
		$this->db->where('id',$id);
		$this->db->delete('mainmenu');
		$this->session->set_success_flashdata('feedback', 'The menu item was deleted successfully.');
		
		admin_redirect('mainmenu');
	}
}