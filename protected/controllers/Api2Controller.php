<?php

class Api2Controller extends Controller {
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    private $timestamp;
    private $app_id;
    private $sign;
    private $vendor_id;
    private $isGet;
    private $post;

    public function filterRequest($filterChain){
        if(Yii::app()->request->getRequestType() == 'GET'){
            if(!isset($_GET['timestamp']) || !isset($_GET['app_id']) || !isset($_GET['sign'])){
                $this->renderJsonOutput(array('status'=>EApiViewService::RESPONSE_NO, 'errorCode'=>1, 'errorMsg'=>'parameter error'));
            }else{
                $this->timestamp = $_GET['timestamp'];
                $this->app_id = $_GET['app_id'];
                $this->sign = $_GET['sign'];
                $this->isGet = 1;
            }
        }else{
            

            if(!isset($_GET['timestamp']) || !isset($_GET['app_id']) || !isset($post['sign'])){
                $this->renderJsonOutput(array('status'=>EApiViewService::RESPONSE_NO, 'errorCode'=>1, 'errorMsg'=>'parameter error'));
            }else{
                $this->timestamp = $_GET['timestamp'];
                $this->app_id = $_GET['app_id'];
                $this->sign = $post['sign'];
                $this->post = $post;
            }
        }
        $filterChain->run();
    }

    public function filterSign($filterChain){
        $now = time();
        $oneDay = 3600*24;
        //在现在的一天之内
        if($this->timestamp <= ($now+$oneDay) && $this->timestamp >= ($now-$oneDay)){
            $requestUrl = $this->getCurrentRequestUrl();
            $appKey = AppVendor::model()->getByAppId($this->app_id);
            if(isset($appKey)){
                $this->vendor_id = $appKey->id;
                if($this->isGet){
                    $requestUrl = substr($requestUrl, 0, strpos($requestUrl, '&sign'));
                }
                $signCheckValue = md5($requestUrl.$appKey->app_secret);
                if($signCheckValue != $this->sign){
                    $this->renderJsonOutput(array('status'=>EApiViewService::RESPONSE_NO, 'errorCode'=>4, 'errorMsg'=>'sign error'));
                }
            }else{
                $this->renderJsonOutput(array('status'=>EApiViewService::RESPONSE_NO, 'errorCode'=>3, 'errorMsg'=>'illegal request'));
            }
        }else{
            $this->renderJsonOutput(array('status'=>EApiViewService::RESPONSE_NO, 'errorCode'=>2, 'errorMsg'=>'the request has expired'));
        }
        $filterChain->run();
    }

    /**
     * @return array action filters
     */
    public function filters() {
       return array();
//         return array('request', 'sign');
    }

    public function init() {
        //header('Access-Control-Allow-Origin:http://m.mingyizhudao.com'); 
        header('Access-Control-Allow-Origin:http://mingyizhudao.com');    // Cross-domain access.
        header('Access-Control-Allow-Credentials:true');      // 允许携带 用户认证凭据（也就是允许客户端发送的请求携带Cookie）
        return parent::init();
    }

    // Actions
    public function actionList($model) {
        $api = $this->getApiVersionFromRequest();
        // Get the respective model instance
        switch ($model) {
            case 'dataversion'://数据版本号
                if ($api >= 9) {
                    $output = array(
                        'status' => EApiViewService::RESPONSE_OK,
                        'errorCode' => ErrorList::ERROR_NONE,
                        'errorMsg' => 'success',
                        'results'=>array(
                            'version' => '20160519',
                            'localdataUrl' => Yii::app()->createAbsoluteUrl('/api2/localdata'),
                        )
                    );
                }else{
                    $output = array(
                        'status' => EApiViewService::RESPONSE_OK,
                        'errorCode' => ErrorList::ERROR_NONE,
                        'errorMsg' => 'success',
                        'results'=>array(
                            'version' => '20160219',
                            'localdataUrl' => Yii::app()->createAbsoluteUrl('/api2/localdata'),
                        )
                    );
                }
                break;
            case 'localdata'://本地需要缓存的数据
                if ($api >= 9) {
                    $apiService = new ApiViewPatientLocalDataV9();
                }elseif ($api >= 7) {
                    $apiService = new ApiViewPatientLocalDataV7();
                }else{
                    $apiService = new ApiViewPatientLocalData();
                }

                $output = $apiService->loadApiViewData();
                break;
            case 'faculty':
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadFacultyList();
                break;
            case 'overseas':
                $overseasMgr = new OverseasManager();
                $output = $overseasMgr->loadHospitalsJson();
                break;
            case 'appversion':
                $get = $_GET;
                $appMgr = new AppManager();
                $output = $appMgr->loadAppVersionJson($get);
                break;
            // app v2.0 api
            case "appnav1"://首屏接口
                if ($api >= 9) {
                    $apiService = new ApiViewAppNav1V9();
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 8) {
                    $apiService = new ApiViewAppNav1V8();
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 7) {
                    $apiService = new ApiViewAppNav1V7();
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 6) {
                    $apiService = new ApiViewAppNav1V6();
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 5) {
                    $apiService = new ApiViewAppNav1V5();
                    $output = $apiService->loadApiViewData();
                } elseif ($api == 4) {
                    $apiService = new ApiViewAppNav1V4();
                    $output = $apiService->loadApiViewData();
                } elseif ($api == 3) {
                    $apiService = new ApiViewAppNav1V3();
                    $output = $apiService->loadApiViewData();
                } elseif ($api == 2) {
                    $apiService = new ApiViewAppNav1V2();
                    $output = $apiService->loadApiViewData();
                } else {
                    $appMgr = new AppManager();
                    $output = $appMgr->loadNav1Json();
                }
                break;
            case "appnav2":
                if ($api >= 7) {
                    $values = $_GET;
                    $apiService = new ApiViewExpertTeamSearchV7($values);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 5) {
                    $values = $_GET;
                    $apiService = new ApiViewExpertTeamSearchV5($values);
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 4) {
                    $values = $_GET;
                    $apiService = new ApiViewExpertTeamSearch($values);
                    $output = $apiService->loadApiViewData();
                } else {
                    $appMgr = new AppManager();
                    $output = $appMgr->loadNav2Json();
                }
                break;
            case "appnav3": //合作医院
                $values = $_GET;
                if ($api >= 7) {
                    $apiService = new ApiViewAppNav3V7($values);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 4) {
                    $apiService = new ApiViewAppNav3V4($values);
                    $output = $apiService->loadApiViewData();
                } else {
                    $apiService = new ApiViewAppNav3($values);
                    $output = $apiService->loadApiViewData();
                }
                break;
            case "appnav4":
                break;
            case "faculty2":    // can be deleted, use appnav1 instead.
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadFacultyList2();
                break;

            case"hospital":
                $values = $_GET;
                if($api >=9){
                    $apiService = new ApiViewHospitalSearchV9($values);
                    $output = $apiService->loadApiViewData();
                }
                else if($api >= 7){
                    $apiService = new ApiViewHospitalSearchV7($values);
                    $output = $apiService->loadApiViewData();
                } else {
                    $apiService = new ApiViewHospitalSearch($values);
                    $output = $apiService->loadApiViewData();
                }
                /*
                  $diseaseId = Yii::app()->request->getQuery('disease', null);
                  if (isset($diseaseId)) {
                  $apiService = new ApiViewHospitalByDisease($diseaseId);
                  $output = $apiService->loadApiViewData();
                  } else {
                  $apiService = new ApiViewHospitalSearch($values);
                  $output = $apiService->loadApiViewData();
                  }
                 * 
                 */
                break;

            case "listhospital":
                $values = $_GET;
                $hospitalMgr = new HospitalManager();
                $query['city'] = isset($values['city']) ? $values['city'] : null;
                $output['hospitals'] = $hospitalMgr->loadListHospital($query, array('order' => 't.name'));
                break;

            case 'doctor':
                $values = $_GET;
                if($api >= 8){
                    $apiService = new ApiViewDoctorSearchV8($values);
                    $output = $apiService->loadApiViewData();
                }elseif($api == 7){
                    $apiService = new ApiViewDoctorSearchV7($values);
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 5 || $api == 6) {
                    $apiService = new ApiViewDoctorSearchV5($values);
                    $output = $apiService->loadApiViewData();
                }elseif ($api == 4) {
                    $apiService = new ApiViewDoctorSearchV4($values);
                    $output = $apiService->loadApiViewData();
                } else {
                    $apiService = new ApiViewDoctorSearch($values);
                    $output = $apiService->loadApiViewData();
                }

                //$query['hpdept'] = Yii::app()->request->getQuery('hpdept', null);                
                //$apiService = new ApiViewDoctorByHpDept($query['hpdept']);

                //isset($values['hpdept']) ? $values['hpdept'] : null;
                /*  $doctorMgr = new DoctorManager();
                  $options = null;
                  $with = null;
                  $output['doctors'] = $doctorMgr->loadAllIDoctors($query, $with, $options);
                 * 
                 */
                break;

            case"userbooking":
                $values = $_GET;
                if ($api >= 12){
                    $user = $this->userLoginRequired($values,true);
                    $bk_status = isset($_GET['bk_status'])?$_GET['bk_status']:'';
                    $apiService = new ApiViewBookingListV12($user,$bk_status);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 10){
					$user = $this->userLoginRequired($values,true);
                    $bk_status = isset($_GET['bk_status'])?$_GET['bk_status']:'';
                    $apiService = new ApiViewBookingListV9($user,$bk_status);
                    $output = $apiService->loadApiViewData(true);
				}elseif ($api >= 9){
                    $user = $this->userLoginRequired($values);
                    
                    $bk_status = isset($_GET['bk_status'])?$_GET['bk_status']:'';
                    $apiService = new ApiViewBookingListV9($user,$bk_status);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 7) {
                    $user = $this->userLoginRequired($values);
                    $apiService = new ApiViewBookingListV7($user);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 4) {
                    $user = $this->userLoginRequired($values);
                    $apiService = new ApiViewBookingListV4($user);
                    $output = $apiService->loadApiViewData();
                } else {
                    $user = $this->userLoginRequired($values);
                    $bookingMgr = new BookingManager();
                    //$output = $bookingMgr->apiLoadAllIBookingsJsonByUser($user);
                    $ibookings = $bookingMgr->loadAllIBookingsByUser($user);
                    $output['bookings'] = $ibookings;
                    $output['countBookings'] = count($ibookings);
                }
                    
                break;

            case 'expertteam':
                // ?$city=1&$offset=1&$limit=1&$order=name
                $values = $_GET;
                $query['city'] = isset($values['city']) ? $values['city'] : null;
                $options = $this->parseQueryOptions($values);
                $with = array('expteamLeader');
                $expteamMgr = new ExpertTeamManager();
                $output['expertTeams'] = $expteamMgr->loadAllIExpertTeams($query, $with, $options);
                break;

            case 'disease':
                $diseaseMgr = new DiseaseManager();
                $output = $diseaseMgr->loadListDisease();
                break;
            case 'city':
                $values = $_GET;
                $city = new ApiViewAppCity($values);
                $output = $city->loadApiViewData();
                break;
            case 'diseasename'://根据疾病名称获取疾病信息
                $values = $_GET;
                $apiService = new ApiViewDiseaseName($values);
                $output = $apiService->loadApiViewData();
                break;
            case 'search':
                $values = $_GET;
                $values['name'] = urldecode($values['name']);
                $apiService = new ApiViewSearch($values);
                $output = $apiService->loadApiViewData();
                break;
            case 'bookingstatus':
                $apiService = new ApiViewBookingStatus();
                $output = $apiService->loadApiViewData();
                break;
            case 'unreadcount':
                $values = $_GET;
                $user = $this->userLoginRequired($values,true);
                $apiService = new ApiViewUnreadCount($user);
                $output = $apiService->loadApiViewData();
                break;
            default:
                // Model not implemented error
                //$this->_sendResponse(501, sprintf('Error: Mode <b>list</b> is not implemented for model <b>%s</b>', $model));
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        // Did we get some results?
        if (empty($output)) {
            // No
            //$this->_sendResponse(200, sprintf('No items where found for model <b>%s</b>', $model));
            $this->_sendResponse(200, sprintf('No result', $model));
        } else {
            $this->renderJsonOutput($output);
            //  header('Content-Type: text/html; charset=utf-8');
            // var_dump($output);
        }
    }

    public function actionView($model, $id) {
        // Check if id was submitted via GET
        if (isset($id) === false) {
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing');
        }
        $output = null;
        $api = $this->getApiVersionFromRequest();
        switch ($model) {
            // Find respective model    
            case 'faculty':  //TODO: this api is used in v1. will not be supported after v2.0.
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadIFacultyJson($id);
                break;
            case 'hospital':
                //  $hospitalMgr = new HospitalManager();
                //  $with = array('hospitalCity', 'hospitalDepartments' => array('on' => 'hospitalDepartments.is_show=1'));
                //  $output['hospital'] = $hospitalMgr->loadIHospitalById($id, $with);
                // $id Hospital.id
                if ($api >= 11) {
                    $apiService = new ApiViewHospitalV11($id);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 7) {
                    $apiService = new ApiViewHospitalV7($id);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 4) {
                    $apiService = new ApiViewHospitalV4($id);
                    $output = $apiService->loadApiViewData();
                } else {
                    $apiService = new ApiViewHospital($id);
                    $output = $apiService->loadApiViewData();
                }

                break;
            case 'doctor':
                if ($api >= 12) {
                    $apiService = new ApiViewDoctorV12($id);
                    $output = $apiService->loadApiViewData();
                }elseif ($api >= 8) {
                    $apiService = new ApiViewDoctorV8($id);
                    $output = $apiService->loadApiViewData();
                }else{
                    $doctorMgr = new DoctorManager();
                    $output = $doctorMgr->loadIDoctorJson($id);
                }
                break;

            // app v2.0 api.            
            case 'faculty2':
                $facultyMgr = new FacultyManager();
                //$output = $facultyMgr->loadIFacultyJson2($id);
                $ifaculty = $facultyMgr->loadIFaculty2($id);
                $faculty = new stdClass();
                $faculty->id = $ifaculty->id;
                $faculty->code = $ifaculty->code;
                $faculty->name = $ifaculty->name;
                $faculty->desc = $ifaculty->desc;
                $output['faculty'] = $faculty;
                $output['diseases'] = $ifaculty->diseases;
                $output['expertTeams'] = $ifaculty->expertTeams;
                $output['doctors'] = $ifaculty->doctors;
                break;
            case 'expertteam':
                if($api >= 7){
                    $apiService = new ApiViewExpertTeamV7($id);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 5){
                    $apiService = new ApiViewExpertTeamV5($id);
                    $output = $apiService->loadApiViewData();
                }elseif($api == 4){
                    $apiService = new ApiViewExpertTeamV4($id);
                    $output = $apiService->loadApiViewData();
                }else{
                    $apiService = new ApiViewExpertTeam($id);
                    $output = $apiService->loadApiViewData();
                }
                break;
            case 'userbooking':
                $values = $_GET;
                if($api >= 12 ){
                    $user = $this->userLoginRequired($values,true);
                    $apiService = new ApiViewBookingV12($user, $id);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 10 ){
					$user = $this->userLoginRequired($values,true);
                    $apiService = new ApiViewBookingV9($user, $id);
                    $output = $apiService->loadApiViewData(true);
				}elseif($api >= 9){
                    $user = $this->userLoginRequired($values);
                    $apiService = new ApiViewBookingV9($user, $id);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 7){
                    $user = $this->userLoginRequired($values);
                    $apiService = new ApiViewBookingV7($user, $id);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 4){
                    $user = $this->userLoginRequired($values);
                    $apiService = new ApiViewBookingV4($user, $id);
                    $output = $apiService->loadApiViewData();
                }else{
                    $user = $this->userLoginRequired($values);
                    $bookingMgr = new BookingManager();
                    $output = $bookingMgr->apiLoadIBookingJsonByUser($user, $id);  
                }
                
                break;
            case 'hospitaldept':
                // $id HospitalDepartment.id                
                //$queryOptions = $this->parseQueryOptions($_GET);
                $searchInputs = $_GET;
                if($api >= 11){
                    $apiService = new ApiViewHospitalDeptV11($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 9){
                    $apiService = new ApiViewHospitalDeptV9($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 8){
                    $apiService = new ApiViewHospitalDeptV8($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }elseif($api == 7){
                    $apiService = new ApiViewHospitalDeptV7($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }elseif($api >= 5){
                    $apiService = new ApiViewHospitalDeptV5($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }elseif($api == 4){
                    $apiService = new ApiViewHospitalDeptV4($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }else{
                    $apiService = new ApiViewHospitalDept($id, $searchInputs);
                    $output = $apiService->loadApiViewData();
                }

                break;
            case'disease':
                if($api >= 7){
                    $apiSvc = new ApiViewDiseaseV7($id);
                    $output = $apiSvc->loadApiViewData();
                }elseif($api >= 4){
                    $apiSvc = new ApiViewDiseaseV4($id);
                    $output = $apiSvc->loadApiViewData();
                }else{
                    $apiSvc = new ApiViewDisease($id);
                    $output = $apiSvc->loadApiViewData();
                }
                break;
            case'orderlist':
                $values = $_GET;
                $user = $this->userLoginRequired($values);
                $apiSvc = new ApiViewOrderList($user, $id);
                $output = $apiSvc->loadApiViewData();
                break;
            /*
              case 'diseaseinfo':
              $apiSvc = new ApiViewDiseaseInfo($id);
              $output = $apiSvc->loadApiViewData();
              break;
             * 
             */
            default:
                $this->_sendResponse(501, sprintf('Mode <b>view</b> is not implemented for model <b>%s</b>', $model));
                Yii::app()->end();
        }
        // Did we find the requested model? If not, raise an error
        if (is_null($output)) {
            $this->_sendResponse(404, 'No result');
        } else {
            //$this->_sendResponse(200, CJSON::encode($output));
            $this->renderJsonOutput($output);
        }
    }

    public function actionCreate($model) {
        $api = $this->getApiVersionFromRequest();
        $get = $_GET;
//        $post = $_POST;
        if($api >= 10){
            if (empty($_POST)) {
                // application/json
                $postData=urldecode($this->getPostData());
                $post=$this->decryptAppInput($postData);
            } else {
                // application/x-www-form-urlencoded
                $post = $this->decryptAppInput($_POST["name"]);
            }
        }else{
            if(empty($_POST)){
                // application/json
                $post = CJSON::decode($this->getPostData());
            }else{
                // application/x-www-form-urlencoded
                $post = $_POST;
            }
        }
        if ($api >= 4) {
            $output = array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => 'Invalid request.');
        }else{
            $output = array('status' => false, 'error' => 'Invalid request.');
        }
        switch ($get['model']) {
            // Get an instance of the respective model
            //@TODO: delete this.
            case 'mrfile':
                $mrMgr = new MedicalRecordManager();
                $output = $mrMgr->apiCreateMRFIle($post);
                break;
            /*             * ** api 2.0 *** */
            case 'smsverifycode':   // sends sms verify code AuthSmsVerify.
                if (isset($post['smsVerifyCode'])) {
                    $values = $post['smsVerifyCode'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $authMgr = new AuthManager();
                    if ($api >= 6) {
                        $output = $authMgr->apiSendVerifyCode($values);
                    }else{
                        $output = $authMgr->apiSendAuthSmsVerifyCode($values);
                    }
                } else {
                    $output['error'] = 'Wrong parameters.';
                }
                break;
            case 'userresetpassword':    // rsest user password.
                if (isset($post['userReset'])) {
                    $values = $post['userReset'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $userMgr = new UserManager();
                    $output = $userMgr->apiTokenUserReset($values);
                } else {
                    $output['errorMsg'] = 'Wrong parameters.';
                }

                break;
            case 'userregister':    // remote user register.
                if (isset($post['userRegister'])) {
                    $values = $post['userRegister'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $userMgr = new UserManager();
                    $values['autoLogin']= true;
                    $output = $userMgr->apiTokenUserRegister($values);
                } else {
                    $output['errorMsg'] = 'Wrong parameters.';
                }
 
                break;
            case 'userlogin':   // remote user login.
                if (isset($post['userLogin'])) {
                    // get user ip from request.
                    $values = $post['userLogin'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $authMgr = new AuthManager();
                    $output = $authMgr->apiTokenUserLoginByPassword($values);
                } else {
                    $output['errorMsg'] = 'Wrong parameters.';
                }
                break;
            case 'usermobilelogin'://手机号和验证码登录
                if (isset($post['userLogin'])) {
                    // get user ip from request.
                    $values = $post['userLogin'];

                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $authMgr = new AuthManager();
                    $output = $authMgr->apiTokenUserLoginByMobile($values);
                } else {
                    $output['error_msg'] = 'Wrong parameters.';
                }
                break;
            case 'booking':
                if ($api >= 9) {
                    if (isset($post['booking'])) {
                        $values = $post['booking'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $values['user_agent'] = ($this->isUserAgentIOS()) ? StatCode::USER_AGENT_APP_IOS : StatCode::USER_AGENT_APP_ANDROID;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        $bookingMgr = new BookingManager();
                        $checkVerifyCode = true;    // checks verify_code before creating a new booking in db.
                        $sendEmail = true;  // send email to admin after booking is created.
                        $output = $bookingMgr->apiCreateBookingV9($user, $values, $checkVerifyCode, $sendEmail);

                    } else {
                        $output['errorMsg'] = 'Wrong parameters.';
                    }
                }elseif ($api >= 7) {
                    if (isset($post['booking'])) {
                        $values = $post['booking'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $values['user_agent'] = ($this->isUserAgentIOS()) ? StatCode::USER_AGENT_APP_IOS : StatCode::USER_AGENT_APP_ANDROID;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        $bookingMgr = new BookingManager();
                        $checkVerifyCode = true;    // checks verify_code before creating a new booking in db.
                        $sendEmail = true;  // send email to admin after booking is created.
                        $output = $bookingMgr->apiCreateBookingV7($user, $values, $checkVerifyCode, $sendEmail);

                    } else {
                        $output['errorMsg'] = 'Wrong parameters.';
                    }
                }elseif ($api >= 4) {
                    if (isset($post['booking'])) {
                        $values = $post['booking'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $values['user_agent'] = ($this->isUserAgentIOS()) ? StatCode::USER_AGENT_APP_IOS : StatCode::USER_AGENT_APP_ANDROID;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        $bookingMgr = new BookingManager();
                        $checkVerifyCode = true;    // checks verify_code before creating a new booking in db.
                        $sendEmail = true;  // send email to admin after booking is created.
                        $output = $bookingMgr->apiCreateBookingV4($user, $values, $checkVerifyCode, $sendEmail);

                    } else {
                        $output['errorMsg'] = 'Wrong parameters.';
                    }
                } else {
                    if (isset($post['booking'])) {
                        $values = $post['booking'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        //  $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $bookingMgr = new BookingManager();
                        $checkVerifyCode = true;    // checks verify_code before creating a new booking in db.
                        $sendEmail = true;  // send email to admin after booking is created.
                        $output = $bookingMgr->apiCreateBooking($user, $values, $checkVerifyCode, $sendEmail);
                    } else {
                        $output['error'] = 'Wrong parameters.';
                    }
                }

                break;
            case 'quickbooking':// 快速预约
                if (isset($post['booking'])) {
                    $values = $post['booking'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $values['user_agent'] = ($this->isUserAgentIOS()) ? StatCode::USER_AGENT_APP_IOS : StatCode::USER_AGENT_APP_ANDROID;
                    if(!isset($values['verify_code'])){
                        $checkVerifyCode = false;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        if(is_object($user)){
                            $values['user_id'] = $user->getId();
                            $values['mobile'] = $user->getUserName();
                        }
                    }else{
                        $checkVerifyCode = true;
                    }
                    $bookingMgr = new BookingManager();
                    $output = $bookingMgr->apiCreateQuickBooking($values, $checkVerifyCode);
                } else {
                    $output['error'] = 'missing parameters';
                }

                break;

            case 'bookingfile':
                if ($api >= 4) {
                    if (isset($post['bookingFile'])) {
                        $values = $post['bookingFile'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        $file = EUploadedFile::getInstanceByName('bookingFile[file_data]');  // $_FILE['booking_file']. This supports uploading of ONE file only!
                        $bookingMgr = new BookingManager();
                        $output = $bookingMgr->apiCreateBookingFileV4($user, $values, $file);
                    } else {
                        $output['errorMsg'] = 'Wrong parameters';
                    }
                } else {
                    if (isset($post['bookingFile'])) {
                        $values = $post['bookingFile'];
                        $values['userHostIp'] = Yii::app()->request->userHostAddress;
                        $user = $this->userLoginRequired($values);  // check if user has login.
                        $file = EUploadedFile::getInstanceByName('bookingFile[file_data]');  // $_FILE['booking_file']. This supports uploading of ONE file only!
                        if (is_null($file)) {
                            $output['errors']['error_code'] = ErrorList::BAD_REQUEST;
                            $output['errors']['error_msg'] = '请上传图片';
                            break;
                        }
                        $bookingMgr = new BookingManager();
                        $output = $bookingMgr->apiCreateBookingFile($user, $values, $file);
                    } else {
                        $output['error'] = 'Wrong parameters';
                    }
                }
                break;
            case 'comment':
                if (isset($post['comment'])) {
                    $values = $post['comment'];

                    $user = $this->userLoginRequired($values);  // check if user has login.
                    $commentMgr = new CommentManager();
                    $output = $commentMgr->apiCreateComment($user, $values);
                } else {
                    $output['errorMsg'] = 'Wrong parameters';
                }
                break;
            default:
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        if($api >= 10){
            $output = $this->encryptOutput($output);
        }
        $this->renderJsonOutput($output);
    }

    public function actionUpdate($model, $id ,$type = NULL) {
        if (isset($id) === false) {
            $this->renderJsonOutput(array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => 'Error: Parameter <b>id</b> is missing'));
        }
		$api = $this->getApiVersionFromRequest();
        $get = $_GET;
        if($api >= 10){
            if (empty($_POST)) {
                // application/json
                $postData=urldecode($this->getPostData());
                $post=$this->decryptAppInput($postData);
            } else {
                // application/x-www-form-urlencoded
                $post = $this->decryptAppInput($_POST["name"]);
            }
        }else{
            if(empty($_POST)){
                // application/json
                $post = CJSON::decode($this->getPostData());
            }else{
                // application/x-www-form-urlencoded
                $post = $_POST;
            }
        }
        
        $output = array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => 'Invalid request.');

        switch ($model) {
            // Get an instance of the respective model
            case 'patient'://患者（患者基本信息）

                break;
            case 'booking':
                switch ($type){
                    case 'cancelBooking':
                        if($api >= 10){
                            $bookingMgr = new BookingManager();
                            $values = $post;
                            $user = $this->userLoginRequired($values['cancelBooking']);
                            $userId=$user->getId();
                            if(empty($userId) || empty($id)){
                                $output['status'] = 'no';
                                $output['errorCode'] = EApiViewService::RESPONSE_VALIDATION_ERRORS;
                                $output['message'] = 'Wrong parameters';
                            }else{
                                $output = $bookingMgr->actionCancelBooking($id,$userId);
                            }
                        }else{
                            $bookingMgr = new BookingManager();
                            $values = $get;
                            $user = $this->userLoginRequired($values);
                            $userId=$user->getId();
                            if(empty($userId) || empty($id)){
                                $output['status'] = 'no';
                                $output['errorCode'] = EApiViewService::RESPONSE_VALIDATION_ERRORS;
                                $output['message'] = 'Wrong parameters';
                            }else{
                                $output = $bookingMgr->actionCancelBooking($id,$userId);
                            }
                        }
                        break;
                    default:
                        $this->_sendResponse(501, sprintf('Error: Invalid request', $type));
                        Yii::app()->end();
                }
                break;
            case 'profile'://个人信息（基本信息）
                if (isset($post['profile'])) {
                    $values = $post['profile'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $user = $this->userLoginRequired($values);  // check if doctor has login.
                    $doctorMgr = new DoctorManager();
                    $output = $doctorMgr->apiCreateProfile($user, $values, $id);

                } else {
                    $output['errorMsg'] = 'Wrong parameters.';
                }

                break;

            default:
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        if($api >= 10){
            $output = $this->encryptOutput($output);
        }
        $this->renderJsonOutput($output);
    }

    public function actionDelete($model, $id) {
    }

    private function userLoginRequired($values,$pwd = false) {
        if (isset($values['username']) === false || isset($values['token']) === false) {
            if ($this->getApiVersionFromRequest() >= 4) {
                $output = array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => '没有权限执行此操作');
                if($pwd){
                    $output = $this->encryptOutput($output);
                }
                $this->renderJsonOutput($output);
            }else{
                $this->_sendResponse(ErrorList::UNAUTHORIZED, '没有权限执行此操作', 'application/json; charset=utf-8');
            }
        }
        $username = $values['username'];
        $token = $values['token'];
        $authMgr = new AuthManager();
        $authUserIdentity = $authMgr->authenticateUserByToken($username, $token);
        if (is_null($authUserIdentity) || $authUserIdentity->isAuthenticated === false) {
            if ($this->getApiVersionFromRequest() >= 4) {
                $output = array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => '用户名或token不正确');
                if($pwd){
                    $output = $this->encryptOutput($output);
                }
                $this->renderJsonOutput($output);
            }else{
                $this->_sendResponse(ErrorList::UNAUTHORIZED, '用户名或token不正确', 'application/json; charset=utf-8');
            }
        }
        return $authUserIdentity->getUser();
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                </head>
                <body>
                    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                    <p>' . $message . '</p>
                    <hr />
                    <address>' . $signature . '</address>
                </body>
            </html>';

            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function _checkAuth() {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_USERNAME'];
        $password = $_SERVER['HTTP_X_PASSWORD'];
        // Find the user
        $user = User::model()->find('LOWER(username)=?', array(strtolower($username)));
        if ($user === null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if (!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }

    private function loadOverseasHospitalJson() {
        $overseasController = new OverseasController();


        $hospitals = array( 
            array(
                'id' => 1,
                'name' => '新加坡伊丽莎白医院',
                'url' => '',
                'urlImage' => 'http://mingyihz.oss-cn-hangzhou.aliyuncs.com/static%2Foverseas_sg_elizabeth.jpg'
            ),
            array(
                'id' => 2,
                'name' => '新加坡邱德拔医院',
                'url' => '',
                'urlImage' => 'http://mingyihz.oss-cn-hangzhou.aliyuncs.com/static%2Foverseas_sg_ktph.jpg'
            ),
            array(
                'id' => 3,
                'name' => '新加坡中央医院',
                'url' => '',
                'urlImage' => 'http://mingyihz.oss-cn-hangzhou.aliyuncs.com/static%2Foverseas_sg_sgh.jpg'
            ),
            array(
                'id' => 4,
                'name' => '新加坡国立大学医院',
                'url' => '',
                'urlImage' => 'http://mingyihz.oss-cn-hangzhou.aliyuncs.com/static%2Foverseas_sg_nuh.jpg',
            )
        );
        $output = array('hospitals' => array());
        foreach ($hospitals as $hospital) {
            $obj = new stdClass();
            foreach ($hospital as $key => $value) {
                $obj->{$key} = $value;
                $output['hospitals'][] = $obj;
            }
        }

        return $output;
    }

    private function parseQueryOptions($values) {
        $options = array();
        if (isset($values['offset']))
            $options['offset'] = $values['offset'];
        if (isset($values['limit']))
            $options['limit'] = $values['limit'];
        if (isset($values['order']))
            $options['order'] = $values['order'];
        return $options;
    }

    private function getApiVersionFromRequest() {
        return Yii::app()->request->getParam("api", 1);
    }
 
    
}
