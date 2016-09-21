<?php

class ApiwapController extends Controller
{
    
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers
     */
    Const APPLICATION_ID = 'ASCCPE';
            
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    public function init()
    {
          
       
        // $newmongmanage=new UserTokenManager();
        // $condition=array("user_id"=>5000);
        // $order=array("_id"=>EMongoCriteria::SORT_DESC);
        // $newlist=$newmongmanage->SelectOne($condition,$order);
        header("Access-Control-Allow-Origin:*");
        // header('Access-Control-Allow-Origin:http://m.mingyizhudao.com');
        header('Access-Control-Allow-Headers: Origin,X-Requested-With,Authorization,Accept,Content-Type');
        header('Access-Control-Max-Age:' , 3600 * 24);    
        //header('Access-Control-Allow-Origin:http://mingyizhudao.com'); // Cross-domain access.
        header('Access-Control-Allow-Credentials:true'); // 允许携带 用户认证凭据（也就是允许客户端发送的请求携带Cookie）
        $this->getmethod();
        return parent::init();
    }
    //options返回200
    public function getmethod(){
        $method=$_SERVER['REQUEST_METHOD'];
        switch($method){
            case "OPTIONS":
                Yii::app()->end();
            break;    
        }
    }
    // Actions
    public function actionList($model)
    {
        // Get the respective model instance
        switch ($model) {
            case 'dataversion'://数据版本号
                $output=new stdClass();
                $output->status=EApiViewService::RESPONSE_OK;
                $output->errorCode=ErrorList::ERROR_NONE;
                $output->errorMsg='success';
                $output->results=array(
                    'version' => '20151215',
                    'localdataUrl' => Yii::app()->createAbsoluteUrl('/api/localdata'),
                );
            break;
            case 'localdata'://本地需要缓存的数据
                $apiService = new ApiViewPatientLocalData();
                $output = $apiService->loadApiViewData();
                break;
            case 'faculty'://科室
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadFacultyList();
                break;
            case 'overseas'://医院
                $overseasMgr = new OverseasManager();
                $output = $overseasMgr->loadHospitalsJson();
                break;
            case 'appversion'://android ,ios 版本号 参数  
                $get = $_GET;
                $appMgr = new AppManager();
                $output = $appMgr->loadAppVersionJson($get);
            break;
            // app v2.0 api
            case "appnav1"://首屏接口 
                $apiService = new ApiViewAppNav1V6();
                $output = $apiService->loadApiViewData();
            break;
            case "appnav2"://专家团队
                    $values = $_GET;
                    $apiService = new ApiViewExpertTeamSearchV5($values);
                    $output = $apiService->loadApiViewData();
            break;
            case "appnav3": //合作医院
                $values = $_GET;
                $apiService = new ApiViewAppNav3V4($values);
                $output = $apiService->loadApiViewData();
            break;
            case "faculty2":    // can be deleted, use appnav1 instead.
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadFacultyList2();
            break;
            //---------------------前端接口---------------
            case "hospital":
                $values = $_GET;
                $values['isNotPaging'] = 1;
                $apiService = new ApiViewHospitalSearchV2($values);
                $output = $apiService->loadApiViewData();
            break;
            //找医院
            case "findhospital":
                $values = $_GET;
                $apiService = new ApiViewHospitalSearchV7($values);
                $output = $apiService->loadApiViewData();
            break;
            case "listhospital":
                $values = $_GET;
                $hospitalMgr = new HospitalManager();
                $query['city'] = isset($values['city']) ? $values['city'] : null;
                $output['hospitals'] = $hospitalMgr->loadListHospital($query, array('order' => 't.name'));
                break;
            case "tophospital"://医院排行榜
                $values=$_GET;
                $apiService = new ApiViewTopHospital($values);
                $output = $apiService->loadApiViewData();
                break;
            case 'doctor'://医生
                $values=$_GET;
                $apiService = new ApiViewDoctorSearchV7($values);
                $output = $apiService->loadApiViewData();
            break;
            case"userbooking"://需要修改
                $values = $_GET;
                $values['token'] = $this->em_getallheaders();
                $user = $this->userLoginRequired($values);
                if($user){
                    $apiService = new ApiViewBookingListV4($user,$values['bk_status'],true);
                    $output = $apiService->loadApiViewData();
                }
            break;
            case 'expertteam':
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
            case 'diseasename'://根据疾病名称获取疾病信息
                $values = $_GET;
                $apiService = new ApiViewDiseaseName($values);
                $output = $apiService->loadApiViewData();
                break;
            case 'city':
                $values = $_GET;
                $values['type']='doctor';
                $city = new ApiViewOpenCity($values);
                $output = $city->loadApiViewData();
                break;
            case 'diseasecategory'://获取疾病分类
                $apiService = new ApiViewDiseaseCategory();
                $output = $apiService->loadApiViewData();
                break;
            case 'recommendeddoctors'://首页推荐的医生
                $apiService = new ApiViewRecommendedDoctors();
                $output = $apiService->loadApiViewData();
                break;
            case 'commonwealdoctors'://名医公益推荐的医生
                $apiService = new ApiViewCommonwealDoctors();
                $output = $apiService->loadApiViewData();
                break;
            case 'diagnosisdoctors'://名医公益推荐的医生
                $values = $_GET;
                $apiService = new ApiViewDiagnosisDoctor($values);
                $output = $apiService->loadApiViewData();
                break;
            case 'search':
                $values = $_GET;
                $apiService = new ApiViewSearch($values);
                $output = $apiService->loadApiViewData();
            break;
            //验证码
            case 'getcaptcha';
                $values = $_GET;
                $captcha = new CaptchaManage(125,26,6,"wap");
                $resultimage=$captcha->showImg();
                $auth_captcha=new AuthCaptchaManage();
                $output = $auth_captcha->createCaptcha($resultimage); 
            break;
            //验证验证码
            case 'checkcaptcha':
                $values = $_GET;
                $auth_captcha=new AuthCaptchaManage();
                $output = $auth_captcha->checkCaptcha($values); 
            break;
            case "successfulcase":
                $values = $_GET;
                $apiService = new ApiViewSuccessCase($values);
                $output = $apiService->loadApiViewData();
                break;
             //专家展示
            case "expertsshow":
                $values = $_GET;
                $apiService = new ApiViewExpertsShow($values);
                $output = $apiService->loadApiViewData();
                break;
            default:
                // Model not implemented error
                // $this->_sendResponse(501, sprintf('Error: Mode <b>list</b> is not implemented for model <b>%s</b>', $model));
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        // Did we get some results?
        if (empty($output)) {
            // No
            // $this->_sendResponse(200, sprintf('No items where found for model <b>%s</b>', $model));
            $this->_sendResponse(200, sprintf('No result', $model));
        } else {
            $this->renderJsonOutput($output);
            // header('Content-Type: text/html; charset=utf-8');
            // var_dump($output);
        }
    }

    public function actionView($model, $id)
    {
        
        // Check if id was submitted via GET
        if (isset($id) === false) {
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing');
        }
        $output = null;
        switch ($model) {
             // Find respective model    
            case 'faculty':  //TODO: this api is used in v1. will not be supported after v2.0.
                $facultyMgr = new FacultyManager();
                $output = $facultyMgr->loadIFacultyJson($id);
                break;
            case 'hospital':
                $apiService = new ApiViewHospitalV4($id);
                $output = $apiService->loadApiViewData();
                break;
            case 'doctor':
                $doctorMgr = new DoctorManager();
                $output = $doctorMgr->loadIDoctorJson($id);
                break;

            // app v2.0 api.            
            case 'faculty2':
                $facultyMgr = new FacultyManager();
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
                $apiService = new ApiViewExpertTeamV5($id);
                $output = $apiService->loadApiViewData();
                break;
            case 'userbooking':
                $values = $_GET;
                $user = $this->userLoginRequired($values);
                $apiService = new ApiViewBookingV4($user, $id);
                $output = $apiService->loadApiViewData();
                break;
            case 'hospitaldept':
                $searchInputs = $_GET;
                $apiService = new ApiViewHospitalDeptV11($id, $searchInputs);
                $output = $apiService->loadApiViewData();   
                break;
            case'disease':
                $apiSvc = new ApiViewDiseaseV4($id);
                $output = $apiSvc->loadApiViewData();
                break;
            case 'diseasebycategory'://根据疾病分类获取疾病
                $apiService = new ApiViewDiseaseByCategory($id);
                $output = $apiService->loadApiViewData();
                break;
            case 'subcategory':
                $apiService = new ApiViewSubCategory($id);
                $output = $apiService->loadApiViewData();
                break;
            case 'city':
                $apiService = new ApiViewCity($id);
                $output = $apiService->loadApiViewData();
                break;
            
            default:
                $this->_sendResponse(501, sprintf('Mode <b>view</b>  is not implemented for model <b>%s</b>', $model));
                Yii::app()->end();
        }
        // Did we find the requested model? If not, raise an error
        if (is_null($output)) {
            $this->_sendResponse(404, 'No result');
        } else {
            $this->renderJsonOutput($output);
        }
    }

    public function actionCreate($model)
    {
        
        $get = $_GET;
        $post = $_POST;
       
        if (empty($_POST)) {
            // application/json
            $post = CJSON::decode($this->getPostData());
        } else {
            // application/x-www-form-urlencoded
            $post = $_POST;
        }
        // $api = $this->getApiVersionFromRequest();
        // if ($api >= 4) {
        // $output = array('status' => EApiViewService::RESPONSE_NO, 'errorCode' => ErrorList::BAD_REQUEST, 'errorMsg' => 'Invalid request.');
        // } else {
        // $output = array('status' => false, 'error' => 'Invalid request.');
        // }
        
        switch ($get['model']) {
            // Get an instance of the respective model
            //手机用户注册
            case 'userregister': // remote user register.
                if (isset($post['userRegister'])) {
                    $values = $post['userRegister'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $values['agent_parmas'] = 'wap';
                    $userMgr = new UserManager();
                    $output = $userMgr->apiTokenUserRegister($values);
                } else {
                    $output['error'] = 'Wrong parameters.';
                }
                
                break;
            // 手机密码登录
            case 'userlogin': // remote user login.
                if (isset($post['userLogin'])) {
                    // get user ip from request.
                    $values = $post['userLogin'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $values['agent_parmas'] = "wap";
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
            case 'quickbooking': // 快速预约
                if (isset($post['booking'])) {
                    
                    $values = $post['booking'];
                    $values['token'] = $this->em_getallheaders();
                  
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $values['user_agent'] = ($this->isUserAgentWeixin()) ? StatCode::USER_AGENT_WEIXIN : StatCode::USER_AGENT_MOBILEWEB;
                    if (! isset($values['verify_code'])) {   
                        $checkVerifyCode = false;
                        $user = $this->userLoginRequired($values); // check if user has login.
                        if (is_object($user)) {
                            $values['user_id'] = $user->getId();
                            $values['mobile'] = $user->getUserName();
                        }
                    } else {
                        $checkVerifyCode = true;
                    }
                    $bookingMgr = new BookingManager();
                    $output = $bookingMgr->apiCreateQuickBooking($values, $checkVerifyCode);
                } else {
                    $output['error'] = 'missing parameters';
                }
                break;
            
            case 'smsverifycode': // sends sms verify code AuthSmsVerify.
                if (isset($post['smsVerifyCode'])) {
                    $values = $post['smsVerifyCode'];
                    $values['userHostIp'] = Yii::app()->request->userHostAddress;
                    $authMgr = new AuthManager();
                    $output = $authMgr->apiSendVerifyCode($values);
                } else {
                    $output['error'] = 'Wrong parameters.';
                }
            break;
           
                  
            default:
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        $this->renderJsonOutput($output);
    }

    public function actionUpdate($model, $id)
    {
        if ($model == 'booking') {
            $bookingMgr = new BookingManager();
            $userId = $this->getCurrentUserId();
            if (empty($userId) || empty($id)) {
                $output['status'] = 'no';
                $output['error_code'] = EApiViewService::RESPONSE_VALIDATION_ERRORS;
                $output['message'] = 'Wrong parameters';
                $this->renderJsonOutput($output);
            }
            $output = $bookingMgr->actionCancelBooking($id, $userId);
            $this->renderJsonOutput($output);
        }
    }

    public function actionDelete($model, $id)
    {}

    /**
     * 用户登录验证
     *
     * @param unknown $values            
     * @param string $pwd            
     * @return User
     */
    private function userLoginRequired($values)
    {
        $userMgr = new UserManager();
      
        $user = $userMgr->loadUserAndTokenBytoken($values['token']);
        $values['username'] = (isset($user->token->username)) ? $user->token->username: NULL;
        $output = new stdClass();
        if (isset($values['username']) === false || isset($values['token']) === false) {
            $this->renderJsonOutput($output->status = EApiViewService::RESPONSE_NO, $output->errorCode = ErrorList::BAD_REQUEST, $output->errorMsg = '没有权限执行此操作');
        }
     
        $authMgr = new AuthManager();
        $authUserIdentity = $authMgr->authenticateWapUserByToken($values['username'], $values['token'], $agent = 'wap');
            if (is_null($authUserIdentity) || $authUserIdentity->isAuthenticated === false) {
            $output->status =EApiViewService::RESPONSE_NO;
            $output->errorCode = ErrorList::BAD_REQUEST;
            $output->errorMsg = '用户名或token不正确';
            $this->renderJsonOutput($output);
        
        } else {
            $authTokenMsg = new AuthTokenUser();
        
            $authTokenMsg->durationTokenPatient($values['token'], $values['username']);
        }
          
        return $authUserIdentity->getUser();
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);
        
        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        }  // we need to create the body if none is passed
else {
            // create some body messages
            $message = '';
            
            // this is purely optional, but makes the pages a little nicer to read
            // for your users. Since you won't likely send a lot of different status codes,
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

    private function _getStatusCodeMessage($status)
    {
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
            501 => 'Not Implemented'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (! (isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_USERNAME'];
        $password = $_SERVER['HTTP_X_PASSWORD'];
        // Find the user
        $user = User::model()->find('LOWER(username)=?', array(
            strtolower($username)
        ));
        if ($user === null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else 
            if (! $user->validatePassword($password)) {
                // Error: Unauthorized
                $this->_sendResponse(401, 'Error: User Password is invalid');
            }
    }

    private function loadOverseasHospitalJson()
    {
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
                'urlImage' => 'http://mingyihz.oss-cn-hangzhou.aliyuncs.com/static%2Foverseas_sg_nuh.jpg'
            )
        );
        $output = array(
            'hospitals' => array()
        );
        foreach ($hospitals as $hospital) {
            $obj = new stdClass();
            foreach ($hospital as $key => $value) {
                $obj->{$key} = $value;
                $output['hospitals'][] = $obj;
            }
        }
        
        return $output;
    }

    private function parseQueryOptions($values)
    {
        $options = array();
        if (isset($values['offset']))
            $options['offset'] = $values['offset'];
        if (isset($values['limit']))
            $options['limit'] = $values['limit'];
        if (isset($values['order']))
            $options['order'] = $values['order'];
        return $options;
    }

    private function getApiVersionFromRequest()
    {
        return Yii::app()->request->getParam("api", 1);
    }

    /**
     * 接收头信息
     * by 20160905
     */
    private function em_getallheaders()
    {
        if (! function_exists('getallheaders')) {

            function getallheaders()
            {
                foreach ($_SERVER as $name => $value) {
                    if (substr($name, 0, 5) == 'HTTP_') {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }
            }
        } else {
            $hearders = getallheaders();
        }
        $token = isset($hearders['Authorization']) ? $hearders['Authorization'] : '';
        return $token;
    }
}
