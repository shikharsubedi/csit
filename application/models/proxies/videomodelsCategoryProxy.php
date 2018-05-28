<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class videomodelsCategoryProxy extends \video\models\Category implements \Doctrine\ORM\Proxy\Proxy
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
    
    
    public function id()
    {
        $this->__load();
        return parent::id();
    }

    public function setUser(\user\models\User $user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function getOrder()
    {
        $this->__load();
        return parent::getOrder();
    }

    public function getCreated()
    {
        $this->__load();
        return parent::getCreated();
    }

    public function getUpdated()
    {
        $this->__load();
        return parent::getUpdated();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function setOrder($order)
    {
        $this->__load();
        return parent::setOrder($order);
    }

    public function setCreated($created)
    {
        $this->__load();
        return parent::setCreated($created);
    }

    public function setUpdated($updated)
    {
        $this->__load();
        return parent::setUpdated($updated);
    }

    public function activate()
    {
        $this->__load();
        return parent::activate();
    }

    public function deactivate()
    {
        $this->__load();
        return parent::deactivate();
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function addVideo(\video\models\Video $video)
    {
        $this->__load();
        return parent::addVideo($video);
    }

    public function removeVideo(\video\models\Video $video)
    {
        $this->__load();
        return parent::removeVideo($video);
    }

    public function getVideo()
    {
        $this->__load();
        return parent::getVideo();
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'title', 'order', 'status', 'slug', 'created', 'updated', 'user', 'video');
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