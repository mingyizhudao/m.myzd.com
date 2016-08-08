<?php

class WeixinpubModule extends CWebModule {
    
    //公众号ID
    public $weixinpubId = 'myzd01';//患者端服务号正式环境
    
    //微信二维码存取路径
    public $qrcodePath = 'qrcode';
    
    
    public function init() {
        $this->setImport(array(
            'weixinpub.models.*',
            'weixinpub.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            return true;
        } else{
            return false;
        }      
    }

}
