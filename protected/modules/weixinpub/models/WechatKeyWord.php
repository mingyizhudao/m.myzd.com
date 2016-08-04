<?php

/**
 * This is the model class for table "wechat_key_word".
 *
 * The followings are the available columns in table 'wechat_key_word':
 * @property integer $id
 * @property string $weixinpub_id
 * @property string $key_word
 * @property string $msg_type
 * @property string $reply_content
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class WechatKeyWord extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wechat_key_word';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weixinpub_id', 'length', 'max'=>20),
			array('key_word', 'length', 'max'=>100),
			array('msg_type', 'length', 'max'=>50),
			array('reply_content', 'length', 'max'=>1000),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, weixinpub_id, key_word, msg_type, reply_content, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
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
			'weixinpub_id' => 'Weixinpub',
			'key_word' => 'Key Word',
			'msg_type' => 'Msg Type',
			'reply_content' => 'Reply Content',
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
		$criteria->compare('weixinpub_id',$this->weixinpub_id,true);
		$criteria->compare('key_word',$this->key_word,true);
		$criteria->compare('msg_type',$this->msg_type,true);
		$criteria->compare('reply_content',$this->reply_content,true);
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
	 * @return WechatKeyWord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
