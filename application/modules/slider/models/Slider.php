<?php

namespace slider\models;
use Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="slider\models\SliderRepository")
 * @Table(name="f1_slider")
 */
class Slider
{
	const sliderimagePath = 'assets/upload/images/slider/';
	/**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
	 
	 private $id;
	 
	 /**
     * @Column(type="text",  nullable=false)
     */
    private $name;
	/**
     * @ManyToOne(targetEntity="content\models\Content",cascade={"persist","remove"})
     * */
    private $content;
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $type;
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $link;
	
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $image;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $thumbnail;
	
	
	/**
	* @Column(type="string", length=255, nullable=false)
	*/
	private $status;
	
	/**
	* @Column(name="orderby",type="integer", length=11, nullable=false)
	*/
	private $order = 0;
	
	
	public function __construct($name = '')
	{
		if($name != '')
			$this->name = $name;
	}
	
	public function id()
	{
		return $this->id;
	}
	
	public function setOrder($order)
	{
		$this->order = $order;
	}
	function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setImage($image)
	{
		$this->image = $image;
	}
	
	public function getImage()
	{
		return $this->image;
	}
	
	function getLink() {
        return $this->link;
    }
    function setLink($link) {
        $this->link = $link;
    }
	public function setThumbnail($thumbnail)
	{
		$this->thumbnail = $thumbnail;
	}
	
	public function getThumbnail()
	{
		return $this->thumbnail;
	}
	function getType() {
        return $this->type;
    }
     function setType($type) {
        $this->type = $type;
    }
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function activate()
	{
		$this->status = STATUS_ACTIVE;
	}
	
	public function deactivate()
	{
		$this->status = STATUS_INACTIVE;
	}
	
}
?>