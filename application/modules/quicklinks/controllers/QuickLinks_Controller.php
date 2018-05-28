<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuickLinks_Controller extends Front_Controller {

    public function index() {
        $Repo = &$this->doctrine->em->getRepository('quicklinks\models\QuickLinks');
        $quickLinks = $Repo->findBy(array('status' => STATUS_ACTIVE), array('id' => 'ASC'));
        $this->load->theme("quicklinks", array('quickLinks' => $quickLinks));        
    }

}
