<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class faqmodelsFaqsProxy extends \faq\models\Faqs implements \Doctrine\ORM\Proxy\Proxy
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
    
    
    public function getQuestion()
    {
        $this->__load();
        return parent::getQuestion();
    }

    public function getAnswer()
    {
        $this->__load();
        return parent::getAnswer();
    }

    public function setQuestion($question)
    {
        $this->__load();
        return parent::setQuestion($question);
    }

    public function setAnswer($answer)
    {
        $this->__load();
        return parent::setAnswer($answer);
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

    public function getCreated()
    {
        $this->__load();
        return parent::getCreated();
    }

    public function setVal($field, $val = '')
    {
        $this->__load();
        return parent::setVal($field, $val);
    }

    public function setValClean($field, $val = '')
    {
        $this->__load();
        return parent::setValClean($field, $val);
    }

    public function getVal($field)
    {
        $this->__load();
        return parent::getVal($field);
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

    public function is_serialized($data)
    {
        $this->__load();
        return parent::is_serialized($data);
    }

    public function setFaqcat(\faq\models\Faqcat $faqcat)
    {
        $this->__load();
        return parent::setFaqcat($faqcat);
    }

    public function getFaqcat()
    {
        $this->__load();
        return parent::getFaqcat();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'question', 'answer', 'order', 'status', 'created', 'updated', 'user', 'faqcat');
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