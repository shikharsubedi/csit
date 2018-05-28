<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_Controller extends Xhr {

    public function __construct() {
        parent::__construct();
    }

    public function updateOrder() {
        $arr = explode('|', $this->input->post('ordering'));

        for ($i = 0; $i < count($arr); $i++) {
            $this->db->where(array('sn' => $arr[$i]));

            $data = array('order' => $i + 1);

            $this->db->update('clients', $data);
        }
    }

    public function setActivate() {
        $sn = $this->input->post('id');
        $value = $this->input->post('value');

        $data = array('published' => $value);

        $this->db->where('id', $sn);
        $this->db->update('content', $data);
    }

    //get the page list got the editor plugin
    public function getPagesEditor() {
        $this->load->helper('content/content');
        $this->load->helper('string');
        echo pageSelectTree();
    }
    
    
   

    public function getShareData() {
        $company_id = Options::get('stock_company_id', 'COM-000210');
        $params = array('company_id' => $company_id); //COM-000323
        $wsdl = "http://www.nepalsharemarket.com/JambDataService/PremiumService.asmx?WSDL";
        try {
            $soap = @new SoapClient($wsdl, array('exceptions' => TRUE));

            //show_pre($soap); 
            $result = $soap->getMarketDetailsArrayResult($params);
//            $result = $soap->getMarketDetailsArray($params);
            show_pre($result);exit;
            $close_value = $result->getMarketDetailsArrayResult->string[3];
            $stock_date = $result->getMarketDetailsArrayResult->string[4];
            $max = $result->getMarketDetailsArrayResult->string[1];
            $min = $result->getMarketDetailsArrayResult->string[2];
            $stock_date = date("Y-M-d", strtotime(str_replace(",", "", $stock_date)));

            $error = 0;
            $face_value = Options::get('forex_face_value', 100);
            $shares = Options::get('forex_number_shares', 200000000);
            $capitalization = number_format($close_value * $shares);
            $close_value = number_format($close_value);

            $data = array('face_value' => $face_value,
                'market_value' => $close_value,
                'capital' => number_format($close_value * $shares, 0, '.', ','),
                'stock_date' => $stock_date);

            //show_pre($data);exit;
            $this->load->theme('shares', $data);
        } catch (SoapFault $fault) {
            die("Information not available at this moment.");
        }
    }

}
