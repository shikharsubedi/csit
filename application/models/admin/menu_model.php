<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menu_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function getMenu($menu_id = 1,$position = 't')
	{
		$sql = "SELECT
					a.menu_id,
					a.parent_id,
					a.menu_name,
					a.menu_link,
					a.menu_position,
					a.menu_class,
					a.shortcut_name
					
				FROM
					menu a
				JOIN user_menu b ON(a.menu_id = b.menu_id)
				
				WHERE ";
			if($position == 't') $sql .= "a.menu_class NOT IN ('H') AND ";
			$sql .=	"b.user_id = ".$this->session->userdata('user_id')." 
					AND a.menu_position = '".$position."' 
					AND a.parent_id = ".$menu_id."
				GROUP BY a.menu_id ORDER BY a.menu_order ASC";//a.menu_class NOT IN ('H') 					AND
		$query = $this->db->query($sql);
		
		$menu = array();
		//$count = 0;
		foreach ($query->result() as $row)
		{
			
			if($this->_has_submenu($row->menu_id))
			{
				$row->sub = $this->getMenu($row->menu_id,$position);
			}
			$menu[] = $row;
		}
		
		return $menu;
	}
	
	public function getShortcuts()
	{
		$Sql = "
			select
				um.user_id,
				um.menu_id,
				m.menu_name,
				m.shortcut_name,
				m.menu_link,
				m.menu_class,
				case when 
				(select count(*) from user_short_cut usc where usc.user_id=um.user_id AND usc.menu_id = um.menu_id) = 1 then 'Y'
				else 'N'
				end as is_permitted,
				(select shortcut_ordering from user_short_cut where user_id=um.user_id and menu_id=um.menu_id) as shortcut_ordering
				
			from
				user_menu um
			join menu m ON (m.menu_id=um.menu_id AND m.menu_link <> '' AND m.menu_class<> 'H')
			
			left join user_short_cut us
				ON (us.user_id=um.user_id)
			where um.user_id=".$this->session->userdata('user_id')." GROUP BY um.menu_id ORDER BY shortcut_ordering";
			
		return $this->db->query($Sql);
	}
	
	public function get($menu_id)
	{
		$this->db->where('menu_id',$menu_id);
		$query = $this->db->get('menu');
		return $query->row();
	}
	
	public function getAll($parent = 1)
	{
		$this->db->where('parent_id',$parent);
		$query = $this->db->get('menu');
		
		$menu = array();
		//$count = 0;
		foreach ($query->result() as $row)
		{
			
			if($this->_has_submenu($row->menu_id))
			{
				$row->sub = $this->getAll($row->menu_id);
			}
			$menu[] = $row;
		}
		
		return $menu;
		//return $query;
	}
	
	public function insert($data = array())
	{
		return $this->db->insert('menu',$data);
	}
	
	public function update($data,$menu_id)
	{
		$this->db->where('menu_id',$menu_id);
		return $this->db->update('menu',$data);
	}
	
	private function _has_submenu($menu_id)
	{
		$sql = "SELECT count(*) cnt FROM menu WHERE parent_id = ".$menu_id;
		$query = $this->db->query($sql);
		
		$row = $query->row();
		if($row->cnt == 0) return FALSE;
		return TRUE;
	}
}