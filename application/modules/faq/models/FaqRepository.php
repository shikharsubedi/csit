<?php

namespace faq\models;

use Doctrine\ORM\EntityRepository;
use faq\models\Faqcat,
    Doctrine\ORM\Query;

class FaqRepository extends EntityRepository {

    public function getFaqcats($filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('fa.id', 'fa.order', 'fa.created', 'fa.updated', 'fa.status', 'u.firstname', 'u.lastname', 'u.middlename', 'fa.name'))
                ->from('faq\models\Faqcat', 'fa')
                ->innerJoin('fa.user', 'u')
                ->where('1 = 1');

        if (is_array($filters) and count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("fa." . $k . "='" . $v . "'");
        }

        $qb->orderBy('fa.order', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function getFaqss($id = NULL, $filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('fa.id', 'fa.order', 'fa.created', 'fa.updated', 'fa.status', 'u.firstname', 'u.lastname', 'u.middlename', 'fa.question', 'fa.answer'))
                ->from('faq\models\Faqs', 'fa')
                ->innerJoin('fa.user', 'u')
                ->where('1 = 1');
        if (isset($id))
            $qb->andWhere('fa.faqcat = :id')->setParameter('id', $id);

        if (is_array($filters) and count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("fa." . $k . "='" . $v . "'");
        }

        $qb->orderBy('fa.order', 'ASC');

        return $qb->getQuery()->getResult();
    }

    # DO NOT edit or remove this function

    public function getFieldArray() {
        return unserialize('a:1:{s:4:"name";s:4:"name";}');
    }

    # DO NOT edit or remove this function

    public function _getFieldArray() {
        return unserialize('a:2:{s:8:"question";s:8:"question";s:6:"answer";s:6:"answer";}');
    }

}

?>
