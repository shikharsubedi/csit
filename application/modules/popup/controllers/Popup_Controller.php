<?php

use popup\models\Popup,
    Doctrine\Common\Util\Debug;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popup_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function latest() {
        $popupRepo = $this->doctrine->em->getRepository('popup\models\Popup');

        $data['popup'] = $popupRepo->getLatestPopup();

        if ($data['popup'])
            $this->load->view('popup/front/latest', $data);
    }

}
