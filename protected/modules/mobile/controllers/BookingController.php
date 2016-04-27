<?php

class BookingController extends MobileController {

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('createCorp', 'ajaxCreateCorp', 'ajaxUploadCorp', 'ajaxUploadFile', 'captcha', 'ajaxCaptchaCode', 'ajaxCorpCaptchaCode', 'quickbook', 'ajaxQuickbook', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view', 'ajaxCreate', 'patientBookingList', 'patientBooking', 'bookingDetails', 'testView'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    public function filterUserContext($filterChain) {
        $user = $this->loadUser();
        if (is_null($user)) {
            $redirectUrl = $this->createUrl('user/login');
            $currentUrl = $this->getCurrentRequestUrl();
            $redirectUrl.='?returnUrl=' . $currentUrl;
            $this->redirect($redirectUrl);
        }
        $filterChain->run();
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'userContext + create',
        );
    }

    public function actionView() {
        $this->render("view");
    }

    /**
     * if neither $did nor $tid is given, do 快速预约
     * @param integer $did  Doctor.id
     * @param integer $tid  Expertteam.id 
     */
    public function actionCreate() {
        $values = $_GET;
        //$request = Yii::app()->request;
        if (isset($values['tid'])) {
            // 预约专家团队
            $form = new BookExpertTeamForm();
            $form->initModel();
            $form->setExpertTeamId($values['tid']);
            $form->setExpertTeamData();
            $userId = $this->getCurrentUserId();
            if (isset($userId)) {
                $form->setUserId($userId);
            }
            //@TEST:
            //     $data = $this->testDataDoctorBook();
            //   $form->setAttributes($data, true);
            if ($this->isUserAgentWeixin()) {
                $form->user_agent = StatCode::USER_AGENT_WEIXIN;
            } else {
                $form->user_agent = StatCode::USER_AGENT_MOBILEWEB;
            }
            if ($this->isUserAgentIOS()) {
                $this->render('bookExpertteam', array('model' => $form));
            } else {
                $this->render('bookExpertteamAndroid', array('model' => $form));
            }
        } elseif (isset($values['did'])) {
            // 预约医生
            $form = new BookDoctorForm();
            $doctor = Doctor::model()->getById($values['doctor_id']);
            if (isset($doctor) && $doctor->is_free_clinic == 1) {
                $form->is_free_clinic = 1;
                $form->bk_status = StatCode::BK_STATUS_PROCESSING;
            }
            $form->initModel();
            $form->setDoctorId($values['did']);
            $form->setDoctorData();
            $userId = $this->getCurrentUserId();
            if (isset($userId)) {
                $form->setUserId($userId);
            }
            //@TEST:
            //234号
            //    $data = $this->testDataDoctorBook();
            //    $form->setAttributes($data, true);
            if ($this->isUserAgentWeixin()) {
                $form->user_agent = StatCode::USER_AGENT_WEIXIN;
            } else {
                $form->user_agent = StatCode::USER_AGENT_MOBILEWEB;
            }
            if ($this->isUserAgentIOS()) {
                $this->render('bookDoctor', array('model' => $form));
            } else {
                $this->render('bookDoctorAndroid', array('model' => $form));
            }
        } elseif (isset($values['hp_dept_id'])) {
            // 预约科室
            $form = new BookDeptForm();
            $form->initModel();
            $form->setHpDeptId($values['hp_dept_id']);
            $form->setHpDeptlData();
            $userId = $this->getCurrentUserId();
            if (isset($userId)) {
                $form->setUserId($userId);
            }
            //@TEST:
            //    $data = $this->testDataDoctorBook();
            //    $form->setAttributes($data, true);
            if ($this->isUserAgentWeixin()) {
                $form->user_agent = StatCode::USER_AGENT_WEIXIN;
            } else {
                $form->user_agent = StatCode::USER_AGENT_MOBILEWEB;
            }
            if ($this->isUserAgentIOS()) {
                $this->render('bookDept', array('model' => $form));
            } else {
                $this->render('bookDeptAndroid', array('model' => $form));
            }
        }
    }

    /**
     * 预约专家和科室预约
     * @throws CException
     */
    public function actionAjaxCreate() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            $values = $_POST['booking'];
            if (isset($values['expteam_id'])) {
                // 预约专家团队
                $form = new BookExpertTeamForm();
                $form->setAttributes($values, true);
                $form->setExpertTeamData();
                $form->initModel();
                $form->validate();
            } elseif (isset($values['doctor_id'])) {
                // 预约医生
                $form = new BookDoctorForm();
                $doctor = Doctor::model()->getById($values['doctor_id']);
                if (isset($doctor) && $doctor->is_free_clinic == 1) {
                    $form->is_free_clinic = 1;
                    $form->bk_status = StatCode::BK_STATUS_PROCESSING;
                }
                $form->setAttributes($values, true);
                $form->setDoctorData();
                $form->initModel();
                $form->validate();
            } elseif (isset($values['hp_dept_id'])) {
                // 预约医生
                $form = new BookDeptForm();
                $form->setAttributes($values, true);
                $form->setHpDeptlData();
                $form->initModel();
                $form->validate();
            }

            //验证码校验
//            $authMgr = new AuthManager();
//            $authSmsVerify = $authMgr->verifyCodeForBooking($form->mobile, $form->verify_code, null);
//            if ($authSmsVerify->isValid() === false) {
//                $form->addError('verify_code', $authSmsVerify->getError('code'));
//            }
            try {
                if ($form->hasErrors() === false) {
                    $booking = new Booking();
                    // 处理booking.user_id
                    $userId = $this->getCurrentUserId();
                    $bookingUser = null;
                    if (isset($userId)) {
                        $bookingUser = $userId;
                        $user = $this->getCurrentUser();
                        $form->mobile = $user->mobile;
                    } else {
                        $mobile = $form->mobile;
                        $user = User::model()->getByUsernameAndRole($mobile, StatCode::USER_ROLE_PATIENT);
                        if (isset($user)) {
                            $bookingUser = $user->getId();
                        } else {
                            // create new user.
                            $userMgr = new UserManager();
                            $user = $userMgr->createUserPatient($mobile);
                            if (isset($user)) {
                                $bookingUser = $user->getId();
                            }
                        }
                    }
                    $booking->setAttributes($form->attributes, true);
                    if ($this->isUserAgentWeixin()) {
                        $booking->user_agent = StatCode::USER_AGENT_WEIXIN;
                    } else {
                        $booking->user_agent = StatCode::USER_AGENT_MOBILEWEB;
                    }
                    $booking->user_id = $bookingUser;
                    if ($booking->save() === false) {
                        $output['errors'] = $booking->getErrors();
                        throw new CException('error saving data.');
                    }
                    $apiRequest = new ApiRequestUrl();
                    $remote_url = $apiRequest->getUrlAdminSalesBookingCreate() . '?type=' . StatCode::TRANS_TYPE_BK . '&id=' . $booking->id;
                    $data = $this->send_get($remote_url);
                    if ($data['status'] == "ok") {
                        $output['status'] = 'ok';
                        $output['salesOrderRefNo'] = $data['salesOrderRefNo'];
                        $output['booking']['id'] = $booking->getId();
                    } else {
                        //$output['errors'] = $salesOrder->getErrors();
                        throw new CException('error saving data.');
                    }
                } else {
                    $output['errors'] = $form->getErrors();
                    throw new CException('error saving data.');
                }
            } catch (CException $cex) {
                $output['status'] = 'no';
            }
        } else {
            $output['error'] = 'missing parameters';
        }
        //$this->renderJsonOutput($output);
        if (isset($_POST['plugin'])) {
            echo CJSON::encode($output);
            Yii::app()->end(200, true); //结束 返回200
        } else {
            $this->renderJsonOutput($output);
        }
    }

    public function actionAjaxCaptchaCode() {
        $model = new BookQuickForm;
        $values = $_POST['booking'];
        $model->setAttributes($values, true);
        echo (CActiveForm::validate($model));
        Yii::app()->end();
    }

    /**
     * 快速预约
     */
    public function actionQuickbook() {
        //$values = $_GET;
        //$request = Yii::app()->request;
        // 快速预约
        $form = new BookQuickForm();
        //  var_dump($form);exit();
        $form->initModel();
        $userId = $this->getCurrentUserId();
        if (isset($userId)) {
            $form->setUserId($userId);
        }
        if ($this->isUserAgentWeixin()) {
            $form->user_agent = StatCode::USER_AGENT_WEIXIN;
        } else {
            $form->user_agent = StatCode::USER_AGENT_MOBILEWEB;
        }
        //@TEST:
        //    $data = $this->testDataQuickBook();
        //    $form->setAttributes($data, true);
        //操作系统判断 返回不同的页面
        if ($this->isUserAgentIOS()) {
            $this->render('quickbook', array('model' => $form));
        } else {
            $this->render('createAjaxFileUpload', array('model' => $form));
        }
    }

    public function actionAjaxQuickbook() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            $values = $_POST['booking'];
            // 处理booking.user_id
            $user = $this->getCurrentUser();
            $form = new BookQuickForm();
            $form->setAttributes($values, true);
            $form->initModel();
            if (isset($user)) {
                // 快速预约
                $form->mobile = $user->username;
                $form->validate();
            } else {
                $form->validate();
                //验证码校验
                $authMgr = new AuthManager();
                $authSmsVerify = $authMgr->verifyCodeForBooking($form->mobile, $form->verify_code, null);
                if ($authSmsVerify->isValid() === false) {
                    $form->addError('verify_code', $authSmsVerify->getError('code'));
                }
            }
            try {
                if ($form->hasErrors() === false) {
                    $booking = new Booking();
                    $bookingUser = null;
                    if (isset($user)) {
                        $bookingUser = $user->getId();
                    } else {
                        //数据验证成功 自动注册账号并登陆
                        $this->RegisterUser($form);
                        $bookingUser = $this->getCurrentUserId();
                    }
                    $booking->setAttributes($form->attributes, true);
                    if ($this->isUserAgentWeixin()) {
                        $booking->user_agent = StatCode::USER_AGENT_WEIXIN;
                    } else {
                        $booking->user_agent = StatCode::USER_AGENT_MOBILEWEB;
                    }
                    $booking->user_id = $bookingUser;
                    if ($booking->save() === false) {
                        $output['errors'] = $booking->getErrors();
                        throw new CException('error saving data.');
                    }

                    $apiRequest = new ApiRequestUrl();
                    $remote_url = $apiRequest->getUrlAdminSalesBookingCreate() . '?type=' . StatCode::TRANS_TYPE_BK . '&id=' . $booking->id;
                    $data = $this->send_get($remote_url);
                    if ($data['status'] == "ok") {
                        $output['status'] = 'ok';
                        $output['salesOrderRefNo'] = $data['salesOrderRefNo'];
                        $output['booking']['id'] = $booking->getId();
                    } else {
                        //$output['errors'] = $salesOrder->getErrors();
                        throw new CException('error saving data.');
                    }
                } else {
                    $output['errors'] = $form->getErrors();
                    throw new CException('error saving data.');
                }
            } catch (CException $cex) {
                $output['status'] = 'no';
            }
        } else {
            $output['error'] = 'missing parameters';
        }
        //$this->renderJsonOutput($output);
        if (isset($_POST['plugin'])) {
            echo CJSON::encode($output);
            Yii::app()->end(200, true); //结束 返回200
        } else {
            $this->renderJsonOutput($output);
        }
    }

    private function RegisterUser(BookQuickForm $form) {
        $userForm = new UserDoctorMobileLoginForm();
        $userForm->is_verify = false;
        $userForm->username = $form->mobile;
        $userForm->verify_code = '123456';
        $userForm->role = StatCode::USER_ROLE_PATIENT;
        $userForm->autoRegister = true;
        $userMgr = new UserManager();
        $isSuccess = $userMgr->mobileLogin($userForm);
        return $isSuccess;
    }

    public function actionAjaxUploadFile() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            $values = $_POST['booking'];
            $bookingMgr = new BookingManager();
            if (isset($values['id']) === false) {
                // ['patient']['mrid'] is missing.
                $output['status'] = 'no';
                $output['error'] = 'invalid parameters';
                $this->renderJsonOutput($output);
            }
            $bookingId = $values['id'];
            //    $userId = $this->getCurrentUserId();
            $booking = $bookingMgr->loadBookingMobileById($bookingId);
            //$patientMR = $patientMgr->loadPatientMRById($mrid);
            if (isset($booking) === false) {
                // PatientInfo record is not found in db.
                $output['status'] = 'no';
                $output['errors'] = 'invalid id';
                $this->renderJsonOutput($output);
            } else {
                $output['bookingId'] = $booking->getId();
                $ret = $bookingMgr->createBookingFile($booking);
                if (isset($ret['error'])) {
                    $output['status'] = 'no';
                    $output['error'] = $ret['error'];
                    $output['file'] = '';
                } else {
                    // create file output.
                    $fileModel = $ret['filemodel'];
                    $data = new stdClass();
                    $data->id = $fileModel->getId();
                    $data->bookingId = $fileModel->getBookingId();
                    $data->fileUrl = $fileModel->getAbsFileUrl();
                    $data->tnUrl = $fileModel->getAbsThumbnailUrl();
                    //    $data->deleteUrl = $this->createUrl('patient/deleteMRFile', array('id' => $fileModel->getId()));
                    $output['status'] = 'ok';
                    $output['file'] = $data;
                    //$output['redirectUrl'] = $this->createUrl("home/index");
                }
            }
        } else {
            $output['error'] = 'missing parameters';
        }
        if (isset($_POST['plugin'])) {
            echo CJSON::encode($output);
            Yii::app()->end(200, true); //结束 返回200
        } else {
            $this->renderJsonOutput($output);
        }
    }

    public function actionAjaxCorpCaptchaCode() {
        $model = new BookCorpForm();
        $values = $_POST['booking'];
        $model->setAttributes($values, true);
        echo (CActiveForm::validate($model));
        Yii::app()->end();
    }

    //进入公司快速预约页面
    public function actionCreateCorp() {
        $form = new BookCorpForm();
        $returnUrl = 'createCorp';
        if (!$this->isUserAgentIOS()) {
            $returnUrl = $returnUrl . 'Android';
        }
        $this->render($returnUrl, array(
            'model' => $form
        ));
    }

    //ajax 公司快速预约数据保存
    public function actionAjaxCreateCorp() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            //给form赋值
            $values = $_POST['booking'];
            $form = new BookCorpForm();
            $form->setAttributes($values, true);
            $form->initModel();
            //数据校验之后再检测验证码
            $form->validate();
            //验证码校验
            $authMgr = new AuthManager();
            $authSmsVerify = $authMgr->verifyCodeForBooking($form->mobile, $form->verify_code, null);
            if ($authSmsVerify->isValid() === false) {
                $form->addError('verify_code', $authSmsVerify->getError('code'));
            }
            //form数据校验
            if ($form->hasErrors() === false) {
                $booking = new Booking();
                $booking->setAttributes($form->attributes, true);
                $booking->setIsCorporate();
                if ($booking->save()) {
                    $output['status'] = 'ok';
                    $output['booking']['id'] = $booking->getId();
                } else {
                    $output['errors'] = $booking->getErrors();
                }
            } else {
                $output['errors'] = $form->getErrors();
            }
        }
        $this->renderJsonOutput($output);
    }

    //上传企业员工证明
    public function actionAjaxUploadCorp() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            $values = $_POST['booking'];
            if (isset($values['id']) === false) {
                // ['patient']['mrid'] is missing.
                $output['status'] = 'no';
                $output['error'] = 'invalid parameters';
                $this->renderJsonOutput($output);
            }
            $bookingMgr = new BookingManager();
            $bookingId = $values['id'];
            $booking = $bookingMgr->loadBookingMobileById($bookingId);
            if (isset($booking) === false) {
                // PatientInfo record is not found in db.
                $output['status'] = 'no';
                $output['errors'] = 'invalid id';
                $this->renderJsonOutput($output);
            } else {
                $output['bookingId'] = $booking->getId();
                $ret = $bookingMgr->cerateBookingCorp($booking);
                if (isset($ret['error'])) {
                    $output['status'] = 'no';
                    $output['error'] = $ret['error'];
                    $output['file'] = '';
                } else {
                    // create file output.
                    $fileModel = $ret['filemodel'];
                    $data = new stdClass();
                    $data->id = $fileModel->getId();
                    $data->bookingId = $fileModel->getBookingId();
                    $data->fileUrl = $fileModel->getAbsFileUrl();
                    $data->tnUrl = $fileModel->getAbsThumbnailUrl();
                    //    $data->deleteUrl = $this->createUrl('patient/deleteMRFile', array('id' => $fileModel->getId()));
                    $output['status'] = 'ok';
                    $output['file'] = $data;
                    //$output['redirectUrl'] = $this->createUrl("home/index");
                }
            }
        } else {
            $output['error'] = 'missing parameters';
        }
        if (isset($_POST['plugin'])) {
            echo CJSON::encode($output);
            Yii::app()->end(200, true); //结束 返回200
        } else {
            $this->renderJsonOutput($output);
        }
    }

    //病人预约列表查询
    public function actionPatientBookingList() {
        $value = $_GET;
        if ($value)
            $bk_status = $value['status'];
        else
            $bk_status = 0;
        $user = $this->getCurrentUser();
        $booking = new ApiViewBookingListV4($user, $bk_status);
        $output = $booking->loadApiViewData();
        //print_r($output);exit;
        $this->render('patientBookingList', array(
            'data' => $output
        ));
    }

    //病人续约详细信息查询
    public function actionPatientBooking($id) {
        $user = $this->getCurrentUser();
        $booking = new ApiViewBookingV4($user, $id);
        $output = $booking->loadApiViewData();
        if ($this->isUserAgentIOS()) {
            $this->render('patientBooking', array(
                'data' => $output
            ));
        } else {
            $this->render('patientBookingAndroid', array(
                'data' => $output
            ));
        }
    }

    protected function sendBookingEmailNew($booking) {
        $data = new stdClass();
        $data->id = $booking->getId();
        $data->refNo = $booking->getRefNo();
        if ($booking->bk_type == StatCode::BK_TYPE_EXPERTTEAM) {
            $data->expertBooked = $booking->getExpertteamName();
        } elseif ($booking->bk_type == StatCode::BK_TYPE_DOCTOR) {
            $data->expertBooked = $booking->getDoctorName();
        } else {
            $data->expertBooked = $booking->getDoctorName();
        }
        $data->hospitalName = $booking->getHospitalName();
        $data->hpDeptName = $booking->getHpDeptName();
        $data->patientName = $booking->getContactName();
        $data->mobile = $booking->getMobile();
        $data->diseaseName = $booking->getDiseaseName();
        $data->diseaseDetail = $booking->getDiseaseDetail();
        $data->dateCreated = $booking->getDateCreated();
        $data->submitFrom = '';
        $emailMgr = new EmailManager();
        return $emailMgr->sendEmailBookingNew($data);
    }

    private function testDataQuickBook() {
        return array(
            'hospital_name' => '肿瘤医院',
            'hp_dept_name' => '肿瘤科',
            'doctor_name' => '李医生',
            'contact_name' => '王小明',
            'mobile' => '18217531537',
            'verify_code' => '123456',
            'disease_name' => '小腿骨折',
            'disease_detail' => '小腿都碎了啊！咋办啊'
        );
    }

    private function testDataDoctorBook() {
        return array(
//    'hospital_name' => '肿瘤医院',
//    'hp_dept_name' => '肿瘤科',
//    'doctor_name' => '李医生',
            'contact_name' => '王小明',
            'mobile' => '18217531537',
            'verify_code' => '123456',
            'disease_name' => '小腿骨折',
            'disease_detail' => '小腿都碎了啊！咋办啊'
        );
    }

    private function testDataExpertTeamBook() {
        return array(
//    'hospital_name' => '肿瘤医院',
//    'hp_dept_name' => '肿瘤科',
//    'doctor_name' => '李医生',
            'contact_name' => '王小明',
            'mobile' => '18217531537',
            'verify_code' => '123456',
            'disease_name' => '小腿骨折',
            'disease_detail' => '小腿都碎了啊！咋办啊'
        );
    }

    public function actionBookingDetails($id) {
        $value = $_GET;
        $user = $this->getCurrentUser();
        $booking = new ApiViewBookingV4($user, $id);
        $output = $booking->loadApiViewData();
        $salesOrder = new SalesOrder();
        $orderInfo = $salesOrder->getByBkRefNo($output->results->refNo);
        $output->results->orderInfo = $orderInfo;
        $model = '';
        if ($value['status'] == 1) {//待支付1000
            $view = 'payDeposit';
        } elseif ($value['status'] == 2) {//安排中
            $view = 'arrange';
        } elseif ($value['status'] == 3) {//待确认20000
            $view = 'payConfirm';
        } elseif ($value['status'] == 4) {//待点评
            $view = 'review';
            $model = new CommentForm();
        } elseif ($value['status'] == 8) {//已完成
            $comment = new Comment();
            $bookingComment = $comment->getBookingIds($output->results->id);
            $output->results->bookingComment = $bookingComment;
            $view = 'complete';
        } else {
            $view = 'cancel';
        }
        $this->render($view, array(
            'data' => $output,
            'model' => $model
        ));
    }

    public function actionTestView() {
        $this->render("review");
    }

}
