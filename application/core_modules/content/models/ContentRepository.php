<?php

namespace content\models;

use Doctrine\ORM\EntityRepository;
use content\models\Content,
    content\models\Taxonomy,
    content\models\Term,
    F1soft\DoctrineExtensions\Paginate\Paginate,
    Doctrine\ORM\Query;

class ContentRepository extends EntityRepository {

    public function findBySlug($slug) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.id', 'c.title', 'c.type', 'c.body', 'c.slug', 'c.created', 'u.firstname', 'u.lastname', 'u.middlename', 'c.image'
                        )
                )
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->where('c.slug = :slug')
                ->andWhere('c.status = :status')
                ->setParameter('status', STATUS_ACTIVE)
                ->setParameter('slug', $slug);

        //show_pre($qb->getQuery()->getSingleResult());exit;

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Exception $ex) {
            return array();
        }
    }

    public function getLatest($count) {
        $news_cat = \Options::get('news_events_home');

        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.slug', 'c.created', 'c.body', 'cat.name as cat_name', 'cat.slug as cat_slug', 'c.featured_banner'))
                ->from('content\models\Taxonomy', 't')
                ->innerJoin('t.contents', 'c')
                ->innerJoin('t.term', 'cat')
                ->where('t.id = :taxonomy_id')
                ->andWhere('c.status = :status')
                ->orderBy('c.created', 'desc')
                ->setParameter('status', STATUS_ACTIVE)
                ->setParameter('taxonomy_id', $news_cat);

        $qb->setMaxResults($count);
        //echo $qb->getDql();exit;	
        return $qb->getQuery()->getResult();
    }

    public function getLatesNewsCategorySlug() {
        $news_cat = \Options::get('news_cat');
        $qb = $this->_em->createQueryBuilder();

        $qb->select('t.slug')
                ->from('content\models\Taxonomy', 'tx')
                ->join('tx.term', 't')
                ->where('tx.id = :taxonomy_id')
                ->setParameter('taxonomy_id', $news_cat);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findContentByCategorySlug($slug, $perpage, $offset) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.id', 'c.title', 'c.type', 'c.body', 'c.slug', 'c.created', 'c.status', 'c.showfront', 'u.firstname', 'u.lastname', 'c.image'))
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->where("t.slug = '$slug'")
                ->andWhere("c.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('c.orderby', 'ASC');
        //->setParameter('slug', );
		
		$qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);
        $contents = $query->getResult();

        return array('total' => $totalResults,
            'contents' => $contents);
    }

    public function getLatestNews($count) {
        $news_cat = \Options::get('news_cat');

        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.slug', 'c.created', 'c.body', 'cat.name as cat_name', 'cat.slug as cat_slug', 'c.featured_banner'))
                ->from('content\models\Taxonomy', 't')
                ->innerJoin('t.contents', 'c')
                ->innerJoin('t.term', 'cat')
                ->where('t.id = :taxonomy_id')
                ->andWhere('c.status = :status')
                ->orderBy('c.created', 'desc')
                ->setParameter('status', STATUS_ACTIVE)
                ->setParameter('taxonomy_id', $news_cat);

        $qb->setMaxResults($count);
        //echo $qb->getDql();exit;
        return $qb->getQuery()->getResult();
    }

    public function searchByTag($tag) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.body', 'c.slug'))
                ->from('content\models\Content', 'c')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->where("t.name LIKE '%$tag%'");
        return $qb->getQuery()->getResult();
    }

    public function freeSearch($term = NULL) {

        if (!$term)
            return FALSE;

        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('DISTINCT(c.id)', 'c.title', 'c.slug', 'c.body'))
                ->from('content\models\Content', 'c')
                ->where("c.title LIKE '%$term%'")
                ->orWhere("c.body LIKE '%$term%'")
                ->orderBy('c.created', 'desc')
        ;
        // echo $qb->getQuery()->getSQL();exit;
        $return = array();

        $result = $qb->getQuery()->getResult();
        foreach ($result as $res) {
            $return[$res['id']] = $res;
        }


        return $return;
    }

    public function getAllTags() {
        $dql = "SELECT t FROM content\models\Taxonomy t WHERE t.taxonomy = 'tags' AND t.parent IS NULL";
        $query = $this->_em->createQuery($dql);

        $tags = $query->getResult();

        return $tags;
    }

    public function catDetails($catID) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.name', 't.slug')
                ->from('content\models\Term', 't')
                ->where("t.id = '$catID'");

        return $qb->getQuery()->getSingleResult();
    }

    public function getContents($offset, $perpage, $filters = NULL) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('content\models\Content', 'c')
                ->where('1=1')
                ->orderBy('c.created', 'desc');

        if (is_array($filters) && count($filters) > 0) {

            foreach ($filters as $k => $v) {
                if ($k == 'meta') {
                    $qb->leftJoin('c.metadata', 'm');
                    foreach ($v as $meta_key => $meta_value) {
                        $qb->andWhere("m.meta_key = '" . $meta_key . "'")
                                ->andWhere("m.meta_value = '" . $meta_value . "'");
                    }
                } else if ($k != 'search')
                    $qb->andWhere("c." . $k . "='" . $v . "'");
                else
                    $qb->andWhere("c.title LIKE '%" . $v . "%'");
            }
        }

        $qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);
        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);

        $contents = $query->getResult();
        return array('total' => $totalResults,
            'contents' => $contents);
    }

    public function getCategories() {
		
		

        $dql = "SELECT t FROM content\models\Taxonomy t WHERE t.taxonomy = '" . TAXONOMY_CATEGORY . "' AND t.parent IS NULL";
        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }

    public function getCategoriesPaginate($offset, $perpage) {
        $dql = "SELECT t FROM content\models\Taxonomy t WHERE t.taxonomy = '" . TAXONOMY_CATEGORY . "' AND t.parent IS NULL";
        $query = $this->_em->createQuery($dql);

        $query->setMaxResults($perpage);
        $query->setFirstResult($offset);

        $totalResults = Paginate::count($query);
        $categories = $query->getResult();

        return array(
            'total' => $totalResults,
            'categories' => $categorie
        );
    }

    public function getPages() {
        $dql = "SELECT p FROM content\models\Content p WHERE p.type != '" . Content::CONTENT_TYPE_ARTICLE . "' AND p.parent IS NULL";
        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }

     public function getAllPages() {
        $dql = "SELECT p FROM content\models\Content p WHERE p.parent IS NULL AND p.status = 'active' ORDER BY p.title";
        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }
   


    public function getChildrenPages($conID, $admin = FALSE) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.slug', 'c.status', 'c.created', 'c.featured_banner'))
                ->from('content\models\Content', 'c')
                ->where("c.parent = $conID")
        ;

        if (!$admin) {
            $qb->andWhere('c.status = :status')->setParameter('status', STATUS_ACTIVE);
        }

        return $qb->getQuery()->getResult();
    }

    public function getRelatedPages($type, $parent_id, $admin = FALSE) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.slug', 'c.type', 'c.status', 'c.created', 'c.featured_banner'))
                ->from('content\models\Content', 'c');

        if ($type == 'csr') {
            $qb->where('c.type = :type');
            $qb->setParameter('type', $type);
        } else {
            $qb->where('c.parent = :parent');
            $qb->setParameter('parent', $parent_id);
        }

        if (!$admin) {
            $qb->andWhere('c.status = :status')->setParameter('status', STATUS_ACTIVE);
        }

        return $qb->getQuery()->getResult();
    }

    public function getMetaData($content) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('m')
                ->from('content\models\ContentMeta', 'm')
                ->join('m.content', 'c');

        if ($content instanceof Content)
            $qb->where('c.id = ' . $content->id());
        else
            $qb->where('c.id = ' . $content);
        $metas = $qb->getQuery()->getArrayResult();

        $metaData = array();
        foreach ($metas as $meta) {
            $key = $meta['meta_key'];
            $value = $meta['meta_value'];
            $metaData[$key] = $value;
        }

        return $metaData;
    }

    public function getArticles() {
        $dql = "SELECT p FROM content\models\Content p WHERE p.type = '" . Content::CONTENT_TYPE_ARTICLE . "' AND p.parent IS NULL AND p.status='active' ORDER BY p.title ASC";
        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }

    public function getALl() {
        $dql = "SELECT p FROM content\models\Content p WHERE p.parent IS NULL";
        $query = $this->_em->createQuery($dql);
        $pages = $query->getResult();

        return $pages;
    }

    public function findContentByCategory($slug) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->where("t.slug = '$slug'")
                ->andWhere("c.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('c.orderby', 'asc');
        //->setParameter('slug', );



        $query = $qb->getQuery();

        $contents = $query->getResult();

        return $contents;
    }

    public function getSearchcontentresult() {
        
    }

    public function getcategorydata() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->andWhere("c.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('c.orderby', 'asc');
        $qb->setMaxResults(5);
        $query = $qb->getQuery();
        $contents = $query->getResult();
        return $contents;
    }

    public function getallcatecontents($offset, $perpage, $cate) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->andWhere("c.status = '" . STATUS_ACTIVE . "'")
                ->andWhere("t.id = '" . $cate . "'")
                ->orderBy('c.orderby', 'asc');
        $qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);
        $contents = $query->getResult();
//echo $qb->getQuery()->getSQL();exit;
        return array('total' => $totalResults,
            'contents' => $contents);
        //
    }
	
	public function findArticleBySlug($slug, $perpage, $offset) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.id', 'c.title', 'c.type', 'c.body', 'c.slug', 'c.created', 'c.eventdate', 'c.status', 'c.showfront', 'u.firstname', 'u.lastname', 'c.featured_banner'))
                ->from('content\models\Content', 'c')
                ->innerJoin('c.user', 'u')
                ->join('c.taxonomies', 'tx')
                ->join('tx.term', 't')
                ->where("t.slug = '$slug'")
                ->andWhere("c.status = '" . STATUS_ACTIVE . "'")
                ->orderBy('c.eventdate', 'ASC');
        //->setParameter('slug', );
		
		$qb->setMaxResults($perpage);
        $qb->setFirstResult($offset);

        $query = $qb->getQuery();

        $totalResults = Paginate::count($query);
        $contents = $query->getResult();

        return array('total' => $totalResults,
            'contents' => $contents);
    }
	
	public function getWhyUs() {
        
        $qb = $this->_em->createQueryBuilder();

        $qb->select(array('c.id', 'c.title', 'c.slug', 'c.created', 'c.body', 'cat.name as cat_name', 'cat.slug as cat_slug', 'c.featured_banner'))
                ->from('content\models\Taxonomy', 't')
                ->innerJoin('t.contents', 'c')
                ->innerJoin('t.term', 'cat')
                ->where('t.id = :taxonomy_id')
                ->andWhere('c.status = :status')
                ->orderBy('c.created', 'desc')
                ->setParameter('status', STATUS_ACTIVE)
                ->setParameter('taxonomy_id', 2)
				->orderBy('c.orderby', 'ASC');

        $qb->setMaxResults(5);
		
		return $qb->getQuery()->getResult();
    }


}

?>