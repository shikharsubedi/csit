<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use content\models\Content;

class Content_Controller extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
                $this->load->library('session');
        $this->_t['sitetitle'] = $this->_CONFIG['admin_name'];
	}
	
	public function index($slug=NULL)
	{ 
		$contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
		$content = $contentRepo->findBySlug($slug);
		if($content)
		{
                   
			global $_content,$_title,$_ID,$_type;
			
			$_content = $content['body'];
			$_title = $content['title'];
			$_ID = $content['id'];
			$_type = $content['type'];
			
			$this->_t['content'] = &$content;
			$this->_t['title'] = ucfirst($_title);

			$scrolltitle = (Options::get('scrolltitle','NO')=='YES') ? true:false;
			$this->_t['scrolltitle'] = $scrolltitle;
                        $this->_t['sitetitle'] = $_title;
			$content_ = &$this->doctrine->em->find('content\models\Content',$_ID);
			$meta = &$content_->getTags();
			$tags = array();
			
			$this->_t['meta'] = $contentRepo->getMetaData($_ID);
                       

			$this->load->theme('single',$this->_t);
		}
		else show_error("The page you are looking for does not exist.");
	}
	
	public function category($slug,$offset = 0)
	{
		$perpage = ($slug =='news-updates') ? 6 : 20;
		
		$contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
		$contents = $contentRepo->findContentByCategorySlug($slug,$perpage,$offset);
		
		if($contents)
		{
			$numContent = $contents['total'];
			if($numContent > $perpage)
			{
				$this->load->library('pagination');
				
				$config['base_url'] = base_url()."content/category/$slug";
				$config['total_rows'] = $numContent;
				$config['per_page'] = $perpage;
				$config['uri_segment'] = 4;
				$config['prev_link'] = 'Previous';
				$config['next_link'] = 'Older';
				
				$this->pagination->initialize($config);
				$pg = $this->pagination->create_links();
				$this->_t['pagination'] = $pg;
			}
			
			$termRepo = &$this->doctrine->em->getRepository('content\models\Term');
			$category = $termRepo->findOneBySlug($slug);
			//show_pre($category->getTaxonomy());exit;
			
			$this->_t['slug'] = $slug;
			$this->_t['category'] = $category;
			$this->_t['contents'] =& $contents['contents'];
			
			
			$theme = ($category->getSlug()=='news-updates') ? "categorylist" : "productlist";
			
			unset($category);
			
			$this->load->theme($theme,$this->_t);
		}else show_404();
		
	}

	public function exportToPDF($slug)
	{
		$contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
		$content = $contentRepo->findBySlug($slug);
		if($content)
		{
			global $_content,$_title,$_ID;
			
			$_content = $content[0]['body'];
			$_title = $content[0]['title'];

			$_ID = $content[0]['id'];
			
			$template = 'single_pdf';  

			$this->_t['content'] =& $content[0];
			$html = $this->load->theme($template,$this->_t,TRUE);
			
			include(APPPATH.'third_party/dompdf/dompdf_config.inc.php'); //give path to dompdf_config.inc.php
			$dompdf = new DOMPDF();
		  	$dompdf->load_html($html);
		  	
			//$dompdf->set_paper($_POST["paper"], $_POST["orientation"]); //optional param
		  	
			$dompdf->render();
		  	$dompdf->stream($_title.".pdf", array("Attachment" => true));
		}
	}
	
	public function emailContent($slug)
	{
		$this->_t['sent'] = FALSE;
		if($this->input->post('btn_send_mail'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('from', 'From', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('to', 'To', 'required');
			
			if($this->form_validation->run($this))
			{
			$this->load->library('email');
			$this->email->from($this->input->post('from'),$this->input->post('name'));
			$this->email->to($this->input->post('to')); 
			$this->email->subject($this->input->post('title'));
			$this->email->message($this->input->post('body'));	
			$this->email->send(); 
			$this->_t['sent'] = TRUE;
			}
		}

		$contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
		$content = $contentRepo->findBySlug($slug);

		if($content)
		{
			global $_content,$_title,$_ID;
			
			$_content = $content[0]['body'];
			$_title = $content[0]['title'];
			$_ID = $content[0]['id'];
			
			$this->_t['sent'] = FALSE;
			$this->_t['content'] =& $content[0];
			$this->load->theme('emailcontent',$this->_t);
		}
		
	}

	public function search() {
	 //show_pre($_POST);exit;
		$success=false; $try=0; $res = array();
		if ($this->input->post('searchText')) {
			$tags = $this->input->post('searchText');
			$tags = explode(' ',(strip_tags($tags)));
			//show_pre($tags);exit;
			if ($tags) {
				$tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
				$res =  array(); $stack = array();
				foreach ($tags as $t) {
					$t=trim($t);
					$conRepo = &$this->doctrine->em->getRepository('content\models\Content');
					$tag = $tagRepo->findOneByName($t);
					if ($tag) {
	
						$res_ = $conRepo->searchByTag($tag->getName());
						foreach ($res_ as $r) {
							$id = $r['id'];
							if ($r and !in_array($id,$stack)) {
								$res[$id] = $r; $success=true;
							}
							$stack[] = $id;
						}
					}
					if (strlen($t) > 3) {
	
						$res += $conRepo->freeSearch($t);
						if($res!=''){
							$success=true;
							}
					}
				}
			} $try++;
		}
                //echo "<pre>";
                //\Doctrine\Common\Util\Debug::dump($res);exit;
		$this->_t['tags']	=$this->input->post('searchText');
		$this->_t['result'] = $res;
		$this->_t['success'] = $success; $this->_t['try'] = $try;
		$this->load->theme('search', $this->_t);
	
	}
	
	public function categorys($slug,$offset = 0)
	{
		
		$termRepo = &$this->doctrine->em->getRepository('content\models\Term');
		$category = $termRepo->findOneBySlug($slug);
		$perpage = ($category->getSlug()=='news-updates') ? 3 : 4;	
		/*if($category->getSlug()=='deposits') {
			$perpage = 6;
			}*/
		//show_pre($slug);exit;
		$contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
		$contents = $contentRepo->findContentByCategorySlug($slug,$perpage,$offset);
		
		if($contents)
		{
			$numContent = $contents['total'];
			if($numContent > $perpage)
			{
				$this->load->library('pagination');
				
				$config['base_url'] = base_url()."content/category/$slug";
				$config['total_rows'] = $numContent;
				$config['per_page'] = $perpage;
				$config['uri_segment'] = 4;
				$config['prev_link'] = 'Previous';
				$config['next_link'] = 'Older';
				
				$this->pagination->initialize($config);
				$pg = $this->pagination->create_links();
				$this->_t['pagination'] = $pg;
			}
			
		
			$this->_t['slug'] = $slug;
			$this->_t['category'] = $category->getName();
			$this->_t['contents'] =& $contents['contents'];
			
			$theme = ($category->getSlug()=='news-updates') ? "category" : "products";
			
			unset($category);
			
			$this->load->theme($theme,$this->_t);
		}else show_404();
		
	}
	
	public function emi_calculator() {
		$this->load->theme('emi');
	}
	public function sitemap() {
		$this->load->theme('sitemap');
	}


		
}