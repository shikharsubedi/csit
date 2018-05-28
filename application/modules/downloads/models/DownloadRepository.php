<?php
namespace downloads\models;
 
use Doctrine\ORM\EntityRepository;
use downloads\models\Download_category,
	downloads\models\Download,
	F1soft\DoctrineExtensions\Paginate\Paginate,
	Doctrine\ORM\Query;
 
class DownloadRepository extends EntityRepository
{
	
	public function getDownloadCategory($offset = NULL,$perpage = NULL,$filters = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('dc.id','dc.name','dc.status','dc.order'))
			->from('downloads\models\Download_category', 'dc')
			->where('1 = 1');
		if(is_array($filters) && count($filters) > 0)
		{
			foreach($filters as $k => $v)
				$qb->andWhere("i.".$k."='".$v."'");
		}
		
		if(!is_null($perpage))
			$qb->setMaxResults($perpage);
		
		if(!is_null($offset))
			$qb->setFirstResult($offset);	
		
		$qb->orderBy('dc.order','ASC');
		
		$query = $qb->getQuery();
		
		$category = $query->getResult();
		
		$totalResults = Paginate::count($query);
				
		
		
		return array(	'total'		=>	$totalResults,
						'indices'	=>	$category);
	}
	
	public function getDownloadItems($cat_id,$offset = NULL,$perpage = NULL,$filters = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('d.id','d.name','d.file','d.created','d.status','d.order', 'd.showFront'))
			->from('downloads\models\Download', 'd')
			->where("d.download_category = '$cat_id'");
		if(is_array($filters) && count($filters) > 0)
		{
			foreach($filters as $k => $v)
				$qb->andWhere("i.".$k."='".$v."'");
		}
		
		if(!is_null($perpage))
			$qb->setMaxResults($perpage);
		
		if(!is_null($offset))
			$qb->setFirstResult($offset);	
		
		$qb->orderBy('d.order','ASC');
		
		$query = $qb->getQuery();
		
		$items = $query->getResult();
		
		$totalResults = Paginate::count($query);
				
		
		
		return array(	'total'		=>	$totalResults,
						'indices'	=>	$items);
	}
	
	public function getDLCategory()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('dc.id','dc.name','dc.slug'))
			->from('downloads\models\Download_category', 'dc')
			->where("dc.status = 'active'")
			->orderBy('dc.order','ASC');
		
		return $qb->getQuery()->getResult();		
	}
	
	public function getDLItems($cat_id)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('d.id','d.name','d.slug','d.file'))
			->from('downloads\models\Download', 'd')
			->where("d.download_category = '$cat_id'")
			->andWhere("d.status = 'active'")
			->orderBy('d.created','DESC');
		
		return $qb->getQuery()->getResult();
	}
	
	public function getItemFromSlug($slug)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('d.file'))
			->from('downloads\models\Download', 'd')
			->where("d.slug = '$slug'")
			->andWhere("d.status = 'active'");
			
		
		
		return $qb->getQuery()->getResult();
	}
	
	public function getChildrenCategories($pid, $active = FALSE) {
	
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('dc.id','dc.name','dc.status','dc.order'))
		->from('downloads\models\Download_category', 'dc')
		->where("dc.parent = '$pid'")
		->orderBy("dc.order", 'ASC')
		;
		if ($active) $qb->andWhere("dc.status = 'active'");
			
		return $qb->getQuery()->getResult();
	}
	
	public function getDLMobileapp()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('dc.id','dc.name'))
			->from('downloads\models\Download_category', 'dc')
			->where("dc.status = 'active'")
			->andWhere("dc.name LIKE 'Mobile%'")
			->orderBy('dc.order','ASC');
		
		return $qb->getQuery()->getResult();		
	}
}