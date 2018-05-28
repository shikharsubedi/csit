<?php

namespace gallery\models;

use Doctrine\Common\Collections\ArrayCollection,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="gallery\models\AlbumRepository")
 * @Table(name="dtn_album")
 */
class Album {

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
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @Column(type="text")
     */
    private $description;

    /**
     * @OneToOne(targetEntity="gallery\models\Image")
     * @JoinColumn(onDelete="set null")
     */
    private $coverimage;

    /**
     * @OneToMany(targetEntity="gallery\models\Image", mappedBy="album")
     * @JoinColumn(onDelete="cascade")
     */
    private $images;

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

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
        $this->images = new ArrayCollection;
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

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setCoverImage(\gallery\models\Image $coverimage = NULL) {
        $this->coverimage = $coverimage;
    }

    public function getCoverImage() {
        return $this->coverimage;
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

    public function addImage(\gallery\models\Image $img) {
        $this->images[] = $img;
    }

    public function removeImage(\gallery\models\Image $img) {
        $this->images->removeElement($img);
    }

    public function getImages() {
        return $this->images;
    }

    public function getSlug() {
        return $this->slug;
    }

}

?>