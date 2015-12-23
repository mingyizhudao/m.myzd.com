<?php

class HomeController extends AdminController {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login', 'captcha'),
                'users' => array('*')
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array(Yii::app()->params['admin'])
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => 6,
                'offset' => 0,
                'testLimit' => 3
            // 'height' => 34
            ),
        );
    }

    public function actionIndex() {
        
        $this->render('index');
    }

    public function actionLogin() {
        $model = new AdminLoginForm();

        /*    if (Yii::app()->user->getState(self::SESSION_KEY_LOGIN_ATTEMPTS) > 2) { //make the captcha required if the unsuccessful attemps are more of thee
          $model->scenario = 'withCaptcha';
          }
         * 
         */

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];

            if ($model->validate() && $model->login()) {

                $this->redirect(array('default/index'));
            }
            // var_dump($model->getErrors());exit;
        }

        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('index'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        } else {
            $this->redirect(Yii::app()->getHomeUrl());
        }
    }

}
