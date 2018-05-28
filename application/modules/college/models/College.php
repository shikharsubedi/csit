<?php

namespace college\models;
use Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="college\models\CollegeRepository")
 * @Table(name="dtn_college")
 */
class College {

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
     * @Column(type="string", length=255, nullable=true)
     */
    private $address;
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $contact;
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $url;


    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $image;
    /**
     * @ManyToOne(targetEntity="college\models\University", inversedBy="college")
     * @JoinColumn(onDelete="cascade")
     */
    private $university;

    /**
     * @Column(type="text", nullable=true)
     */
    private $description;

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
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = true;

    
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

    public function setUniversity(\college\models\University $university){$this->university = $university;}
    public function getUniversity(){return $this->university;}

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getDescription() {
        return $this->description;
    }
    function getImage() {
        return $this->image;
    }

     function getContact() {
        return $this->contact;
    }

    function getUrl() {
        return $this->url;
    }

      function getAddress() {
        return $this->address;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setImage($image) {
        $this->image = $image;
    }
    function setContact($contact) {
        $this->contact = $contact;
    }

    function setUrl($url) {
        $this->url = $url;
    }
     function setAddress($address) {
        $this->address = $address;
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
    public function activate(){$this->status = true;}
    public function deactivate(){$this->status = false;}

}
