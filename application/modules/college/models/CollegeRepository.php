<?php

namespace college\models;

use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query;

class CollegeRepository extends EntityRepository {

    public function getListCollege($filters=NULL,$perpage,$offset,$id = NULL)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('c'))
			->from('college\models\College', 'c')
			//->innerJoin('d.user','u')
			->where('1 = 1');
			if(!is_null($id)){
				$qb->andWhere('c.university = :uni');
			    $qb->setParameter('uni', $id);
			}
			
			
		$qb->orderBy('c.id','DESC');
		$totalResults = count($qb->getQuery()->getResult());
		$qb->setMaxResults($perpage);
		$qb->setFirstResult($offset);
		
		$query = $qb->getQuery();
		
		
		
		//echo $qb->getQuery()->getSql();exit;
		
		$college = $query->getResult();
		
		return array(	'total'		=>	$totalResults,
						'college'	=>	$college);
			
		
	}

	public function getFrontListCollege($perpage,$offset)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('c'))
			->from('college\models\College', 'c')
			//->innerJoin('d.user','u')
			->where('1 = 1');
			
			
			
		$qb->orderBy('c.id','DESC');
		$totalResults = count($qb->getQuery()->getResult());
		$qb->setMaxResults($perpage);
		$qb->setFirstResult($offset);
		
		$query = $qb->getQuery();
		
		
		
		//echo $qb->getQuery()->getSql();exit;
		
		$college = $query->getResult();
		
		return array(	'total'		=>	$totalResults,
						'college'	=>	$college);
			
		
	}

	public function getList(){
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('c'))
			->from('college\models\College', 'c')
			//->innerJoin('d.user','u')
			->where('1 = 1');
			
			
			
		$qb->orderBy('c.id','DESC');
		
		$query = $qb->getQuery();
		
		
		
		//echo $qb->getQuery()->getSql();exit;
		
		$college = $query->getResult();
		
		return $college;
	}




}
