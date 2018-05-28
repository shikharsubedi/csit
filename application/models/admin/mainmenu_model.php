<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainmenu_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAll()
	{
		$this->db->order_by('orderby');
		$res = $this->db->get('mainmenu');
		$ret = array();
		foreach($res->result() as $row)
		{
			$table = "category";
			if($row->linktype == 'article') $table = 'articles';
			if($row->linktype == 'page') $table = 'page';
			
			if($table == 'category' || $table == 'articles')
			{
				$this->db->where('id',$row->targetid);
				//$this->db->select('title');
				$targetRes = $this->db->get($table);
				$row->targetDetails = $targetRes->row();
				
			}
			$ret[] = $row;
		}
		return $ret;
	}
	
	public function getAllFront()
	{
		$this->db->order_by('orderby');
		$this->db->where('isactive','Y');
		$res = $this->db->get('mainmenu');
		$ret = array();
		
		foreach($res->result() as $row)
		{
			$table = "category";
			if($row->linktype == 'article') $table = 'articles';
			if($row->linktype == 'page') $table = 'page';
			
			if($table == 'category' || $table == 'articles')
			{
				$this->db->where('id',$row->targetid);
				$targetRes = $this->db->get($table);
				$row->targetDetails = $targetRes->row();
				
			}
			
			if($table == 'category')
			{
				//get the subcategories and the articles
				$ci =& get_instance();
				$ci->load->model('admin/category_model','categories');
				if($ci->categories->_hasChildren($row->targetid))
				{
					$row->subMenuCat = array();
					$children = $ci->categories->_getChildren($row->targetid);
					foreach($children->result() as $ch)
					{
						//$ch->numarticle = $ci->categories->_getNumArticles($ch->id);
						//get the articles in each subcat
						$sql = "select 
									 a.id,a.title,a.prettyurl
								from 
									articles a,article_category b
								where
									a.id = b.article_id
									and a.published = 'Y'
									and b.category_id = $ch->id";
						//$this->db->select('id,title,prettyurl');
						//$this->db->where('');
						//$this->db->get('articles');
						$ch->articles = $this->db->query($sql);
						//$ci->load->model('admin/articles_model','articles');
						//$ch->articles = $ci->articles->getAllinCategory(0,1000,$ch->id);
						$row->subMenuCat[] = $ch;
					}
				}
				else{
					//the category doesnot have subcategories but has articles
					$sql = "select 
								 a.id,a.title,a.prettyurl
							from 
								articles a,article_category b
							where
								a.id = b.article_id
								and a.published = 'Y'
								and b.category_id = $row->targetid";
					$row->articles = $this->db->query($sql);
				}
			}
			$ret[] = $row;
		}
		
		return $ret;
	}
	
	public function add($data = array())
	{
		return $this->db->insert('mainmenu',$data);
	}
}