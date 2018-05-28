<?php

namespace outletlocator\models;

use Doctrine\ORM\EntityRepository;
use content\models\Content;
use outletlocator\models\Outlet,
    F1soft\DoctrineExtensions\Paginate\Paginate,
    Doctrine\ORM\Query;

class OutletRepository extends EntityRepository {

    public function getOutlets($offset = NULL, $perpage = NULL, $filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('o.name', 'o.id', 'o.location',  'o.email', 'o.latitude', 'o.description', 'o.longitude', 'o.status'))
                ->from('outletlocator\models\Outlet', 'o')
                ->where('1 = 1')
                ->orderBy('o.id', 'desc');
        if (is_array($filters) && count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("o." . $k . "='" . $v . "'");
        }
        if (!is_null($perpage))
            $qb->setMaxResults($perpage);

        if (!is_null($offset))
            $qb->setFirstResult($offset);


        $query = $qb->getQuery();
        //echo $qb->getQuery()->getSql();exit;
        $totalResults = Paginate::count($query);

        $outlets = $query->getResult();
        return array('total' => $totalResults,
            'outlets' => $outlets);
    }

    public function getOutletslist($filters = NULL, $offset = NULL, $perpage = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('o.name', 'o.id', 'o.location',  'o.latitude', 'o.description', 'o.email',  'o.country', 'o.contact_no', 'o.longitude', 'o.status'))
                ->from('outletlocator\models\Outlet', 'o')
                ->where('1 = 1')
                ->orderBy('o.id', 'desc');
        if (is_array($filters) && count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("o." . $k . "='" . $v . "'");
        }
        if (!is_null($perpage))
            $qb->setMaxResults($perpage);

        if (!is_null($offset))
            $qb->setFirstResult($offset);


        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);

        $outlets = $query->getResult();
        return array('total' => $totalResults,
            'outlets' => $outlets);
    }

    public function getOutletsSearch($filters) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('o.name', 'o.id', 'o.location', 'o.type', 'o.latitude', 'o.description', 'o.longitude', 'o.invalley', 'o.status', 'c.slug'))
                ->from('outletlocator\models\Outlet', 'o')
                ->join('o.content', 'c')
                ->where('1 = 1');

        foreach ($filters as $k => $v)
            $qb->andWhere("o." . $k . "='" . $v . "'");

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);

        return $query->getResult();
        return array('total' => $totalResults,
            'outlets' => $outlets);
    }

   
    public function getoutletrepo() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('o.id', 'o.location', 'o.name', 'o.description', 'o.email', 'o.latitude', 'o.longitude', 'o.status', 'o.country')
                ->from('outletlocator\models\Outlet', 'o')
                ->where('o.location IS NOT NULL')
                ->orderBy('o.id', 'desc');
        //echo $qb->getQuery()->getSql();exit;
        return $qb->getQuery()->getResult();
    }

}

?>