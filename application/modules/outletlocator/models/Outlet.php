<?php

namespace outletlocator\models;

use Doctrine\Common\Collections\ArrayCollection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity(repositoryClass="outletlocator\models\OutletRepository")
 * @Table(name="dtn_outlets")
 */
class Outlet {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Column(type="text", length=255, nullable=false)
     */
    private $description;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $latitude;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $longitude;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    private $status = STATUS_ACTIVE;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $phone;

    public function __construct($name = '') {
        if ($name != '')
            $this->name = $name;
    }

    function getPhone() {
        return $this->phone;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function id() {
        return $this->id;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setDistrict($district) {
        $this->district = $district;
    }

    public function getDistrict() {
        return $this->district;
    }

    public function getStatus() {
        return $this->status;
    }

    public function activate() {
        $this->status = STATUS_ACTIVE;
    }

    public function deactivate() {
        $this->status = STATUS_INACTIVE;
    }

}

?>