<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class gallerymodelsAlbumProxy extends \gallery\models\Album implements \Doctrine\ORM\Proxy\Proxy
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

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setOrder($order)
    {
        $this->__load();
        return parent::setOrder($order);
    }

    public function getOrder()
    {
        $this->__load();
        return parent::getOrder();
    }

    public function setDescription($description)
    {
        $this->__load();
        return parent::setDescription($description);
    }

    public function getDescription()
    {
        $this->__load();
        return parent::getDescription();
    }

    public function setCoverImage(\gallery\models\Image $coverimage = NULL)
    {
        $this->__load();
        return parent::setCoverImage($coverimage);
    }

    public function getCoverImage()
    {
        $this->__load();
        return parent::getCoverImage();
    }

    public function createdOn()
    {
        $this->__load();
        return parent::createdOn();
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function setUser(\user\models\User $user)
    {
        $this->__load();
        return parent::setUser($user);
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

    public function addImage(\gallery\models\Image $img)
    {
        $this->__load();
        return parent::addImage($img);
    }

    public function removeImage(\gallery\models\Image $img)
    {
        $this->__load();
        return parent::removeImage($img);
    }

    public function getImages()
    {
        $this->__load();
        return parent::getImages();
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'slug', 'description', 'coverimage', 'images', 'created', 'user', 'status', 'order');
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