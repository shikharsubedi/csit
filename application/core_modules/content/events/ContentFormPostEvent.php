<?php

namespace content\events;

use Symfony\Component\EventDispatcher\Event;

class ContentFormPostEvent extends Event
{
	protected $postData;
	
	/**
	 * 
	 * @var content\models\Content
	 */
	protected $content;
	
	protected $contentType = 'page';
	
	public function __construct($postData, \content\models\Content $content){
		$this->postData = $postData;
		$this->content = $content;	
	}
	
	public function getContent(){
		return $this->content;
	}
	
	
	public function get($key){
		if(array_key_exists($key, $this->postData))
			return $this->postData[$key];
		else return NULL;
	}
	
	public function getContentType()
	{
		return $this->contentType;
	}
	
	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
	}
}