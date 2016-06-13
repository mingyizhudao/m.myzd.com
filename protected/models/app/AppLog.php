<?php

/**
 * This is the model class for table "app_log".
 *
 * The followings are the available columns in table 'app_log':
 * @property integer $id
 * @property integer $vendor_id
 * @property string $user_host_ip
 * @property string $username
 * @property string $url
 * @property integer $site
 * @property string $url_referrer
 * @property string $user_agent
 * @property string $user_host
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class AppLog extends EActiveRecord
{
    const SITE_INDEX = 1;
    const SITE_DEPT = 2;
    const SITE_MYGY = 3;
    const SITE_BOOKING = 4;
    const SITE_COMMON_BOOKING = 5;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vendor_id, site', 'numerical', 'integerOnly'=>true),
			array('user_host_ip, username', 'length', 'max'=>20),
			array('url, url_referrer, user_agent', 'length', 'max'=>255),
			array('user_host', 'length', 'max'=>45),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vendor_id, user_host_ip, username, url, site, url_referrer, user_agent, user_host, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vendor_id' => 'Vendor',
			'user_host_ip' => 'User Host Ip',
			'username' => 'Username',
			'url' => 'Url',
			'site' => '位置',
			'url_referrer' => 'Url Referrer',
			'user_agent' => 'User Agent',
			'user_host' => 'User Host',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'date_deleted' => 'Date Deleted',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('user_host_ip',$this->user_host_ip,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('site',$this->site);
		$criteria->compare('url_referrer',$this->url_referrer,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('user_host',$this->user_host,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('date_deleted',$this->date_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
