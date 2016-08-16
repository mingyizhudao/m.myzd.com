<?php
/**
 * Description of TestController
 *
 * @author Administrator
 */
header("Content-type: text/html; charset=utf-8");
class TestController extends WeixinpubController {
	
    public $layout = false;
    
    public function actionTest001(){
        $this->render('test001');
    }
    
    public function actionTest002(){
        $weixinpub_id = Yii::app()->getModule('weixinpub')->weixinpubId;
        $wechatKeyWord = WechatKeyWord::model()->getAllByAttributes(array('weixinpub_id'=>$weixinpub_id));
        var_dump($wechatKeyWord);
    }
    
    public function actionTest003(){
        $weixinpub_id = Yii::app()->getModule('weixinpub')->weixinpubId;
        echo WechatBaseInfo::model()->getByAttributes(array('weixinpub_id'=>$weixinpub_id))->getAccessToken();
        Yii::app()->end();
    }
    
    
    //memcache 缓存技术测试
    public function actionTest004(){
        $mem = Yii::app()->cache;
        //echo $mem->getVersion();
        //echo "</br>";
        
        $mem->set('key01','hello today');
        echo $mem->get('key01');
    }
    
}
