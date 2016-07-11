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
class PatientStatLog extends EActiveRecord
{
    const SITE_1 = 1; //激活搜索框搜索
    const SITE_2 = 2; //点击科室按钮
    const SITE_3 = 3; //点击找名医按钮
    const SITE_4 = 4; //点击快速预约按钮
    const SITE_5 = 5; //点击banner
    const SITE_6 = 6; //点击在线客服按钮
    const SITE_7 = 7; //搜索结果页展示
    const SITE_8 = 8; //成功到达预约单页面
    const SITE_9 = 9; //点击预约按钮
    const SITE_10 = 10; //预约请求成功发出
    const SITE_11 = 11; //成功开启订单页面
    const SITE_12 = 12; //点击暂不支付按钮
    const SITE_13 = 13; //点击支付按钮
    const SITE_14 = 14; //成功到达支付成功页面

    const SITE_20 = 20; //用户搜索的关键词列表
    const SITE_21 = 21; //用户选择的疾病关键词和对应选择次数
    const SITE_22 = 22; //用户搜索的医院列表和对应选择次数
    const SITE_23 = 23; //用户搜索的科室列表和对应选择次数
    const SITE_24 = 24; //用户搜索的医生列表和对应选择次数


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
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
			array('site', 'numerical', 'integerOnly'=>true),
			array('user_host_ip', 'length', 'max'=>20),
			array('url, key_word, url_referrer, user_agent', 'length', 'max'=>255),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_host_ip, url, site, key_word, url_referrer, user_agent, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
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
			'user_host_ip' => 'User Host Ip',
			'url' => 'Url',
			'site' => '位置',
			'key_word' => '1有预约意向',
			'url_referrer' => 'Url Referrer',
			'user_agent' => 'User Agent',
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
		$criteria->compare('user_host_ip',$this->user_host_ip,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('site',$this->site);
		$criteria->compare('key_word',$this->key_word,true);
		$criteria->compare('url_referrer',$this->url_referrer,true);
		$criteria->compare('user_agent',$this->user_agent,true);
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
	 * @return PatientStatLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
