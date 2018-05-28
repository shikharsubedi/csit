<?php

namespace content\models;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity
 * @Table(name="dtn_term_taxonomy")
 */
class Taxonomy {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Term",inversedBy="taxonomy")
     */
    private $term;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $taxonomy;

    /**
     * @ManyToOne(targetEntity="Taxonomy", inversedBy="children")
     */
    private $parent;

    /**
     * @OneToMany(targetEntity="Taxonomy", mappedBy="parent", orphanRemoval=true)
     */
    private $children;

    /**
     * @ManyToMany(targetEntity="Content",mappedBy="taxonomies")
     * @JoinTable(name="dtn_term_relationship")
     */
    private $contents;

    public function __construct(Term $term = NULL, $taxonomy = '') {
        if (!is_null($term))
            $this->term = $term;
        if ($taxonomy != '')
            $this->taxonomy = $taxonomy;

        $this->contents = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function id() {
        return $this->id;
    }

    public function getTerm() {
        return $this->term;
    }

    public function setTerm(Term $term) {
        $this->term = $term;
    }

    public function setTaxonomy($taxonomy) {
        $this->taxonomy = $taxonomy;
    }

    public function getTaxonomy() {
        return $this->taxonomy;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent(Taxonomy $parent) {
        $this->parent = $parent;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild(Taxonomy $child) {
        $this->children[] = $child;
    }

    public function removeChild(Taxonomy $child) {
        $this->children->removeElement($child);
    }

    public function getContents() {
        return $this->contents;
    }

    public static function getCategories() {

        $categories = \CI::$APP->doctrine->em->getRepository('content\models\Taxonomy')->findBy(array());

        if ($categories) {

            return $categories;
        }
    }

}

?>