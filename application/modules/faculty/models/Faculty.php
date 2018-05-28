<?php

namespace faculty\models;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="faculty\models\FacultyRepository")
 * @Table(name="dtn_faculty")
 */
class Faculty {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=true, unique = true)
     */
    private $name;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @OneToOne(targetEntity="content\models\Content")
     * @JoinColumn(onDelete="cascade")
     * */
    private $content;

    /**
     * @OneToMany(targetEntity="faculty\models\Applytofaculty", mappedBy="faculty")
     * @JoinColumn(onDelete="cascade")
     */
    private $appliedStudents;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = 1;

    public function __construct() {
        
    }

    function getSlug() {
        return $this->slug;
    }

    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getOrder() {
        return $this->order;
    }

    function setOrder($order) {
        $this->order = $order;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAppliedStudents() {
        return $this->appliedStudents;
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

    function setAppliedStudents($appliedStudents) {
        $this->appliedStudents = $appliedStudents;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
