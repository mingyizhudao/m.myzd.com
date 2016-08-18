<?php
/**
 * 通过网页授权获取openid通用方法
 *
 * @author zhongtw
 */
class WechatOauth2 {
    
    
    private $appId;
    
    private $appSecret;
    
    
    function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }
    
    
    /**
     * 通过code获得openid
     * @return type
     */
    public function GetOpenid($currentUrl, $code){
        if (!isset($code)){//请求中没有code,通过页面跳转获取code
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            $redirect_uri = urlencode($currentUrl);
            $url = sprintf($url, $this->appId, $redirect_uri);           
            Header("Location: $url");
            Yii::app()->end();
        } else {//请求中有code，通过code获取openid
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code";
            $url = sprintf($url, $this->appId, $this->appSecret, $code);
            $data = CommonConfig::https_get($url);
            $openid = $data['openid'];
            return $openid;
        }
    }
	
    
}
