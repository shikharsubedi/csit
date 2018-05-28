<?php

namespace user\models;
use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity
 * @Table(name="dtn_permissions")
 */
class Permissions
{
	/**
     * @Id
     * @Column(type="integer")
	 * @GeneratedValue
     */
    private $id;

	 /**
     * @Column(type="string", length=255, nullable=false,unique=true)
     */
    private $name;
	
	/**
     * @Column(type="text", nullable=false)
     */
    private $des;
	
	
	public function __construct()
	{
	}
	
	public function id(){
		return $this->id;
	}
	
	public function setName($value)
	{
		$this->name = $value;	
	}
	
	public function getName()
	{
		return $this->name;	
	}
	
	public function setDesc($value)
	{
		$this->des = $value;
	}
	
	public function getDesc()
	{
		return $this->des;	
	}
	
	
}