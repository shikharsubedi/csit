<?php

namespace downloads\models;

use Doctrine\Common\Collections\ArrayCollection,
    downloads\models\Download,
    Gedmo\Mapping\Annotation as Gedmo;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity
 * @Table(name="dtn_download_category")
 */
class Download_category {

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
     * @OneToMany(targetEntity="downloads\models\Download", mappedBy="download_category")
     * @JoinColumn(onDelete="cascade")
     */
    private $download;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @Column(type="string", length=255, nullable=false,unique = true)
     */
    private $slug;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $status = STATUS_ACTIVE;

    /**
     * @Column(name="orderby",type="integer", length=11, nullable=false)
     */
    private $order = 0;

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
        $this->images = new ArrayCollection;
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

    public function activate() {
        $this->status = STATUS_ACTIVE;
    }

    public function deactivate() {
        $this->status = STATUS_INACTIVE;
    }

    public function getStatus() {
        return $this->status;
    }

    public function addDownload(Download $download) {
        $this->download[] = $download;
    }

    public function removeDownload(Download $download) {
        $this->download->removeElement($download);
    }

    public function getDownloads() {
        return $this->download;
    }
    
    function getSlug() {
        return $this->slug;
    }



}

?>