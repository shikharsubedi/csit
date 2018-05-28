<?php
namespace slider\models;
 
use Doctrine\ORM\EntityRepository;
use content\models\Content,
	Doctrine\ORM\Query;
 
class SliderRepository extends EntityRepository
{
	public function getImages($gID=NULL,$filters = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array(	's.id','s.name','s.image','s.url','s.thumbnail','s.status','s.istab'))
			->from('slider\models\Slider', 's')
			->where("s.group=$gID");
		if(is_array($filters) && count($filters) > 0)
		{
			foreach($filters as $k => $v)
				$qb->andWhere("s.".$k."='".$v."'");
		}
			
		$qb->orderBy('s.order','ASC');
			
		 return $qb->getQuery()->getResult();
	}
	
	public function getGroups($filters = NULL,$gID=NULL){
		
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array(	's.id','s.name','s.height','s.width','s.slug'))
			->from('slider\models\SliderGroup', 's')
			->where('1 = 1');
		if(is_array($filters) && count($filters) > 0)
		{
			foreach($filters as $k => $v)
				$qb->andWhere("s.".$k."='".$v."'");
		}
			
		//$qb->orderBy('s.order','ASC');
			
		return $qb->getQuery()->getResult();
		
	}
	public function getChildrenPages($conID) {
	
		$qb = $this->_em->createQueryBuilder();
	
		$qb->select(array(	'c.id','c.title','c.slug' ))
		->from('content\models\Content', 'c')
		->where("c.parent = '$conID'");
		$ar=$qb->getQuery()->getResult();
		return $ar;
		//show_pre($ar);
	}
	
	public function searchByTag($tag){
	
		//show_pre($tag);
		//die;
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('c.id','c.title','c.body','c.slug'))
		->from('content\models\Content', 'c')
		->join('c.taxonomies','tx')
		->join('tx.term','t')
		//->where("t.name LIKE '%$tag%'")
		->andWhere('c.status = :stat')
		->andWhere('c.type = :art')
		->setParameter('stat', STATUS_ACTIVE)
		->setParameter('art', Content::CONTENT_TYPE_ARTICLE);
		$ar=$qb->getQuery()->getResult();
		//show_pre($ar);
		return $ar;
	}

}
?>