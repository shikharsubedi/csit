<?php

namespace downloads\models;

use Doctrine\Common\Collections\ArrayCollection,
    downloads\models\Download_category,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="downloads\models\DownloadRepository")
 * @Table(name="dtn_download")
 */
class Download {

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
     * @Column(type="string", length=255, nullable=true)
     */
    private $showFront;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ManyToOne(targetEntity="downloads\models\Download_category", inversedBy="download")
     * @JoinColumn(onDelete="cascade")
     */
    private $download_category;

    /**
     * @var datetime $created
     *
     * @gedmo\Timestampable(on="create")
     * @Column(type="datetime")
     */
    private $created;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $status = STATUS_ACTIVE;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    public function __construct(Download_category $download_category) {
        $this->download_category = $download_category;
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
    
    function getShowFront() {
        return $this->showFront;
    }

    function setShowFront($showFront) {
        $this->showFront = $showFront;
    }

    
    public function getSlug() {
        return $this->slug;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function getFile() {
        return $this->file;
    }

    public function createdOn() {
        return $this->created;
    }

    public function activate() {
        $this->status = STATUS_ACTIVE;
    }

    public function deactivate() {
        $this->status = STATUS_INACTIVE;
    }

    public function getStatus() {
        return $this->status;
    }

}

?>