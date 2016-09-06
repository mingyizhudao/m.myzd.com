<?php

/**
 * This is the model class for table "auth_user_token".
 *
 * The followings are the available columns in table 'AppLog':
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $time_expiry

 */
class UserTokenMongo extends EMongoDocument
{
    public $id;
    public $user_id;
    public $username;
    public $token;
    public $time_expiry;
    const EXPIRY_DEFAULT = 1800;    //30 minutes
    const ERROR_NONE = 0;
    const ERROR_NOT_FOUND = 1;
    const ERROR_INACTIVE = 2;
    const ERROR_EXPIRED = 3;
    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }    
    // This method is required!
    public function getCollectionName()
    {
        return 'auth_user_token';
    }
    public function rules()
    {
         // NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('token', 'length', 'is' => 32),
            array('time_expiry', 'length', 'max'=>11),
            array('username', 'length', 'max'=>128),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,user_id,token,time_expiry,username', 'safe', 'on'=>'search'),
	);
    }
    //直接保存
    public function tokensave($model){
        if(isset($model->user_id)){
            $this->user_id = $model->user_id;
        }
        if(isset($model->token)){
            $this->token = $model->token;
        }
        $this->time_expiry=time();
        $this->save();
    }
    // 创建 token。
    public function createTokenPatient($userId, $username, $userHostIp, $userMacAddress) {
        return $this->createToken($userId, $username, StatCode::USER_ROLE_PATIENT, $userHostIp, $userMacAddress);
    }
    //实际创建TOKE
    public function createToken($userId, $username, $userRole, $userHostIp, $userMacAddress) {
        $this->setUserId($userId);
        $this->setUsername($username);
        $this->setToken();
        $this->setTimeExpiry();
    }
     /*     * ****** Accessors ******* */



    public function getToken() {
        return $this->token;
    }

    private function setToken() {
        $this->token = strtoupper(substr(str_shuffle(MD5(microtime())), 0, 32));   // refer to helper.php
    }

    public function getUserId() {
        return $this->user_id;
    }

    private function setUserId($v) {
        $this->user_id = $v;
    }

    public function getUsername() {
        return $this->username;
    }

    private function setUsername($v) {
        $this->username = $v;
    }

    public function getTimeExpiry() {
        return $this->time_expiry;
    }

    private function setTimeExpiry() {
        $duration = self::EXPIRY_DEFAULT;
        $now = time();
        $this->time_expiry = $now + $duration;
    }
    
    
}
