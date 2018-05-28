<?php

namespace management\models;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="management\models\ManagementRepository")
 * @Table(name="dtn_management_type")
 */
class ManagementType {

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
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @OneToMany(targetEntity="management\models\Management", mappedBy="type")
     * @JoinColumn(onDelete="cascade")
     */
    private $people;

    public function __construct() {
        $this->people = new ArrayCollection;
    }

    public function id() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getPeople() {
        return $this->people;
    }

    public function addMember(Management $person) {
        $this->people[] = $person;
    }

    public function removeMember(Management $person) {
        $this->people->removeElement($person);
    }

}

?>