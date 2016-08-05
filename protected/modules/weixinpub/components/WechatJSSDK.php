<?php
/**
 * 微信JSSDK签名验证
 *
 * @author zhongtw
 */
class WechatJSSDK extends WeixinpubController {
    
    private $app_id;
    
    private $jsapi_ticket;
    
    public function init() {

        parent::init();
        
        $this->loadWechatAccount();
        $this->app_id = $this->wechatAccount->getAppId();    
        
        $this->loadWechatBaseInfo();
        $this->jsapi_ticket = $this->wechatBaseInfo->getJsapiTicket();
        
    }
    
    public function GetSignPackage(){
        $nonceStr = CommonConfig::createNonceStr(16);
        $timestamp = time();
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$this->jsapi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->app_id,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        //ob_clean();
        //var_dump($signPackage);
        return $signPackage;
    }
    
}
