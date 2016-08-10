<?php
/**
 * Description of TestController
 *
 * @author Administrator
 */
class TestController extends WeixinpubController {
    
    public function actionTest001(){
        $this->render('test001');
    }
    
    public function actionTest002(){
        $weixinpub_id = Yii::app()->getModule('weixinpub')->weixinpubId;
        $wechatKeyWord = WechatKeyWord::model()->getByAttributes(array('weixinpub_id'=>$weixinpub_id));
        var_dump($wechatKeyWord);
    }
    
}
