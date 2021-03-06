<?php

namespace faq\models;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="faq\models\FaqRepository")
 * @Table(name="dtn_faqcat")
 */
class Faqcat {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", nullable=false, length=255 )
     */
    private $name;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    /**
     * @Column(type="boolean", nullable=false)
     */
    private $status = true;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @gedmo\Timestampable(on="update")
     * @Column(type="datetime")
     */
    private $updated;

    /**
     * @ManyToOne(targetEntity="\user\models\User")
     */
    private $user;

    /**
     * @OneToMany(targetEntity="Faqs", mappedBy="faqcat")
     */
    private $faqs;

    public function __construct() {

        $this->faqss = new ArrayCollection;
    }

    public function id() {
        return $this->id;
    }
    
    function getFaqs() {
        return $this->faqs;
    }

    function setFaqs($faqs) {
        $this->faqs = $faqs;
    }

    
    public function setUser(\user\models\User $user) {
        $this->user = $user;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setVal($field, $val = '') {
        if (is_array($val))
            $val = serialize($val);
        $this->$field = $val;
    }

    public function setValClean($field, $val = '') {
        $this->$field = mysql_real_escape_string(strip_tags(trim($val)));
    }

    public function getVal($field) {
        return ($this->is_serialized($this->$field)) ? unserialize($this->$field) : $this->$field;
    }

    public function activate() {
        $this->status = true;
    }

    public function deactivate() {
        $this->status = false;
    }

    public function getStatus() {
        return $this->status;
    }

    public function is_serialized($data) {
        # courtesy: wordpress
        if (!is_string($data))
            return false;
        $data = trim($data);
        if ('N;' == $data)
            return true;
        if (!preg_match('/^([adObis]):/', $data, $badions))
            return false;
        switch ($badions[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data))
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data))
                    return true;
                break;
        }
        return false;
    }

}
