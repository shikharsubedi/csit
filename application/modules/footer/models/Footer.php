<?php

namespace footer\models;

use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="footer\models\FooterRepository")
 * @Table(name="f1_footer")
 */
class Footer
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
    private $title;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $url;


	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $type;
	
	
	/**
	* @Column(name="order_by",type="integer", length=11)
	*/
	private $order = 0;
	
	/**
	* @ManyToOne(targetEntity="FooterGroup",inversedBy="links")
	*/
	private $group;
	
	
	/**
	* @Column(type="boolean")
	*/
	private $active = TRUE;
	
	public function __construct($title = '')
	{
		if($title != '')
			$this->title = $title;
	}

	public function id(){ return $this->id; }
	
	public function setTitle($title) { $this->title = $title;}
	public function getTitle() { return $this->title; }
	
	public function setUrl($url) { $this->url = $url;}
	public function getUrl() { return $this->url;}

	public function setType($type) { $this->type = $type;}
	public function getType() { return $this->type;}

	public function setGroup(FooterGroup $group){$this->group = $group;}
	public function getGroup(){return $this->group;}

	public function setOrder($order){$this->order = $order;}
	public function getOrder(){return $this->order;}

	public function createdOn()
	{
		return $this->created;
	}

	public function getStatus()
	{
		return $this->active;
	}
	
	public function activate()
	{
		$this->active = 1;
	}
	
	public function deactivate()
	{
		$this->active = 0;
	}
	
}
?>