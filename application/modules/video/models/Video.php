<?php

namespace video\models;

use Doctrine\Common\Collections\ArrayCollection,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="video\models\VideoRepository")
 * @Table(name="dtn_video")
 */
class Video {

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
     * @Column(type="string", length=255, nullable=true)
     */
    private $linktype;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $ylink;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ManyToOne(targetEntity="video\models\Category", inversedBy="video")
     */
    private $category;

    /**
     * @Column(type="boolean")
     */
    private $active = TRUE;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    /**
     * @Column(type="integer", length=11, nullable=true)
     */
    private $views;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @gedmo\Timestampable(on="update")
     * @Column(type="datetime")
     */
    private $updated;

    public function __construct(\video\models\Category $category) {
        $this->category = $category;
    }

    public function id() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getYlink() {
        return $this->ylink;
    }

    function getCreated() {
        return $this->created;
    }

    function getUpdated() {
        return $this->updated;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setYlink($ylink) {
        $this->ylink = $ylink;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setUpdated($updated) {
        $this->updated = $updated;
    }

    public function getStatus() {
        return $this->active;
    }

    public function activate() {
        $this->active = 1;
    }

    public function deactivate() {
        $this->active = 0;
    }

    function getOrder() {
        return $this->order;
    }

    function setOrder($order) {
        $this->order = $order;
    }

    function getSlug() {
        return $this->slug;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function getViews() {
        return $this->views;
    }

    function setViews($views) {
        $this->views = $views;
    }

    function getCategory() {
        return $this->category;
    }
    
    function getLinktype() {
        return $this->linktype;
    }

    function setLinktype($linktype) {
        $this->linktype = $linktype;
    }



}
