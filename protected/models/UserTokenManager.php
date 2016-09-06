<?php
class UserTokenManager{  
    public function __construct() {
        
    }
    //$condition 条件 $sort--排序   $limit 多少条记录  $offset--从那里开始
    public function SelectAll($conditions,$sort,$limit=10,$offset=0){
        $criteria = new EMongoCriteria();
        $criteria->setConditions($conditions);
        if(!empty($sort)){
            $criteria->setSort($sort);
        }
        $criteria->limit($limit);
        $criteria->offset($offset);
        $UserTokenMongo = UserTokenMongo::model()->findAll($criteria);
        return $UserTokenMongo;
    }
    //$condition 条件 $sort--排序   $limit 多少条记录  $offset--从那里开始
    public function SelectOne($conditions,$sort,$limit=10,$offset=0){
        $criteria = new EMongoCriteria();
        $criteria->setConditions($conditions);
        if(!empty($sort)){
            $criteria->setSort($sort);
        }
        $criteria->limit($limit);
        $criteria->offset($offset);
        $UserTokenMongo = UserTokenMongo::model()->findAll($criteria);
        return $UserTokenMongo[0];
    }
    //删除mongodb从ID中
    //params---------$_id
    //return-----------无
    public function DeleteById($_id){
        $modelmongodb=new UserTokenMongo();
        $modelmongodb->_id=new MongoId($_id);
        $modelmongodb->delete();
    }
    //当前对象删除
    public function DeleteByModel($model){
        $modelmongodb=new UserTokenMongo();
        $modelmongodb=$model;
        $modelmongodb->delete();
    }
     //当前对象更新
     public function UpdateByModel($model){
        $modelmongodb=new UserTokenMongo();
        $modelmongodb=$model;
        $modelmongodb->update();
        
    }
     /**
     * 
     * @param type $values = array('username'=>$username, 'password'=>$password, 'userHostIp'=>$userHostIp);
     * @return string
     */
    public function apiTokenUserLoginByPassword($values) {
        $output=new stdClass();
        $output->status= 'no';
        $output->errorCode=0;
        $output->errorMsg='';
        $output->results=array();      
        if (isset($values['username']) == false || isset($values['password']) == false) {
            $output->errorCode = 400;
            $output->errorMsg = 'Wrong parameters.';
            return $output;
        }
        $username = $values['username'];
        $password = $values['password'];
        $userHostIp = isset($values['userHostIp']) ? $values['userHostIp'] : null;
        $output = $this->doTokenUserLoginByPassword($username, $password, $userHostIp);
        return $output;
    }
      /**
     * authenticates user with $username & $password. if true, creates a new AuthTokenUser and returns the token.
     * @param string $username  username used for login
     * @param string $password  password used for login.
     * @param string $userHostIp    user's ip address.
     * @return string AuthTokenUser.token.
     */
    public function doTokenUserLoginByPassword($username, $password, $userHostIp = null) {
        $output=new stdClass();
        $output->status= 'no';
        $output->errorCode=0;
        $output->errorMsg='';
        $output->results=array();
        //$output = array('status' => 'no','errorCode' => 0,'errorMsg' =>'' ,'results' => array()); // default status is false.
        $authUserIdentity = $this->authenticateUserByPassword($username, $password);
        if ($authUserIdentity->isAuthenticated) {
            // username and password are correct. continue to create AuthTokenUser.
            $user = $authUserIdentity->getUser();
            $userMacAddress = null;
            $deActivateFlag = true;
            $tokenUser = $this->createTokenUser($user->getId(), $username, $userHostIp, $userMacAddress, $deActivateFlag);  //@2015-10-28 by Hou Zhen Chuan
            if (isset($tokenUser)) {
                $output->errorCode=0;
                $output->errorMsg = 'success';
                $output->status= 'ok';
                $tokennew= $tokenUser->getToken();
                $tokenclass=new stdClass();
                $tokenclass->token=$tokennew;
                $output->results= $tokenclass;
                //$output['results']['token'] = $tokenUser->getToken();
                // TODO: log.
            } else {
                $output->errorCode = ErrorList::ERROR_TOKEN_CREATE_FAILED;
                $output->errorMsg = '生成token失败!';
                // TODO: log.
            }
        } else {
            $output->errorCode = $authUserIdentity->errorCode;
            $output->errorMsg = '用户名或密码不正确';
        }
        return $output;
    }
    
    public function authenticateUserByPassword($username, $password) {
        $authUserIdentity = new AuthUserIdentity($username, $password, AuthUserIdentity::AUTH_TYPE_PASSWORD);
        $authUserIdentity->authenticate();
        return $authUserIdentity;
    }
    
    //患者用户： USER_ROLE_PATIENT
    //deActivateFlag--直接更新不需要判断
    public function createTokenUser($userId, $username, $userHostIp, $userMacAddress = null, $deActivateFlag = true) {
        $tokenUser = new UserTokenMongo();
        if (!$deActivateFlag) {
             
        }
        $tokenUser->createTokenPatient($userId, $username, $userHostIp, $userMacAddress);
        $tokenUser->save();
        return $tokenUser;
    }
    //判断当前token是否已过期
    //@return -2---用户名错误  -1 时间过期
    public function checkTokentime($userId){
        if(!empty($userId)){
            $conditions['user_id']=$userId;
            $mongodbtime=$this->SelectOne($conditions);
            if($mongodbtime->time_expiry<time()){
                return -1;
            }
            else{
                return 1;
            }
            
        }
        else{
            return -2;
        }
       
    }
    
     /** 注册
     * 
     * @param type $values = array('username'=>$username, 'password'=>$password, 'verify_code'=>$verify_code, 'userHostIp'=>$userHostIp);
     * @return string
     */
    public function apiTokenUserRegister($values) {
        //$output = array('status' => 'no','errorCode' => 0,'errorMsg' =>'' ,'results' => array()); // default status is false.
        $output->status='no';
        $output->errorCode=0;
        $output->errorMsg='';
        $output->results=array();
        // TODO: wrap the following method. first, validates the parameters in $values.
        if (isset($values['username']) === false || isset($values['password']) === false || isset($values['verify_code']) === false) {
            //$output['errorCode'] = ErrorList::BAND_REQUEST;
            //$output['errorMsg'] = 'Wrong parameters.';
            $output->errorCode=ErrorList::BAND_REQUEST;
            $output->errorMsg= 'Wrong parameters.';
            return $output;
        }
        // assign parameters.
        $mobile = $values['username'];
        $password = $values['password'];
        $verifyCode = $values['verify_code'];
        $userHostIp = isset($values['userHostIp']) ? $values['userHostIp'] : null;
        $autoLogin = false;
        if (isset($values['autoLogin']) && $values['autoLogin'] == 1) {
            $autoLogin = true;
        }
        // Verifies AuthSmsVerify by using $mobile & $verifyCode.     手机验证码验证
        $authMgr = new AuthManager();
        $authSmsVerify = $authMgr->verifyCodeForRegister($mobile, $verifyCode, $userHostIp);
        if ($authSmsVerify->isValid() === false) {
            $output->errorMsg = $authSmsVerify->getError('code');
            return $output;
        }
        // Check if username exists.
        if (User::model()->exists('username=:username AND role=:role', array(':username' => $mobile, ':role' => StatCode::USER_ROLE_PATIENT))) {
            $output->status = 'no';
            $output->errorMsg =  '该手机号已被注册';
            return $output;
        }

        // success.
        // Creates a new User model.
        $user = $this->doRegisterUser($mobile, $password);
        if ($user->hasErrors()) {
            // error, so return errors.
            $array= $user->getFirstErrors();
            if(is_array($array)){
                foreach ($array as $k=>$v){
                    $output['errorMsg']=$v;
                }
            }
            return $output;
        } else if ($autoLogin) {
            // auto login user and return token.
            $output = $this->doTokenUserLoginByPassword($mobile, $password, $userHostIp);
        } else {
            $output->status = 'ok';
            $output->errorCode =  0;
            $output->errorMsg =   'success';
        }
        // deactive current smsverify.
        if (isset($authSmsVerify)) {
            $authMgr->deActiveAuthSmsVerify($authSmsVerify);
        }
        return $output;
    }
      // verify code for user register.
    public function verifyCodeForRegister($mobile, $code, $userHostIp) {
        return $this->verifyAuthSmsCode($mobile, $code, AuthSmsVerify::ACTION_USER_REGISTER, $userHostIp);
    }
      /**
     * returns AuthSmsVerify regardless of failure.
     * @param type $mobile
     * @param type $code
     * @param type $actionType
     * @param type $userIp
     * @return AuthSmsVerify
     */
    public function verifyAuthSmsCode($mobile, $code, $actionType, $userIp) {
        // $userIp is not used.
        $smsVerify = AuthSmsVerify::model()->getByMobileAndCodeAndActionType($mobile, $code, $actionType);
        if (is_null($smsVerify)) {
            $smsVerify = new AuthSmsVerify();
            $smsVerify->addError('code', AuthSmsVerify::getErrorMessage(AuthSmsVerify::ERROR_NOT_FOUND));
        } else {
            $smsVerify->checkValidity(true,true);
        }

        return $smsVerify;
    }
    /**
     * 
     * @param type $username
     * @param type $password
     * @param type $terms
     * @return User $model.
     */
    public function doRegisterUser($username, $password, $terms = 1, $activate = 1) {
        // create new User model and save into db.
        $model = new User();
        $model->scenario = 'register';
        $model->username = $username;
        $model->role = StatCode::USER_ROLE_PATIENT;
        $model->password_raw = $password;
        $model->terms = $terms;
        $model->createNewModel();
        if ($activate) {
            $model->setActivated();
        }
        $model->save();

        return $model;
    }

}  
?>
