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
        $output = new stdClass();
        $mem = Yii::app()->cache;
        if(!check_key_exists($mem, 'peopleNum')){
            $mem->set('peopleNum','0');//初始化参与活动人数
        }
        $peopleNum = $mem->get('peopleNum');//获取已经参与活动的人数
        if($peopleNum >= 5){//活动人数达到5000
            //$this->render("redpackPage",array('flag'=>'1'));
            echo '活动参与人数达到限制';
            Yii::app()->end();
        }else{
            $mem->set('peopleNum',$peopleNum + 1);//初始化参与活动人数
            $wechatOauth2 = new WechatOauth2($this->appId, $this->appSecret);
            echo $wechatOauth2->GetOpenid();
        }
        
    }
}
