<?php

namespace mainmenu\models;

use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @Entity
* @Table(name="dtn_mainmenu")
*/
class Mainmenu
{
	
	const MAINMENU_TYPE_PAGE 		= 'page';
	const MAINMENU_TYPE_CATEGORY 	= 'category';
	const MAINMENU_TYPE_LINK		= 'link';
	const MAINMENU_TYPE_DOWNLOAD	= 'download';
	const MAINMENU_TYPE_REPORT  	= 'report';
	const MAINMENU_TYPE_DESTINATION	= 'destination';
	const MAINMENU_TYPE_PACKAGETYPE	= 'packagetype';
	const MAINMENU_TYPE_BRAND		= 'brand';
	const MAINMENU_TYPE_PRODUCT 	= 'product';
	const MAINMENU_TYPE_MANAGEMENT 	= 'management';
	
	/**
	* @Id
	* @Column(type="integer")
	* @GeneratedValue
	*/
	private $id;
	
	/**
	* @Column(type="string", length=255,nullable=false)
	*/
	private $label;
	
	/**
	* @Column(type="string", length=255,nullable=true)
	*/
	private $topmenu;
	
	/**
	* @Column(type="string",length=255,nullable=true)
	*/
	private $reference;
	
	/**
	* @Column(type="string",length=255,nullable=true)
	*/
	private $type;
	
	/**
	* @Column(name="orderby",type="integer")
	*/
	private $order=0;
	
	/**
	* @ManyToOne(targetEntity="Mainmenu",cascade={"persist"},inversedBy="children")
	* @JoinColumn(onDelete="cascade")
	*/
	private $parent = NULL;
	
	/**
	* @OneToMany(targetEntity="Mainmenu",mappedBy="parent")
	*/
	private $children;
	
	public function __construct()
	{
		$this->children = new ArrayCollection();	
	}
	
	public function id()
	{
		return $this->id;
	}
	
	public function setLabel($label)
	{
		$this->label = $label;
	}
	
	public function getLabel()
	{
		return $this->label;
	}
	
	public function setTopmenu($topmenu)
	{
		$this->topmenu = $topmenu;
	}
	
	public function getTopmenu()
	{
		return $this->topmenu;
	}
	
	public function setReference($reference)
	{
		$this->reference = $reference;
	}
	
	public function getReference()
	{
		return $this->reference;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setParent(Mainmenu $mainmenu)
	{
		$this->parent = $mainmenu;
	}
	
	public function getParent()
	{
		return $this->parent;
	}	

	public function getChildren()
	{
		return $this->children;
	}
	
	public function setOrder($order)
	{
		$this->order = $order;
	}
}
?>