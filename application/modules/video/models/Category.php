<?php

namespace video\models;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="video\models\VideoRepository")
 * @Table(name="dtn_video_category")
 */
class Category {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", nullable=false, length=255 )
     */
    private $title;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = true;

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

    /**
     * @ManyToOne(targetEntity="user\models\User")
     */
    private $user;

    /**
     * @OneToMany(targetEntity="video\models\Video", mappedBy="category")
     * @JoinColumn(onDelete="cascade")
     */
    private $video;

    public function __construct() {
        
    }

    public function id() {
        return $this->id;
    }

    public function setUser(\user\models\User $user) {
        $this->user = $user;
    }

    function getTitle() {
        return $this->title;
    }

    function getOrder() {
        return $this->order;
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

    function setOrder($order) {
        $this->order = $order;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setUpdated($updated) {
        $this->updated = $updated;
    }

    public function activate() {
        $this->status = true;
    }

    public function deactivate() {
        $this->status = false;
    }

    public function getStatus() {
        return $this->status;
    }

    public function addVideo(\video\models\Video $video) {
        $this->video[] = $video;
    }

    public function removeVideo(\video\models\Video $video) {
        $this->video->removeElement($video);
    }

    public function getVideo() {
        return $this->video;
    }
    public function getSlug() {
        return $this->slug;
        
    }

}
