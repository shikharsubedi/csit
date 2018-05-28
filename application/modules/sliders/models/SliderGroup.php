<?php

namespace slider\models;
use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @Entity(repositoryClass="slider\models\SliderRepository")
* @Table(name="dtn_slider_group")
*/
class SliderGroup
{
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
	* @Column(type="integer", nullable=false)
	*/
	private $width = 0;
	
	/**
	* @Column(type="integer", nullable=false)
	*/
	private $height = 0;	
	
	/**
	* @Gedmo\Slug(fields={"name"})
	* @Column(type="string", length=255, nullable=false,unique = true)
	*/
	private $slug;	
	
	/**
	* @OneToMany(targetEntity="slider\models\Slider", mappedBy="group")
	*/
	private $sliders;
	
	
	public function __construct(){
		$this->sliders = new ArrayCollection;
	}
	
	public function id(){return $this->id;}
	
	public function setName($name){$this->name = $name;}
	public function getName(){return $this->name;}
	/// set+get for height, width
	public function setHeight($height){
		$this->height = $height;
	}
	public function getHeight(){
		return $this->height;
	}
	public function setWidth($width){
		$this->width = $width;
	}
	public function getWidth(){
		return $this->width;
	}
	public function getSliders(){return $this->sliders;}
	
}
?>