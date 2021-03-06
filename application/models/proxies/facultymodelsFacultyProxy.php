<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class facultymodelsFacultyProxy extends \faculty\models\Faculty implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }

    public function getContent()
    {
        $this->__load();
        return parent::getContent();
    }

    public function setContent($content)
    {
        $this->__load();
        return parent::setContent($content);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getDescription()
    {
        $this->__load();
        return parent::getDescription();
    }

    public function setDescription($description)
    {
        $this->__load();
        return parent::setDescription($description);
    }

    public function getOrder()
    {
        $this->__load();
        return parent::getOrder();
    }

    public function setOrder($order)
    {
        $this->__load();
        return parent::setOrder($order);
    }

    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function getAppliedStudents()
    {
        $this->__load();
        return parent::getAppliedStudents();
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function setAppliedStudents($appliedStudents)
    {
        $this->__load();
        return parent::setAppliedStudents($appliedStudents);
    }

    public function setStatus($status)
    {
        $this->__load();
        return parent::setStatus($status);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'email', 'slug', 'description', 'content', 'appliedStudents', 'order', 'status');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}