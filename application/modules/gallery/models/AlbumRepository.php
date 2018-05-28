<?php

namespace gallery\models;

use Doctrine\ORM\EntityRepository;
use gallery\models\Album,
    gallery\models\Image,
    user\models\user,
    F1soft\DoctrineExtensions\Paginate\Paginate,
    Doctrine\ORM\Query;

class AlbumRepository extends EntityRepository {

    public function findPhotosByAlbum($slug, $perpage, $offset) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('i.id', 'i.name', 'i.caption', 'i.status', 'i.order', 'a.description'))
                ->from('gallery\models\Image', 'i')
                ->join('i.album', 'a')
                ->where("a.slug = '$slug'")
                ->andWhere("i.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('i.order', 'asc');

        $qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);
        $images = $query->getResult();
        //echo '<pre>'; \Doctrine\Common\Util\Debug::dump($images);exit;


        return array('total' => $totalResults,
            'contents' => $images);
    }

    public function getAlbums($perpage=NULL, $offset=NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('a.id', 'a.name', 'a.description', 'a.status', 'a.order', 'a.slug', 'i.name as cover_image'))
                ->from('gallery\models\Album', 'a')
                ->join('a.coverimage', 'i')
                ->where("a.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('a.order', 'asc');

        $qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);

        $query = $qb->getQuery();

       
        $albums = $query->getResult();
        return array('albums' => $albums);
    }

    public function getAlbumss() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('a.id', 'a.name', 'a.description', 'a.status', 'a.order', 'a.slug', 'i.name as cover_image'))
                ->from('gallery\models\Album', 'a')
                ->join('a.coverimage', 'i')
                ->where("a.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('a.order', 'asc');


        $query = $qb->getQuery();


        $albums = $query->getResult();
        return $albums;
    }

    public function getAlbum($offset = NULL, $perpage = NULL, $filters = NULL) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('a.id', 'a.name', 'i.name as cover_image'))
                ->from('gallery\models\Album', 'a')
                ->join('a.coverimage', 'i')
                ->where('1 = 1');
        if (is_array($filters) && count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("a." . $k . "='" . $v . "'");
        }

        if (!is_null($perpage))
            $qb->setMaxResults($perpage);

        if (!is_null($offset))
            $qb->setFirstResult($offset);

        $qb->orderBy('a.order', 'ASC');

        $query = $qb->getQuery();

        $outlets = $query->getResult();

        $qb->select(array('s.id'))
                ->from('gallery\models\Album', 's')
                ->where('1 = 1');
        if (is_array($filters) && count($filters) > 0) {
            foreach ($filters as $k => $v)
                $qb->andWhere("a." . $k . "='" . $v . "'");
        }
        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);
        //exit;
        return array('total' => $totalResults,
            'indices' => $outlets);
    }

    public function getRandImage() {
        $qb = $this->_em->createQueryBuilder();
        $active = STATUS_ACTIVE;
        $qb->select(array('a.id', 'i.name'))
                ->from('gallery\models\Album', 'a')
                ->join('a.coverimage', 'i')
                ->where('1 = 1')
                ->andwhere("a.status = '$active'")
        ;
        $return = $qb->getQuery()->getResult();

        if (count($return) < 1)
            return NULL;

        return $return[array_rand($return)]['name'];
    }

    public function getgalleryname($slug) {
        $qb = $this->_em->createQueryBuilder();
        $active = STATUS_ACTIVE;
        $qb->select(array('i.name'))
                ->from('gallery\models\Album', 'i')
                ->where('1 = 1')
                ->andwhere("i.slug = '$slug'")
        ;
        // echo $qb->getQuery()->getSQL();exit;
        $return = $qb->getQuery()->getResult();
        return $return;
    }

}

?>