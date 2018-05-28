<?php

namespace user\models;
use Gedmo\Mapping\Annotation as Gedmo,
	Doctrine\Common\Collections\ArrayCollection; 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="user\models\UserRepository")
 * @Table(name="dtn_user")
 */
class User
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
    private $firstname;
	
	/**
     * @Column(type="string", length=255, nullable=true)
     */
    private $middlename;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $lastname;
	
	/**
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $username;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $password;
	
	/**
     * @Column(type="string", length=255, nullable=true)
     */
    private $email;
	
	/**
     * @Column(type="string", length=255, nullable=false)
     */
    private $phone;
	
	
	/**
     * @Column(type="string", length=255, nullable=true)
     */
    private $resetcode;
	
	/**
     * @Column(type="string", length=255, nullable=true)
     */
    private $resettime;
	
	/**
	* @Column(type="string")
	*/
	private $status = STATUS_ACTIVE;
	
	/**
     * @var datetime $created
     *
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Column(type="datetime")
     * @gedmo\Timestampable(on="update")
     */
	 
	 private $updated;
	 
	  /**
     * @var \DateTime
     *
     * @Column(name="last_login_date", type="datetime", nullable=true)
     */
    private $lastLoginDate;
	
	/**
     * @Column(name="no_of_login_attempts", type="integer", length=11, nullable=true)
     */
    private $no_of_login_attempts;
	 
	 /**
     * @ManyToMany(targetEntity="Group",inversedBy="users")
     * @JoinTable(name="dtn_user_group")
     */
    private $groups;
	
	
	/**
	* @OneToMany(targetEntity="content\models\Content",mappedBy="user")
	*/
	private $contents;
	
	
	public function __construct()
	{
		$this->groups = new ArrayCollection();
	}
	
	
	public function id()
	{
		return $this->id;
	}
	
	public function created()
	{
		return $this->created;
	} 
	
	public function updated()
	{
		return $this->updated;
	} 
	 
	public function getStatus()
	{
		return $this->status;
	} 
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;	
	}
	
	public function getFirstname()
	{
		return $this->firstname;
	}
	
	public function setMiddlename($middlename)
	{
		$this->middlename = $middlename;	
	}
	
	public function getMiddlename()
	{
		return $this->middlename;
	}
	
	public function getLastname()
	{
		return $this->lastname;
	} 
	
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}
	
	
	public function setUsername($username)
	{
		$this->username = $username;	
	}
	
	public function getUsername()
	{
		return $this->username;	
	}
	
	public function setPassword($password)
	{
		$this->password = $password;	
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;	
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	
	public function setPhone($phone)
	{
		$this->phone = $phone;	
	}
	
	public function getPhone()
	{
		return $this->phone;
	}
	
	public function setResetcode($resetcode)
	{
		$this->resetcode = $resetcode;	
	}
	
	public function getResetcode()
	{
		return $this->Resetcode;
	}
	
	public function setResettime($resettime)
	{
		$this->resettime = $resettime;	
	}
	
	public function getResettime()
	{
		return $this->resettime;
	}
		
	public function assignGroup(Group $role)
    {
        $this->groups[] = $role;
    }
	
	public function unassignGroup(Group $role)
	{
		$this->groups->removeElement($role);
	}
	
	public function getGroups()
    {
        return $this->groups;
    }
	
	public function getContents()
	{
		return $this->contents;
	}
	
	 public function setLastLoginDate()
    {
        $this->lastLoginDate = new \DateTime();
    
        return $this;
    }

    
    public function getLastLoginDate()
    {
        return $this->lastLoginDate;
    }
	
	 public function setLoginAttempts($no_of_login_attempts)
    {
        $this->no_of_login_attempts = $no_of_login_attempts;
    
        return $this;
    }

    
    public function getLoginAttempts()
    {
        return $this->no_of_login_attempts;
    }
}