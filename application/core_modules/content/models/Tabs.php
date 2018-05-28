<?php

namespace content\models;

use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="content\models\ContentRepository")
 * @Table(name="dtn_content_tabs")
 */
class Tabs
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
     * @Column(type="text", nullable=false)
     */
    private $body;
	

	/**
	* @ManyToOne(targetEntity="Content")
	*/
	private $content;
	
 
	public function __construct($title=NULL)
	{
		if (isset($title)) $this->title = $title;
	}
	
	public function id() { return $this->id; }
	
	public function setTitle($title) { $this->title = $title; }
	
	public function getTitle() { return $this->title; }
	
	public function setBody($body) { $this->body = $body; }
	
	public function getBody() {	return $this->body; }
	
	
	public function setContent(Content $content){$this->content = $content;}
	public function getContent(){return $this->content;}
	
}
?>