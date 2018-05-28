<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class contentmodelsContentProxy extends \content\models\Content implements \Doctrine\ORM\Proxy\Proxy
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
    
    
    public function getImage()
    {
        $this->__load();
        return parent::getImage();
    }

    public function setImage($image)
    {
        $this->__load();
        return parent::setImage($image);
    }

    public function id()
    {
        $this->__load();
        return parent::id();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function setBody($body)
    {
        $this->__load();
        return parent::setBody($body);
    }

    public function getBody()
    {
        $this->__load();
        return parent::getBody();
    }

    public function setType($type)
    {
        $this->__load();
        return parent::setType($type);
    }

    public function getType()
    {
        $this->__load();
        return parent::getType();
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function setStatus($status)
    {
        $this->__load();
        return parent::setStatus($status);
    }

    public function setMetaTitle($meta_title)
    {
        $this->__load();
        return parent::setMetaTitle($meta_title);
    }

    public function getMetaTitle()
    {
        $this->__load();
        return parent::getMetaTitle();
    }

    public function setMetaDescription($meta_description)
    {
        $this->__load();
        return parent::setMetaDescription($meta_description);
    }

    public function getMetaDescription()
    {
        $this->__load();
        return parent::getMetaDescription();
    }

    public function setMetaKeyword($meta_keyword)
    {
        $this->__load();
        return parent::setMetaKeyword($meta_keyword);
    }

    public function getMetaKeyword()
    {
        $this->__load();
        return parent::getMetaKeyword();
    }

    public function setAuther(\user\models\User $user)
    {
        $this->__load();
        return parent::setAuther($user);
    }

    public function getAuthor()
    {
        $this->__load();
        return parent::getAuthor();
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }

    public function getTaxonomies()
    {
        $this->__load();
        return parent::getTaxonomies();
    }

    public function addTaxonomy(\content\models\Taxonomy $taxonomy)
    {
        $this->__load();
        return parent::addTaxonomy($taxonomy);
    }

    public function removeTaxonomy(\content\models\Taxonomy $taxonomy)
    {
        $this->__load();
        return parent::removeTaxonomy($taxonomy);
    }

    public function getParent()
    {
        $this->__load();
        return parent::getParent();
    }

    public function setParent(\content\models\Content $parent)
    {
        $this->__load();
        return parent::setParent($parent);
    }

    public function created()
    {
        $this->__load();
        return parent::created();
    }

    public function updated()
    {
        $this->__load();
        return parent::updated();
    }

    public function publish()
    {
        $this->__load();
        return parent::publish();
    }

    public function unPublish()
    {
        $this->__load();
        return parent::unPublish();
    }

    public function getChildren()
    {
        $this->__load();
        return parent::getChildren();
    }

    public function addChild(\content\models\Content $child)
    {
        $this->__load();
        return parent::addChild($child);
    }

    public function removeChild(\content\models\Content $child)
    {
        $this->__load();
        return parent::removeChild($child);
    }

    public function getCategories()
    {
        $this->__load();
        return parent::getCategories();
    }

    public function getTags()
    {
        $this->__load();
        return parent::getTags();
    }

    public function getMetaData()
    {
        $this->__load();
        return parent::getMetaData();
    }

    public function getMeta($key)
    {
        $this->__load();
        return parent::getMeta($key);
    }

    public function addMeta(\content\models\ContentMeta $meta)
    {
        $this->__load();
        return parent::addMeta($meta);
    }

    public function removeMeta(\content\models\ContentMeta $meta)
    {
        $this->__load();
        return parent::removeMeta($meta);
    }

    public function setEventdate($eventdate)
    {
        $this->__load();
        return parent::setEventdate($eventdate);
    }

    public function getEventdate()
    {
        $this->__load();
        return parent::getEventdate();
    }

    public function setFeaturedBanner($featured_banner)
    {
        $this->__load();
        return parent::setFeaturedBanner($featured_banner);
    }

    public function getFeaturedBanner()
    {
        $this->__load();
        return parent::getFeaturedBanner();
    }

    public function setOrder($orderby)
    {
        $this->__load();
        return parent::setOrder($orderby);
    }

    public function getOrder()
    {
        $this->__load();
        return parent::getOrder();
    }

    public function getShowfront()
    {
        $this->__load();
        return parent::getShowfront();
    }

    public function setShowfront($showfront)
    {
        $this->__load();
        return parent::setShowfront($showfront);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'title', 'image', 'body', 'type', 'slug', 'user', 'eventdate', 'parent', 'children', 'taxonomies', 'status', 'created', 'updated', 'metadata', 'meta_title', 'meta_description', 'meta_keyword', 'featured_banner', 'orderby', 'showfront');
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