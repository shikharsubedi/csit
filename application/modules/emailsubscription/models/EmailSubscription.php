<?php

namespace emailsubscription\models;

use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="emailsubscription\models\EmailSubscriptionRepository")
 * @Table(name="dtn_email_subscription")
 */
class EmailSubscription {
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="text", nullable=false)
     */
    private $email;
    
    /**
     * @Column(type="string", nullable=false)
     */
    private $active = TRUE;
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getActive() {
        return $this->active;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
