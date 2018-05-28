<?php

namespace footer\models;
use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="footer\models\FooterRepository")
 * @Table(name="f1_footer_group")
 */
class FooterGroup
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
	* @Column(name="order_by",type="integer", length=11)
	*/
	private $order = 0;

	
	/**
	* @OneToMany(targetEntity="Footer", mappedBy="group")
	*/
	private $links;

	/**
	* @Column(type="boolean")
	*/
	private $active = TRUE;
	
	public function __construct(){
		$this->links = new ArrayCollection;
	}
	
	public function id(){return $this->id;}
	
	public function setName($name){$this->name = $name;}
	public function getName(){return $this->name;}
	
	public function getLinks(){return $this->links;}

	public function setOrder($order){$this->order = $order;}
	public function getOrder(){return $this->order;}
	
	public function addLink(Footer $link){$this->links[] = $link;}
	public function removeLink(Footer $link){$this->links->removeElement($link);}

	public function getStatus() { return $this->active; }
	
	public function activate() { $this->active = 1; }
	
	public function deactivate() { $this->active = 0; }

}
?>