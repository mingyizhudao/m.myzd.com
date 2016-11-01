<?php
class ConsultativeController extends MobileController {
    public function actionIndex() {
        $this->render('index');
    }
    //wifi落地页
     public function actionWifi() {
        $this->render('wifi');
    }
}
