<?php

/**
 * This is the model class for table "CoreLog".
 *
 * The followings are the available columns in table 'AppLog':
 * @property integer $id
 * @property string $message
 * @property string $level
 * @property string $category
 * @property string $logtime
 */
class CoreLogMongo extends EMongoDocument
{
        public $id;
        public $message;
        public $level;
        public $category;
        public $logtime;
           public $date_created;
        public $date_updated;
        public $date_deleted;
    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    // This method is required!
    public function getCollectionName()
    {
        return 'CoreLog';
    }
//     public function addInfo($values) {
        
//         $this->save();
//     }
    public function rules()
    {
        
         // NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
// 			array('vendor_id, site, question, answer, source', 'numerical', 'integerOnly'=>true),
			//array('user_host_ip, username', 'length', 'max'=>20),
			//array('url, url_referrer, user_agent,method', 'length', 'max'=>255),
                        array('message', 'length', 'max'=>2000),
			array('logtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,category,level,message,logtime', 'safe', 'on'=>'search'),
		);
    }
    //直接保存
    public function storesave($message,$level,$category){
        if(isset($message)){
            $this->message = $message;
        }
        if(isset($level)){
            $this->level = $level;
        }
        if(isset($category) && !empty($category)){
            $this->category = $category;
        }
        $this->logtime=time();
        $this->save();
    }
   
    
}
