<?php

namespace content\models;

use Gedmo\Mapping\Annotation as Gedmo,
    user\models\User,
    Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="content\models\ContentRepository")
 * @Table(name="dtn_content")
 */
class Content {

    const CONTENT_TYPE_PAGE = 'page';
    const CONTENT_TYPE_ARTICLE = 'article';

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Column(type="text", nullable=false)
     */
    private $body;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;
    /**
    * @Column(type="boolean", nullable=true)
    */
    private $updatenews=0;

    /**
     * @ManyToOne(targetEntity="user\models\User",inversedBy="contents")
     */
    private $user;

    /**
     * @Column(type="string",nullable=true)
     */
    private $eventdate;

    /**
     * @ManyToOne(targetEntity="Content",cascade={"persist"},inversedBy="children")
     * @JoinColumn(onDelete="SET NULL")
     */
    private $parent = NULL;

    /**
     * @OneToMany(targetEntity="Content",mappedBy="parent")
     */
    private $children;

    /**
     * @ManyToMany(targetEntity="content\models\Taxonomy",inversedBy="contents")
     * @JoinTable(name="dtn_term_relationship")
     */
    private $taxonomies;

    /**
     * @Column(type="string")
     */
    private $status;

    /**
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @Column(type="datetime")
     * @gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @OneToMany(targetEntity="ContentMeta", mappedBy="content", indexBy="meta_key" ,cascade={"persist","remove"})
     */
    private $metadata;
	
	/**
     * @Column(name="meta_title", type="text", nullable=true)
     */
    private $meta_title;

    /**
     * @Column(name="meta_description", type="text", nullable=true)
     */
    private $meta_description;

    /**
     * @Column(name="meta_keyword", type="text", nullable=true)
     */
    private $meta_keyword;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $featured_banner;

    /**
     * @Column(type="integer")
     */
    private $orderby = 0;

    /**
     * @Column(name="showfront",type="integer", length=11)
     */
    private $showfront = 0;


    public function __construct() {
        $this->taxonomies = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->metadata = new ArrayCollection();
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }

    public function id() {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getBody() {
        return $this->body;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
	
	 public function setMetaTitle($meta_title) {
        $this->meta_title = $meta_title;
    }

    public function getMetaTitle() {
        return $this->meta_title;
    }

    public function setMetaDescription($meta_description) {
        $this->meta_description = $meta_description;
    }

    public function getMetaDescription() {
        return $this->meta_description;
    }

    public function setMetaKeyword($meta_keyword) {
        $this->meta_keyword = $meta_keyword;
    }

    public function getMetaKeyword() {
        return $this->meta_keyword;
    }

    public function setAuther(User $user) {
        $this->user = $user;
    }

    public function getAuthor() {
        return $this->user;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getTaxonomies() {
        return $this->taxonomies;
    }

    public function addTaxonomy(Taxonomy $taxonomy) {
        $this->taxonomies[] = $taxonomy;
    }

    public function removeTaxonomy(Taxonomy $taxonomy) {
        $this->taxonomies->removeElement($taxonomy);
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent(Content $parent) {
        $this->parent = $parent;
    }

    public function created() {
        return $this->created;
    }

    public function updated() {
        return $this->updated;
    }

    public function getUpdatenews() {
        return $this->updatenews;
    }

    public function setUpdatenews($updatenews) {
        $this->updatenews = $updatenews;
    }

    public function publish() {
        $this->status = STATUS_ACTIVE;
    }

    public function unPublish() {
        $this->status = STATUS_INACTIVE;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild(Content $child) {
        $this->children[] = $child;
    }

    public function removeChild(Content $child) {
        $this->children->removeElement($child);
    }

    public function getCategories() {
        if ($this->getType() == self::CONTENT_TYPE_ARTICLE) {
            $categories = new ArrayCollection();
            foreach ($this->getTaxonomies() as $t) {
                if ($t->getTaxonomy() == TAXONOMY_CATEGORY)
                    $categories[] = $t;
            }

            return $categories;
        } else
            return FALSE;
    }

    public function getTags() {
        $tags = new ArrayCollection();
        foreach ($this->getTaxonomies() as $t) {
            if ($t->getTaxonomy() == 'tags')
                $tags[] = $t;
        }

        return $tags;
    }

    public function getMetaData() {
        return $this->metadata->toArray();
    }

    public function getMeta($key) {
        if (!isset($this->metadata[$key])) {
            return FALSE;
        }

        return $this->metadata[$key];
    }

    public function addMeta(ContentMeta $meta) {
        $this->metadata[$meta->getKey()] = $meta;
    }

    public function removeMeta(ContentMeta $meta) {
        $this->metadata->removeElement($meta);
    }

    public function setEventdate($eventdate) {
        $this->eventdate = $eventdate;
    }

    public function getEventdate() {
        return $this->eventdate;
    }

    public function setFeaturedBanner($featured_banner) {
        $this->featured_banner = $featured_banner;
    }

    public function getFeaturedBanner() {
        return $this->featured_banner;
    }

    public function setOrder($orderby) {
        $this->orderby = $orderby;
    }

    public function getOrder() {
        return $this->orderby;
    }

    public function getShowfront() {
        return $this->showfront;
    }

    public function setShowfront($showfront) {
        $this->showfront = $showfront;
    }

}

?>