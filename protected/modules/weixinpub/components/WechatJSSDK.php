<?php
/**
 * 微信JSSDK签名验证
 *
 * @author zhongtw
 */
class WechatJSSDK {
    
    public function GetSignPackage(){
        
        $weixinpubId = Yii::app()->getModule('weixinpub')->weixinpubId;
        $wechatAccount = new WechatAccount();
        $app_id = $wechatAccount->getByPubId($weixinpubId)->getAppId();
        $wechatBaseInfo = new WechatBaseInfo();
        $jsapi_ticket = $wechatBaseInfo->getByPubId($weixinpubId)->getJsapiTicket();
          
        $nonceStr = CommonConfig::createNonceStr(16);
        $timestamp = time();
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $app_id,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        
        return $signPackage;
        
    }
    
}
