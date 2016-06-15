<?php

class ApiRequestUrl {

//    public $hostInfoProd = 'http://crm560.mingyizd.com';
    private $hostArray = array("http://m.mingyizhudao.com" => "http://crm560.mingyizd.com", "http://wap.dev.mingyizd.com" => "http://crm.dev.mingyizd.com");
    private $admin_salesbooking_create = 'api/adminbooking';

    private function getHostInfo() {
        $hostInfo = strtolower(Yii::app()->request->hostInfo);
        echo $hostInfo;die;
        if (isset($this->hostArray[$hostInfo])) {
            return $this->hostArray[$hostInfo];
        } else {
            return "http://crm.dev.mingyizd.com";
        }
    }

    public function getUrl($url) {
        return $this->getHostInfo() . '/' . $url;
    }

    public function getUrlAdminSalesBookingCreate() {
        return $this->getUrl($this->admin_salesbooking_create);
    }

}
