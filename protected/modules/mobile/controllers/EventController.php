<?php

class EventController extends MobileController {

    public $current_page;

    public function actionView($page) {
        $this->current_page = $page;
        $this->render('view');
    }

    public function actionIndex() {
        $this->render('index');
    }

}
