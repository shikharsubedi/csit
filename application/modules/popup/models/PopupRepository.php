<?php
namespace popup\models;
 
use Doctrine\ORM\EntityRepository;
use popup\models\Popup,
	user\models\user,
	F1soft\DoctrineExtensions\Paginate\Paginate,
	Doctrine\ORM\Query;
 
class PopupRepository extends EntityRepository
{
   public function getPopup($offset = NULL,$perpage = NULL,$filters = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('p.id', 'p.title', 'u.firstname', 'p.status', 'p.created'))
			->from('popup\models\Popup', 'p')
			->join('p.user','u')
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
		
		$qb->orderBy('p.created','ASC');
		
		$query = $qb->getQuery();
		
		$totalResults = Paginate::count($query);
		
		$outlets = $query->getResult();
		
		return array(	'total'		=>	$totalResults,
						'indices'	=>	$outlets);
			
	}
	
	
	public function getLatestPopup()
	{
		$qb = $this->_em->createQueryBuilder();
		
		$qb->select(array('p.title', 'p.body'))
			->from('popup\models\Popup', 'p')
			->orderBy('p.created','DESC')
			->where("p.status = '".STATUS_ACTIVE."'")
			->setMaxResults(1);
		return $qb->getQuery()->getResult();
	}
}

?>