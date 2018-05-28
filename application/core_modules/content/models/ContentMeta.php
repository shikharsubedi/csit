<?php

namespace content\models;

use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection;

use user\models\User,
	content\models\Content;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="content\models\ContentRepository")
 * @Table(name="dtn_content_meta")
 */
class ContentMeta
{
	
	/**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $meta_id;
    
    /**
     * @ManyToOne(targetEntity="content\models\Content", cascade={"persist","delete"})
     */
    private $content;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $meta_key;
	
	/**
     * @Column(type="text", nullable=true)
     */
    private $meta_value = NULL;
	
	public function __construct($content = NULL, $key = '')
	{
		if(!is_null($content))
			$this->content = $content;
		
		if($key != '')
			$this->meta_key = $key;
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
	
	public function setContent(Content $c)
	{
		$this->content = $c;
	}
	
	public function getContent()
	{
		return $this->content;
	}
}
?>