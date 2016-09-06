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
    public $token;
    public $time_expiry;
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
            array('token', 'length', 'max'=>32),
            array('time_expiry', 'length', 'max'=>11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,user_id,token,time_expiry', 'safe', 'on'=>'search'),
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
    
    
    
}
