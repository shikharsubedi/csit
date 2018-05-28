<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_Controller extends Front_Controller {

    public function index($gID) {

        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');

        $images = $sliderRepo->findBy(array('status' => STATUS_ACTIVE, 'group' => $gID), array('order' => 'ASC'));

        if ($gID == '1') {
            $this->load->theme("slider", array('slider' => $images,));
        } else {
            $this->load->theme("minislider", array('slider' => $images,));
        }
    }

    public function contact($gID = '2') {

        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');

        $images = $sliderRepo->findBy(array('status' => STATUS_ACTIVE, 'group' => $gID), array('order' => 'ASC'));

        if ($gID == '1') {
            $this->load->theme("slider", array('slider' => $images,));
        } else {
            $this->load->theme("contact_us_slider", array('slider' => $images,));
        }
    }

    public function _widget($gID = '13') {

        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');

        $images = $sliderRepo->getImages(array(
            'status' => STATUS_ACTIVE,
                //'type' => 'widget'
        ));

        $this->load->view('slider/front/slider', array('images' => $images,));
    }

}

?>