<?php

class TestController extends WebsiteController {

    public function actionTest() {
        $url1=$this->createUrl('api/list', array('model' => 'appnav1', 'api' => 6));
        var_dump($url1);
        $url = $this->createAbsoluteUrl('api/list', array('model' => 'appnav1', 'api' => 6));
        var_dump($url);
    }

}
