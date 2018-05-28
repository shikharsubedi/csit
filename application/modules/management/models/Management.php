<?php

namespace management\models;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="management\models\ManagementRepository")
 * @Table(name="dtn_management")
 */
class Management {

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
     * @Column(type="string", length=255, nullable=false)
     */
    private $position;

    /**
     * @Column(type="string", nullable=true)
     */
    private $experience;

    /**
     * @Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Column(name="order_by",type="integer", length=11)
     */
    private $order = 0;

    /**
     * @ManyToOne(targetEntity="management\models\ManagementType", inversedBy="people")
     * @JoinColumn(onDelete="cascade")
     */
    private $type;

    /**
     * @Column(type="string",length=255)
     */
    private $image;

    /**
     * @Column(type="boolean")
     */
    private $active = TRUE;

    /**
     * @Column(type="integer", nullable=false )
     */
    private $showFront = '0';

    public function __construct(ManagementType $type) {
        $this->type = $type;
    }
	
	function getSlug(){
        return $this->slug;
    }

    function getShowFront() {
        return $this->showFront;
    }

    function setShowFront($showFront) {
        $this->showFront = $showFront;
    }

    public function id() {
        return $this->id;
    }

    function getExperience() {
        return $this->experience;
    }

    function setExperience($experience) {
        $this->experience = $experience;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setTeam(ManagementType $type) {
        $this->type = $type;
    }

    public function getTeam() {
        return $this->type;
    }

    public function setStatus($status) {
        $this->active = $status;
    }

    public function getStatus() {
        return $this->active;
    }

}

?>