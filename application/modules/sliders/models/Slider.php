<?php

namespace slider\models;

use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="slider\models\SliderRepository")
 * @Table(name="dtn_slider")
 */
class Slider {

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
    private $content_a;

    /**
     * @Column(type="string", nullable=true)
     */
    private $content_b;

    /**
     * @Column(type="string", nullable=true)
     */
    private $content_c;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $linkType;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $url = '#';

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * @Column(type="string", length=2, nullable=true)
     */
    private $istab;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=true)
     */
    private $order = 0;

    /**
     * @ManyToOne(targetEntity="slider\models\SliderGroup")
     */
    private $group;

    /**
     * @ManyToOne(targetEntity="content\models\Content",cascade={"persist","remove"})
     * */
    private $content;

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
    }

    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function getLinkType() {
        return $this->linkType;
    }

    function setLinkType($linkType) {
        $this->linkType = $linkType;
    }

    function getContent_a() {
        return $this->content_a;
    }

    function getContent_b() {
        return $this->content_b;
    }

    function getContent_c() {
        return $this->content_c;
    }

    function setContent_a($content_a) {
        $this->content_a = $content_a;
    }

    function setContent_b($content_b) {
        $this->content_b = $content_b;
    }

    function setContent_c($content_c) {
        $this->content_c = $content_c;
    }

    public function id() {
        return $this->id;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setURL($url) {
        $this->url = $url;
    }

    public function getURL() {
        return $this->url;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function setIsTab($istab) {
        $this->istab = $istab;
    }

    public function getIsTab() {
        return $this->istab;
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

    public function setGroup(SliderGroup $group = null) {
        $this->group = $group;
    }

    public function getGroup() {
        return $this->group;
    }

}

?>