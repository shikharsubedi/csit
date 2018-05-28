<?php


namespace testimonial\models;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Entity(repositoryClass="testimonial\models\TestimonialRepository")
 * @Table(name="dtn_testimonial")
 */
class Testimonial {    
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
     * @Column(type="string",length=255)
     */
    private $image;
    
    /**
     * @Column(type="text", nullable=false)
     */
    private $body;
    
    /**
     *  @gedmo\Timestampable(on="create") 
     * @Column(type="datetime") 
     */
    private $created;
    
    /**
     * @Column(name="order_by",type="integer", length=11)
     */
    private $order = 0;
    
    /**
     * @Column(type="integer", nullable=false )
     */
    private $showFront = '0';
    
    /**
     * @Column(type="integer", nullable=false)
     */
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getImage() {
        return $this->image;
    }

    function getBody() {
        return $this->body;
    }

    function getCreated() {
        return $this->created;
    }

    function getOrder() {
        return $this->order;
    }

    function getShowFront() {
        return $this->showFront;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setOrder($order) {
        $this->order = $order;
    }

    function setShowFront($showFront) {
        $this->showFront = $showFront;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}
