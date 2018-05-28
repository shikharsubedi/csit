<?php

namespace quicklinks\models;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="quicklinks\models\QuickLinksRepository")
 * @Table(name="dtn_quick_links")
 */
class QuickLinks {

    public function __construct() {
        
    }

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="content\models\Content",cascade={"persist","remove"})
     * */
    private $content;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $link;

    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getType() {
        return $this->type;
    }

    function getLink() {
        return $this->link;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setLink($link) {
        $this->link = $link;
    }

}
