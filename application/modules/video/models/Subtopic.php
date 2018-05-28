<?php

namespace video\models;

use Doctrine\Common\Collections\ArrayCollection,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="video\models\VideoRepository")
 * @Table(name="dtn_video_subtopic")
 */
class Subtopic {

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
     * @Column(type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @ManyToOne(targetEntity="video\models\Video")
     * @JoinColumn(name="video_id", referencedColumnName="id")
     * */
    private $video;

    public function __construct(\video\models\Video $video) {
        $this->video = $video;
    }

    public function id() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getValue() {
        return $this->value;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setValue($value) {
        $this->value = $value;
    }

}
