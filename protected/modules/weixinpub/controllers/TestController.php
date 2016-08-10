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
    
}
