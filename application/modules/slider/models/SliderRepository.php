<?php
namespace slider\models;
 
use Doctrine\ORM\EntityRepository;
use content\models\Content,
	Doctrine\ORM\Query;
 
class SliderRepository extends EntityRepository
{
	public function getImages($filters = NULL, $perpage = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array(	's.id','s.name','s.image','s.thumbnail','s.status'))
			->from('slider\models\Slider', 's')
			->where('1 = 1');
		if(is_array($filters) && count($filters) > 0)
		{
			foreach($filters as $k => $v)
				$qb->andWhere("s.".$k."='".$v."'");
		}
		if($perpage)
			$qb->setMaxResults($perpage);
			
		$qb->orderBy('s.order','ASC');
			
		return $qb->getQuery()->getResult();
	}
	
	public function getMainSlider($filters = NULL, $perpage = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('s.id','s.name','s.image','s.thumbnail','s.status', 's.link', 's.type'))
			->from('slider\models\Slider', 's')
			->where('s.status = :stat')
			->setParameter('stat', 'active');
			
		
		if($perpage)
			$qb->setMaxResults($perpage);
			
		$qb->orderBy('s.order','ASC');
			
		return $qb->getQuery()->getResult();
	}
	
	public function getEntertainmentSlider($filters = NULL, $perpage = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array(	's.id','s.name','s.image','s.thumbnail','s.status'))
			->from('slider\models\Slider', 's')
			->where('s.status = :stat')
			->setParameter('stat', 'active')
			->andWhere("s.showin IN ('E','B')");
		
		if($perpage)
			$qb->setMaxResults($perpage);
			
		$qb->orderBy('s.order','ASC');
			
		return $qb->getQuery()->getResult();
	}


	public function getApiImages()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('s'))
			->from('slider\models\Slider', 's')
			->where('1 = 1')
			->andWhere('s.status = :stat')
			->setParameter('stat', 'active');
		
			
		$qb->orderBy('s.order','ASC');
			
		return $qb->getQuery()->getResult();
	}
}
?>