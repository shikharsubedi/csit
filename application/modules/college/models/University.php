<?php

namespace college\models;
use Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="college\models\CollegeRepository")
 * @Table(name="dtn_university")
 */
class University {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $name;
    

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;
    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = 1;
    /**
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    
    function getCreated() {
        return $this->created;
    }

    function getSlug() {
        return $this->slug;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function id() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    
   
    
    function setName($name) {
        $this->name = $name;
    }

    

    function getOrder() {
        return $this->order;
    }

    function setOrder($order) {
        $this->order = $order;
    }
    function setStatus($status) {
        $this->status = $status;
    }
     function getStatus() {
        return $this->status;
    }
    public function getUniversity(){
        $ci = get_instance();
        $qb = $ci->doctrine->em->createQueryBuilder();
        $qb->select(array('u'))
             ->from('college\models\University', 'u')
             ->where('u.status=1');
        return $qb->getQuery()->getResult();

    }

}
