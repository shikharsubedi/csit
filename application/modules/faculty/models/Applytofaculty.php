<?php

namespace faculty\models;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="faculty\models\FacultyRepository")
 * @Table(name="dtn_apply_to_faculty")
 */
class Applytofaculty {
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @Column(type="string", nullable=false)
     */
    private $phone;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;
    
    /**
     * @ManyToOne(targetEntity="faculty\models\Faculty", inversedBy="appliedStudents")
     */
    private $faculty;
    
    /**
     * @Column(type="text", nullable=false)
     */
    private $address;
    
    /**
     * @Column(type="text", nullable=false)
     */
    private $comments;
    
    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = 1;
    
    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getCreated() {
        return $this->created;
    }

    function getFaculty() {
        return $this->faculty;
    }

    function getAddress() {
        return $this->address;
    }

    function getComments() {
        return $this->comments;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setFaculty($faculty) {
        $this->faculty = $faculty;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setComments($comments) {
        $this->comments = $comments;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getOrderBy() {
        return $this->order;
    }

    function setOrderBy($order) {
        $this->order = $order;
    }


    
    

}

