<?php

/**
 * This is the model class for table "auth_captcha".
 *
 * The followings are the available columns in table 'auth_captcha':
 * @property integer $id
 * @property string $image
 * @property string $code
 * @property integer $is_active
 * @property integer $time_expiry
 * @property string $user_host_ip
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class AuthCaptcha extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auth_captcha';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, code', 'required'),
			array('is_active, time_expiry', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>255),
			array('code', 'length', 'max'=>20),
			array('user_host_ip', 'length', 'max'=>15),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image, code, is_active, time_expiry, user_host_ip, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
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
			'image' => 'Image',
			'code' => 'Code',
			'is_active' => 'Is Active',
			'time_expiry' => 'Time Expiry',
			'user_host_ip' => 'User Host Ip',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('time_expiry',$this->time_expiry);
		$criteria->compare('user_host_ip',$this->user_host_ip,true);
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
	 * @return AuthCaptcha the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
         
}
