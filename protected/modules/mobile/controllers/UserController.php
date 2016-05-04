<?php

class UserController extends MobileController {

    public $current_page;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('register', 'ajaxRegister', 'login', 'commonProblem', 'index', 'getCaptcha', 'valiCaptcha', 'captcha', 'ajaxCaptchaCode', 'ajaxForgetPassword'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('logout', 'view', 'changePassword'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    //进入患者注册页面
    public function actionRegister() {
        $userRole = StatCode::USER_ROLE_PATIENT;
        $form = new UserRegisterForm();
        $form->role = $userRole;
        $form->terms = 1;

        $this->performAjaxValidation($form);
        $this->render('register', array(
            'model' => $form,
        ));
    }

    //无刷新注册
    public function actionAjaxRegister() {
        $output = array('status' => 'no');
        $userRole = StatCode::USER_ROLE_PATIENT;
        $form = new UserRegisterForm();
        $form->role = $userRole;
        $form->terms = 1;
        $this->performAjaxValidation($form);
        if (isset($_POST['UserRegisterForm'])) {
            $values = $_POST['UserRegisterForm'];
            $form->setAttributes($values, true);
            $userMgr = new UserManager();
            $userMgr->registerNewUser($form);
            if ($form->hasErrors() === false) {
                // success                
                $loginForm = $userMgr->autoLoginUser($form->username, $form->password, $userRole, 1);
                $output['status'] = 'ok';
            }
            $output['error'] = $form->getErrors();
        }
        $this->renderJsonOutput($output);
    }

    public function actionView() {
        $user = $this->getCurrentUser();
        $booking = new Booking();
        $bookingModels = $booking->getBookingByMobileORUserId($user['id'], $user['mobile']);
        $output = array();
        foreach ($bookingModels as $model) {
            $data = new stdClass();
            //$data->id =$model->id;
            $data->num = $model->num;
            $data->bkStatus = $model->bk_status;
            $data->bkStatusText = $model->getBkStatus();
            $output[] = $data;
        }
        $this->render('view', array('user' => $user, 'data' => $output));
    }

    public function actionCommonProblem() {
        $this->render('commonProblem');
    }

    public function actionIndex($page) {
        $this->current_page = $page;
        $this->render('index');
    }

    public function actionAjaxCaptchaCode() {
        if (strcmp($_REQUEST['captcha_code'], Yii::app()->session['code']) != 0) {
            $output['status'] = 'no';
            $output['error'] = '验证码错误';
            $this->renderJsonOutput($output);
        } else {
            if (isset($_POST['UserDoctorMobileLoginForm'])) {
                $model = new UserDoctorMobileLoginForm;
//        $values['captcha_code'] = 'mdtufa';
                $values = $_POST['UserDoctorMobileLoginForm'];
            }
            if (isset($_POST['UserVerifyCodeLoginForm'])) {
                $model = new UserVerifyCodeLoginForm;
                $values = $_POST['UserVerifyCodeLoginForm'];
            }

            $model->setAttributes($values, true);
            echo (CActiveForm::validate($model));
            Yii::app()->end();
        }
    }

    //登陆
    public function actionLogin() {
        $returnUrl = $this->getReturnUrl($this->createUrl('user/view'));
        $user = $this->getCurrentUser();
        //用户已登陆 直接进入个人中心
        if (isset($user)) {
            $this->redirect(array('view'));
        }
        $form = new UserDoctorMobileLoginForm();
        $form->role = StatCode::USER_ROLE_PATIENT;
        if (isset($_POST['UserDoctorMobileLoginForm'])) {
            $values = $_POST['UserDoctorMobileLoginForm'];
            $form->setAttributes($values, true);
            $form->autoRegister = false;
            $userMgr = new UserManager();
            $values = array('login_type' => 2, 'username' => '13611988792' ,'captcha_code' =>1 ,'password' =>'123456');
            if($values['login_type'] == StatCode::USER_MOBILE_LOGIN){
                $isSuccess = $userMgr->mobileLogin($form);
            }else if($values['login_type'] == StatCode::USER_PASSWORD_LOGIN){
                if(isset($values['username']) && isset($values['password'])){
                    $isSuccess = $userMgr->autoLoginUser($values['username'],$values['password'],StatCode::USER_ROLE_PATIENT);
                }
            }else{
                //失败 则返回登录页面
                $captcha_code = isset($values['captcha_code'])? $values['captcha_code']:'';
                $this->render("login", array(
                    'model' => $form,
                    'captcha_code' => $captcha_code,
                    'returnUrl' => $returnUrl
                ));
            }
            //var_dump($returnUrl);exit;
            if ($isSuccess) {
                $url = $_POST['returnUrl'];
                // $user = $this->getCurrentUser();
                $this->redirect($url);
            }
        }
        //失败 则返回登录页面
        $captcha_code = isset($values['captcha_code'])? $values['captcha_code']:'';
        $this->render("login", array(
            'model' => $form,
            'captcha_code' => $captcha_code,
            'returnUrl' => $returnUrl
        ));
    }

    //修改密码
    public function actionChangePassword() {
        $user = $this->getCurrentUser();
        $form = new UserPasswordForm('new');
        $form->initModel($user);
        $this->performAjaxValidation($form);
        if (isset($_POST['UserPasswordForm'])) {
            $form->attributes = $_POST['UserPasswordForm'];
            $userMgr = new UserManager();
            $success = $userMgr->doChangePassword($form);
            if ($this->isAjaxRequest()) {
                if ($success) {
                    Yii::app()->user->logout();
                    //do anything here
                    echo CJSON::encode(array(
                        'status' => 'true'
                    ));
                    Yii::app()->end();
                } else {
                    $error = CActiveForm::validate($form);
                    if ($error != '[]') {
                        echo $error;
                    }
                    Yii::app()->end();
                }
            } else {
                if ($success) {
                    Yii::app()->user->logout();
                    $this->setFlashMessage('user.password', '密码修改成功！');
                }
            }
        }
        $this->render('changePassword', array(
            'model' => $form
        ));
    }

    //进入忘记密码页面
    public function actionForgetPassword() {
        $form = new ForgetPasswordForm();
        $this->render('forgetPassword', array(
            'model' => $form,
        ));
    }

    //忘记密码功能
    public function actionAjaxForgetPassword() {
        $output = array('status' => 'no');
        $form = new ForgetPasswordForm();
        if (isset($_POST['ForgetPasswordForm'])) {
            $form->attributes = $_POST['ForgetPasswordForm'];
            if ($form->validate()) {
                $userMgr = new UserManager();
                $user = $userMgr->loadUserByUsername($form->username);
                if (isset($user)) {
                    $success = $userMgr->doResetPassword($user, null, $form->password_new);
                    if ($success) {
                        $output['status'] = 'ok';
                    } else {
                        $output['errors']['errorInfo'] = '密码修改失败!';
                    }
                } else {
                    $output['errors']['username'] = '用户不存在';
                }
            } else {
                $output['errors'] = $form->getErrors();
            }
        }

        $this->renderJsonOutput($output);
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect('login');
    }

}
