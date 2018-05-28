<?php

namespace content\models;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity
 * @Table(name="dtn_terms")
 */
class Term {

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
     * @OneToMany(targetEntity="Taxonomy",mappedBy ="term")
     */
    private $taxonomy;

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
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

    public function getSlug() {
        return $this->slug;
    }

    public function getTaxonomy() {
        return $this->taxonomy;
    }

}

?>