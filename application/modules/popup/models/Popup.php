<?php

namespace popup\models;

use Gedmo\Mapping\Annotation as Gedmo,
    user\models\User,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="popup\models\PopupRepository")
 * @Table(name="dtn_popup")
 */
class Popup {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @Column(type="text", nullable=false)
     */
    private $body;

    /**
     * @ManyToOne(targetEntity="user\models\User")
     */
    private $user;

    /**
     * @Column(type="string")
     */
    private $status;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @Column(type="datetime")
     * @gedmo\Timestampable(on="update")
     */
    private $updated;

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
    }

    public function id() {
        return $this->id;
    }

    public function setAuthor(User $user) {
        $this->user = $user;
    }

    public function getAuthor() {
        return $this->user;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getBody() {
        return $this->body;
    }

    public function getStatus() {
        return $this->status;
    }

    public function activate() {
        $this->status = STATUS_ACTIVE;
    }

    public function deactivate() {
        $this->status = STATUS_INACTIVE;
    }

    public function created() {
        return $this->created;
    }

    public function updated() {
        return $this->updated;
    }

}

?>