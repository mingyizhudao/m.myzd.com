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
                'actions' => array('register', 'ajaxRegister', 'commonProblem', 'index', 'login','loginView','getCaptcha', 'valiCaptcha', 'captcha', 'ajaxCaptchaCode', 'ajaxForgetPassword', 'ajaxLogin', 'forgetPassword'),
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
        $post = $this->decryptInput();
        if (isset($post['UserRegisterForm'])) {
            $values = $post['UserRegisterForm'];
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


    //修改密码
    public function actionChangePassword() {
        $user = $this->getCurrentUser();
        $form = new UserPasswordForm('new');
        $form->initModel($user);
        $this->performAjaxValidation($form);
        $post = $this->decryptInput();
        if (isset($post['UserPasswordForm'])) {
            $form->attributes = $post['UserPasswordForm'];
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
        $post = $this->decryptInput();
        if (isset($post['ForgetPasswordForm'])) {
            $form->attributes = $post['ForgetPasswordForm'];
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
    
    public function actionAjaxLogin() {
        $output = array('status' => 'no');
        $post = $this->decryptInput();
        if (isset($post['UserDoctorMobileLoginForm'])) {
            $loginType = 'sms';
            $smsform = new UserDoctorMobileLoginForm();
            $values = $post['UserDoctorMobileLoginForm'];
            $smsform->setAttributes($values, true);
            $smsform->role = StatCode::USER_ROLE_PATIENT;
            $smsform->autoRegister = false;
            $userMgr = new UserManager();
            $isSuccess = $userMgr->mobileLogin($smsform);
        } else if (isset($post['UserLoginForm'])) {
            $loginType = 'paw';
            $pawform = new UserLoginForm();
            $values = $post['UserLoginForm'];
            $pawform->setAttributes($values, true);
            $pawform->role = StatCode::USER_ROLE_PATIENT;
            $pawform->rememberMe = true;
            $userMgr = new UserManager();
            $isSuccess = $userMgr->doLogin($pawform);
        } else {
            $output['errors'] = 'no data..';
        }
        if ($isSuccess) {
            $output['status'] = 'ok';
        } else {
            if ($loginType == 'sms') {
                $output['errors'] = $smsform->getErrors();
            } else {
                $output['errors'] = $pawform->getErrors();
            }
            $output['loginType'] = $loginType;
        }
        $this->renderJsonOutput($output);
    }

    
    public function actionLogin() {
        $returnUrl = $this->getReturnUrl($this->createUrl('user/view'));
        $user = $this->getCurrentUser();
        //用户已登陆 直接进入个人中心
        if (isset($user)) {
            $this->redirect(array('view'));
        }else{
            $formByPassword = new UserLoginForm();
            $formByMobile = new UserDoctorMobileLoginForm();
            $formByPassword->role = StatCode::USER_ROLE_PATIENT;
            $formByMobile->role = StatCode::USER_ROLE_PATIENT;
            $this->render("login", array(
                'modelByMobile' => $formByMobile,
                'modelByPassword' => $formByPassword,
                'returnUrl' => $returnUrl
            ));
        }
       
    }
}
