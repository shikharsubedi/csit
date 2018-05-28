<?php

namespace user\models;

use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="user\models\UserRepository")
 * @Table(name="dtn_user_meta")
 */
class UserMeta
{
	
	/**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $meta_id;
    
    /**
     * @ManyToOne(targetEntity="user\models\User")
     */
    private $user;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $meta_key;
	
	/**
     * @Column(type="text", nullable=true)
     */
    private $meta_value = NULL;
	
	public function __construct()
	{
	}
	
	public function id()
	{
		return $this->meta_id;
	}
	
	public function setKey($title)
	{
		$this->meta_key = $title;
	}
	
	public function getKey()
	{
		return $this->meta_key;
	}
	
	public function setValue($body)
	{
		$this->meta_value = $body;
	}
	
	public function getValue()
	{
		return $this->meta_value;
	}
	
	public function setUser(User $u)
	{
		$this->user = $u;
	}
	
	public function getUser()
	{
		return $this->user;
	}
}
?>