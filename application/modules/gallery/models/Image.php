<?php

namespace gallery\models;

use Doctrine\Common\Collections\ArrayCollection,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="gallery\models\ImageRepository")
 * @Table(name="dtn_image")
 */
class Image {

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
     * @Column(type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * @ManyToOne(targetEntity="gallery\models\Album", inversedBy="image")
     */
    private $album;

    /**
     * @var datetime $created
     *
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @ManyToOne(targetEntity="\user\models\User")
     */
    private $user;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $status = STATUS_ACTIVE;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    public function __construct(\gallery\models\Album $album) {
        $this->album = $album;
    }

    public function id() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setCaption($caption) {
        $this->caption = $caption;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function createdOn() {
        return $this->created;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(\user\models\User $user) {
        $this->user = $user;
    }

    public function activate() {
        $this->status = STATUS_ACTIVE;
    }

    public function deactivate() {
        $this->status = STATUS_INACTIVE;
    }

    public function getStatus() {
        return $this->status;
    }
    
    function getAlbum() {
        return $this->album;
    }

    function setAlbum($album) {
        $this->album = $album;
    }


}

?>