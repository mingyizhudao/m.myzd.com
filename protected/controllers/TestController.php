<?php

class TestController extends WebsiteController {

    public function actionTest() {
        $url1=$this->createUrl('api/list', array('model' => 'appnav1', 'api' => 6));
        var_dump($url1);
        $url = $this->createAbsoluteUrl('api/list', array('model' => 'appnav1', 'api' => 6));
        var_dump($url);
    }
    
    public function actionBooking(){
        $userId=100400;
        $booking = new Booking();
        $list = $booking->getCountBkStatusByUserId($userId);
        
        var_dump($list);
        $ret = array_shift($list);
       // var_dump($ret->attributes);
       var_dump($ret);
    }
   public function actionTest2(){
	Yii::app()->session["testKey1"]= "testValue1";
$v = Yii::app()->session["testKey1"];
var_dump($v);
}


}
