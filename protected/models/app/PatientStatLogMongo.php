<?php

/**
 * This is the model class for table "patient_stat_log".
 *
 * The followings are the available columns in table 'patient_stat_log':
 * @property integer $id
 * @property string $user_host_ip
 * @property string $url
 * @property integer $site
 * @property string $key_word
 * @property string $url_referrer
 * @property string $user_agent
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class PatientStatLogMongo extends EMongoDocument
{
        public $id;
        public $user_host_ip;
        public $url;
        public $site;
        public $key_word;
        public $url_referrer;
        public $user_agent;
        public $date_created;
        public $date_updated;
        public $date_deleted;
     // This method is required!
      public function getCollectionName()
      {
        return 'patient_stat_log';
      }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('site', 'numerical', 'integerOnly'=>true),
			array('user_host_ip,site', 'length', 'max'=>20),
			array('url, key_word, url_referrer, user_agent', 'length', 'max'=>255),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_host_ip, url, site, key_word, url_referrer, user_agent, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
		);
	}

	

	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PatientStatLog the static model class
	 */
	  // This has to be defined in every model, this is same as with standard Yii ActiveRecord
         public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
}
