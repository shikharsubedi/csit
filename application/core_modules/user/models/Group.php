<?php

namespace user\models;
use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="user\models\UserRepository")
 * @Table(name="dtn_group")
 */
class Group
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
	* @Column(type="string")
	*/
	private $status='active';
	
	/**
     * @ManyToMany(targetEntity="User", mappedBy="groups")
     */
    private $users;
	
	/**
     * @ManyToMany(targetEntity="Permissions")
	 * @JoinTable(name="dtn_group_permission")
     */
    private $permissions;
	
	
	public function __construct($name = '')
	{
		if($name != '')
			$this->setName($name);
		$this->users = new ArrayCollection();
		$this->permissions = new ArrayCollection();
	}
	
	public function id(){
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setName($value)
	{
		$this->name = $value;	
	}
	
	public function getName()
	{
		return $this->name;	
	}
	
	public function getUsers()
    {
        return $this->users;
    }
	
	public function getStatus()
	{
		return $this->status;
	} 
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getPermissions()
    {
        return $this->permissions;
    }
	
	public function assignPermission(Permissions $permission)
    {
        $this->permissions[] = $permission;
    }
	
	public function unassignPermission(Permissions $permission)
	{
		$this->permissions->removeElement($permission);
	}
	
}