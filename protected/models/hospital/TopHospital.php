<?php
/**
 * feedback表 用户反馈
 * @author Administrator
 *
 */
class TopHospital extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'top_hospital';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, hospital_id', 'sort', 'integerOnly' => true),
            array('date_start, date_end, appt_date, date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, hospital_id, hospital_name, sort, date_start, date_end, appt_date, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'hospital_id' => '医院ID',
            'hospital_name' => '医院名称',
            'sort' => '排序',
            'date_created' => '创建日期',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted'
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Booking the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        return parent::beforeValidate();
    }

    public function beforeSave() {

        return parent::beforeSave();
    }

    public function getHospitalId() {
        return $this->hospital_id;
    }

    public function getHospitalName() {
        return $this->hospital_name;
    }

    public function getSort() {
        return $this->sort;
    }
}
