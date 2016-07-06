<?php

/**
 * This is the model class for table "questionnaire_file".
 *
 * The followings are the available columns in table 'questionnaire_file':
 * @property integer $id
 * @property integer $questionnaire_id
 * @property string $file_ext
 * @property string $mime_type
 * @property string $file_name
 * @property string $file_url
 * @property integer $file_size
 * @property string $thumbnail_name
 * @property string $thumbnail_url
 * @property string $base_url
 * @property string $report_type
 * @property integer $has_remote
 * @property string $remote_domain
 * @property string $remote_file_key
 * @property integer $display_order
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class QuestionnaireFile extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questionnaire_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_ext, file_name, file_url', 'required'),
			array('questionnaire_id, file_size, has_remote, display_order', 'numerical', 'integerOnly'=>true),
			array('file_ext, report_type', 'length', 'max'=>10),
			array('mime_type', 'length', 'max'=>20),
			array('file_name, thumbnail_name, remote_file_key', 'length', 'max'=>40),
			array('file_url, thumbnail_url, base_url, remote_domain', 'length', 'max'=>255),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, questionnaire_id, file_ext, mime_type, file_name, file_url, file_size, thumbnail_name, thumbnail_url, base_url, report_type, has_remote, remote_domain, remote_file_key, display_order, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
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
			'questionnaire_id' => 'Questionnaire',
			'file_ext' => 'File Ext',
			'mime_type' => 'Mime Type',
			'file_name' => 'File Name',
			'file_url' => 'File Url',
			'file_size' => 'File Size',
			'thumbnail_name' => 'Thumbnail Name',
			'thumbnail_url' => 'Thumbnail Url',
			'base_url' => 'Base Url',
			'report_type' => 'Report Type',
			'has_remote' => 'Has Remote',
			'remote_domain' => 'Remote Domain',
			'remote_file_key' => 'Remote File Key',
			'display_order' => 'Display Order',
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
		$criteria->compare('questionnaire_id',$this->questionnaire_id);
		$criteria->compare('file_ext',$this->file_ext,true);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_url',$this->file_url,true);
		$criteria->compare('file_size',$this->file_size);
		$criteria->compare('thumbnail_name',$this->thumbnail_name,true);
		$criteria->compare('thumbnail_url',$this->thumbnail_url,true);
		$criteria->compare('base_url',$this->base_url,true);
		$criteria->compare('report_type',$this->report_type,true);
		$criteria->compare('has_remote',$this->has_remote);
		$criteria->compare('remote_domain',$this->remote_domain,true);
		$criteria->compare('remote_file_key',$this->remote_file_key,true);
		$criteria->compare('display_order',$this->display_order);
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
	 * @return QuestionnaireFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
