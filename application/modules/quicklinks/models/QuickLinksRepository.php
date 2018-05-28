<?php

namespace quicklinks\models;

use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query;

class QuickLinksRepository extends EntityRepository {

    public function getAll() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('m.id', 'm.title', 'm.status', 'm.type', 'm.link'))
                ->from('quicklinks\models\QuickLinks', 'm')
                ->where('m.status = :status')
                ->setParameter('status', 'active');
        $query = $qb->getQuery();
        return $query->getResult();
    }

}
