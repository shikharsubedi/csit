<?php
namespace content\events;

use Symfony\Component\EventDispatcher\Event;

class ContentFormReadyEvent extends Event
{
	
	protected $customFileds = array();
	
	protected $content = NULL;
	
	protected $contentType = 'page';
	
	public function getCustomFields(){
		return $this->customFileds;
	}
	
	public function addCustomField(array $field){
		$this->customFileds[] = $field;
	}
	
	public function setContent(\content\models\Content $content){
		$this->content = $content;
	}
	
	public function getContent(){
		return $this->content;
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