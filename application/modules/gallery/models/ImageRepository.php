<?php

namespace gallery\models;

use Doctrine\ORM\EntityRepository;
use gallery\models\Album,
    gallery\models\Image,
    user\models\user,
    F1soft\DoctrineExtensions\Paginate\Paginate,
    Doctrine\ORM\Query;

class ImageRepository extends EntityRepository {

    public function getImagesOfAlbum($offset = NULL, $perpage = NULL, $filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('i.id', 'i.name,i.caption'))
                ->from('gallery\models\Image', 'i')
                ->where('1 = 1');
        if (is_array($filters) && count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("i." . $k . "='" . $v . "'");
        }

        if (!is_null($perpage))
            $qb->setMaxResults($perpage);

        if (!is_null($offset))
            $qb->setFirstResult($offset);

        $qb->orderBy('i.created', 'ASC');

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);

        $outlets = $query->getResult();
        return array('total' => $totalResults,
            'indices' => $outlets);
    }

    public function getRandImage() {
        $qb = $this->_em->createQueryBuilder();
        $active = STATUS_ACTIVE;
        $qb->select('i.name')
                ->from('gallery\models\Image', 'i')
                ->where("i.status = '$active'")
        ;
        $return = $qb->getQuery()->getResult();

        if (count($return) < 1)
            return NULL;

        return $return[array_rand($return)]['name'];
    }

    public function getImages($id) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('i.id', 'i.name,i.caption'))
                ->from('gallery\models\Image', 'i')
                ->where('i.album=' . $id);
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    public function getallgalleryfront($offset, $perpage, $slug) {
        //echo $slug;exit;
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('i'))
                ->from('gallery\models\Image', 'i')
                ->join('i.album', 'album')
                ->where("i.status= 'active'")
                ->andWhere('album.slug=:slug')
                
                ->setParameter('slug', $slug);
                //->where('album.slug ='.$slug);
       $count= count($qb->getQuery()->getResult());
        if (!is_null($perpage))
            $qb->setMaxResults($perpage);

        if (!is_null($offset))
            $qb->setFirstResult($offset);
        $qb->orderBy('i.created', 'ASC');
        
        $query = $qb->getQuery();
        $result = $query->getResult();
        return array(
            'total' =>$count,
            'indices'=> $result
        );
        //$totalResults=count($query);
        //echo $totalResults;exit;
        //$galleyresult = $query->getResult();
        //return array('total' => $totalResults,
        //    'indices' => $galleyresult);
    }

}

?>