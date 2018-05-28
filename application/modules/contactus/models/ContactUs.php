<?php

namespace contactus\models;
use Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="contactus\models\ContactUsRepository")
 * @Table(name="dtn_contactus")
 */
class ContactUs {

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
     * @Column(type="text", nullable=true)
     */
    private $email;

    /**
     * @Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    
    function getCreated() {
        return $this->created;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getMessage() {
        return $this->message;
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

    function setMessage($message) {
        $this->message = $message;
    }

}
