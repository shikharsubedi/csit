<?php
namespace footer\models;
 
use Doctrine\ORM\EntityRepository;
use footer\models\Footer,
	footer\models\FooterGroup,
	Doctrine\ORM\Query;
 
class FooterRepository extends EntityRepository
{
	

	public function getGroups($id=NULL,$activeOnly=NULL){
		$qb = $this->_em->createQueryBuilder();
		if ($id==NULL) { 
			$qb->select(array('t.name','t.id','t.active'))
				->from('footer\models\FooterGroup', 't')
				->orderBy('t.order','ASC');
			}
		else {
			$qb->select(array('t.name','t.id'))
				->from('footer\models\FooterGroup', 't')
				->where('t.id = :id')
				->orderBy('t.order','ASC')
				->setParameter('id',$id);
			}
		if ($activeOnly) $qb->andWhere("t.active='1'");
		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function getFooters($gid,$activeOnly=NULL)
	{	
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('m.id','m.title','m.url','m.type','m.active','m.order'))
			->from('footer\models\Footer', 'm')
			->where('m.group = :gid')
			->orderBy('m.order','ASC')
			->setParameter('gid', $gid);
		if ($activeOnly) $qb->andWhere("m.active='1'");
		return $qb->getQuery()->getResult();
	}

}

?>