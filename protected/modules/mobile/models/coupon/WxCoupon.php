<?php

/**
 * This is the model class for table "wx_coupon".
 *
 * The followings are the available columns in table 'wx_coupon':
 * @property integer $id
 * @property integer $user_id
 * @property string $mobile
 * @property string $coupon_code
 * @property integer $coupon_amount
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class WxCoupon extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'wx_coupon';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mobile, coupon_code, date_created', 'required'),
            array('user_id, coupon_amount', 'numerical', 'integerOnly' => true),
            array('mobile', 'length', 'max' => 11),
            array('date_used, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, mobile, coupon_code, coupon_amount, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'user.id',
            'mobile' => '手机号',
            'coupon_code' => '优惠券码',
            'coupon_amount' => '优惠金额',
            'date_used' => '使用时间',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('date_used', $this->date_used, true);
        $criteria->compare('coupon_code', $this->coupon_code, true);
        $criteria->compare('coupon_amount', $this->coupon_amount);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_deleted', $this->date_deleted, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return WxCoupon the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
