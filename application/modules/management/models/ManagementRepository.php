<?php

namespace management\models;

use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query,
    management\models\Management;

class ManagementRepository extends EntityRepository {

    public function countShowFront() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('m'))
                ->from('management\models\Management', 'm')
                ->where('m.showFront = 1');
        return $count = count($qb->getQuery()->getResult());
    }
    public function getManagement($offset = NULL, $perpage = NULL, $filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('m.name'))
                ->from('management\models\Management', 'm')
                ->where('type = :type')
                ->setParameter('type', Management::TYPE_BOARD);
    }

    public function getTeams($id = NULL) {
        $qb = $this->_em->createQueryBuilder();
        if ($id == NULL) {
            $qb->select(array('t.name', 't.slug', 't.id'))
                    ->from('management\models\ManagementType', 't');
        } else {
            $qb->select(array('t.name', 't.slug', 't.id'))
                    ->from('management\models\ManagementType', 't')
                    ->where('t.id = :id')
                    ->setParameter('id', $id);
        }

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function slugToTeam($slug) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('t.id', 't.name'))
                ->from('management\models\ManagementType', 't')
                ->where('t.slug = :slug')
                ->setParameter('slug', $slug);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getMembers($tid, $activeOnly = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('m.id', 'm.name', 'm.position', 'm.image', 'm.description', 'm.showFront'))
                ->from('management\models\Management', 'm')
                ->where('m.type = :tid')
                ->orderBy('m.order', 'ASC')
                ->setParameter('tid', $tid);
        if ($activeOnly)
            $qb->andWhere("m.active='1'");
        return $qb->getQuery()->getResult();
    }

    public function getMembersof($tid, $activeOnly = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('m.id', 'm.name', 'm.position', 'm.image', 'm.description'))
                ->from('management\models\Management', 'm')
                ->where('m.id = :tid')
                ->orderBy('m.order', 'ASC')
                ->setParameter('tid', $tid);
        if ($activeOnly)
            $qb->andWhere("m.active='1'");
        return $qb->getQuery()->getResult();
    }

    public function getTeamsexce() {
        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('t.name', 't.slug', 't.id'))
                ->from('management\models\ManagementType', 't')
                ->where('t.id <> :tid')
                ->setParameter('tid', 1);


        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function getProfiles() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('t.id', 't.slug', 't.name'))
                ->from('management\models\ManagementType', 't')
                ->where('1 = 1')
                ->orderBy('t.id', 'ASC');

        $category = $qb->getQuery()->getResult();

        foreach ($category as &$c) {

            $qb = $this->_em->createQueryBuilder();
            $qb->select('m.id', 'm.name', 'm.slug', 'm.position', 'm.experience', 'm.description', 'm.image')
                    ->from('management\models\Management', 'm')
                    ->where('m.type =' . $c['id'])
                    ->andWhere('m.active = :status')
                    ->setParameter('status', 1)
                    ->orderBy('m.order', 'ASC');

            $c['profile'] = $qb->getQuery()->getResult();
        }

        return $category;
    }

    /* public function getFrontCategory() {
      $qb = $this->_em->createQueryBuilder();
      $qb->select(array('m.id', 'm.name', 'm.position', 'm.image', 'm.description', 'm.showFront'))
      ->from('management\models\Management', 'm')
      ->join('m.type', 't')
      ->where('m.type = :tid')
      ->orderBy('m.order', 'ASC')
      ->setParameter('tid', $tid);
      if ($activeOnly)
      $qb->andWhere("m.active='1'");
      return $qb->getQuery()->getResult();
      } */
}
