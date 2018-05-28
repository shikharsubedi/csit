<?php

namespace video\models;

use Doctrine\ORM\EntityRepository;
use video\models\Category,
    F1soft\DoctrineExtensions\Paginate\Paginate,
    Doctrine\ORM\Query;

class VideoRepository extends EntityRepository {

    public function getFrontVideos($perpage = NULL, $offset = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('v'))
			->from('video\models\Video', 'v')
			->join('v.category', 'c')
			->where('v.active=1', 'c.status=1');
				
        $totalResults = count($qb->getQuery()->getResult());
		
        if ($perpage != '')
            $qb->setMaxResults($perpage);
			
        if ($offset != '')
            $qb->setFirstResult($offset);
			
		$videos = $qb->getQuery()->getResult();
		
        return array(
			'total' => $totalResults,
            'videos' => $videos);
    }

    public function getCategory($filters = NULL, $count = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.id', 'c.order', 'c.created', 'c.updated', 'c.status', 'u.firstname', 'u.lastname', 'u.middlename', 'c.title', 'c.slug'))
                ->from('video\models\Category', 'c')
                ->innerJoin('c.user', 'u')
                ->where('1 = 1');


        if (is_array($filters) and count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("c." . $k . "='" . $v . "'");
        }

        $qb->setMaxResults($count);

        $qb->orderBy('c.order', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function getVideo($cid, $status = NULL, $count = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('e.id', 'e.title', 'e.ylink', 'e.active', 'e.created', 'e.updated'))
                ->from('video\models\Video', 'e')
                ->innerJoin('e.category', 'c')
                ->where('c.id =' . $cid)
        ;

        if ($status) {
            $qb->andWhere('e.active = 1');
        }
        $qb->setMaxResults($count);
        $qb->orderBy('e.order', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function findVideoByCategorySlug($slug, $perpage, $offset, $order = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('v.id , v.title, v.ylink, v.active, v.slug, v.created, v.updated, c.title as cat_title', 'v.image', 'v.linktype', 'v.views'))
                ->from('video\models\Video', 'v')
                ->innerJoin('v.category', 'c')
                ->where('c.slug= :slug')
                ->setParameter('slug', $slug)
                ->andWhere('v.active = 1')
                ->andWhere('c.status = 1');
        if ($order)
            $qb->orderBy('v.title');
        else
            $qb->orderBy('v.order');


        $totalResults = count($qb->getQuery()->getResult());
        //$qb->setMaxResults($perpage);
        if (!is_null($perpage))
            $qb->setMaxResults($perpage);
        if (!is_null($offset))
            $qb->setFirstResult($offset);

        $query = $qb->getQuery();


        $video = $query->getResult();

        return array('total' => $totalResults,
            'video' => $video);
    }

    public function findVideoByCategory($slug, $perpage) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('v.id , v.title, v.ylink, v.active, v.slug, v.created, v.updated, c.title as cat_title', 'v.image', 'v.linktype', 'v.views'))
                ->from('video\models\Video', 'v')
                ->innerJoin('v.category', 'c')
                ->where('c.slug= :slug')
                ->setParameter('slug', $slug)
                ->andWhere('v.active = 1')
                ->andWhere('c.status = 1')
                ->orderBy('v.id', 'DESC');


        $totalResults = count($qb->getQuery()->getResult());
        //$qb->setMaxResults($perpage);
        if (!is_null($perpage))
            $qb->setMaxResults($perpage);
        $query = $qb->getQuery();


        $video = $query->getResult();

        return array('total' => $totalResults,
            'video' => $video);
    }

}
