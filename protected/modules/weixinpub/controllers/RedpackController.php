<?php
/**
 * 现金红包页面
 *
 * @author Administrator
 */
header("Content-type: text/html; charset=utf-8");
class RedpackController extends WeixinpubController {
    
    private $appId;
    
    private $appSecret;
    
    public function init() {
        parent::init();
        $this->loadWechatAccount();
        $wechatAccount = $this->wechatAccount;
        $this->appId = $wechatAccount->getAppId();    
        $this->appSecret = $wechatAccount->getAppSecret();  
    }
    
    /**
     * 进入红包活动页面
     * @param type $subscriptions_id    订阅号openid
     */
    public function actionActivepage($subscriptions_id) {
        $currentUrl = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $output = new stdClass();
        $mem = Yii::app()->cache;
        if($mem->get('redpackNum') === false){
            $mem->set('redpackNum','0');//初始化参与活动人数
        }
        $redpackNum = $mem->get('redpackNum');//获取已经参与活动的人数
        if($redpackNum >= 5000){//活动人数达到5000
            //$this->render("redpackPage",array('flag'=>'1'));
            echo '活动参与人数达到限制';
            Yii::app()->end();
        }else{
            $mem->set('redpackNum',$redpackNum + 1);//初始化参与活动人数
            $wechatOauth2 = new WechatOauth2($this->appId, $this->appSecret);
            $code = isset($_GET['code']) ? $_GET['code'] : null;
            echo $wechatOauth2->GetOpenid($code);
            Yii::app()->end();
        }
        
    }
}
