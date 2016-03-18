<?php
class Comment extends EActiveRecord {
    public $num;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service, post_operative, user_id, user_name, bk_type, bk_id', 'required'),
            array('service, post_operative, user_id, bk_type, bk_id', 'numerical', 'integerOnly' => true),
            array('user_id， bk_id', 'length', 'is' => 11),
            array('user_name', 'length', 'max' => 30),
            array('comment_text', 'length', 'max' => 1000),
            array('date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, user_name, bk_type, bk_id, service, post_operative, comment_text, display_order, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bfBooking' => array(self::BELONGS_TO, 'Booking', 'booking_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => '用户ID',
            'user_name' => '用户名',
            'bk_type' => '预约类型',
            'bk_id' => '关联预约表预约ID',
            'service' => '服务效率',
            'post_operative' => '术后效果',
            'comment_text' => '评价描述',
            'display_order' => '默认排序',
            'date_created' => '创建日期',
            'date_updated' => '修改日期',
            'date_deleted' => '删除日期'
        );
    }
    
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
    
        $criteria = new CDbCriteria;
    
        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('user_name', $this->user_name);
        $criteria->compare('bk_type', $this->bk_type, true);
        $criteria->compare('bk_id', $this->bk_id, true);
        $criteria->compare('service', $this->service, true);
        $criteria->compare('post_operative', $this->post_operative);
        $criteria->compare('comment_text', $this->comment_text);
        $criteria->compare('display_order', $this->display_order);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_deleted', $this->date_deleted, true);
    
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function beforeValidate() {
        $this->createRefNumber();
        return parent::beforeValidate();
    }
    
    public function beforeSave() {
    
        return parent::beforeSave();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUseriId() {
        return $this->user_id;
    }
    
    public function getUserName() {
        return $this->user_name;
    }
    
    public function getBkType() {
        return $this->bk_type;
    }
    
    public function getBkId() {
        return $this->bk_id;
    }
    
    public function getService() {
        return $this->service;
    }
    
    public function getPostOperative() {
        return $this->post_operative;
    }
    
    public function getCommentText() {
        return $this->comment_text;
    }
    
    public function getDisplayOrder() {
        return $this->display_order;
    }
    
    public function getDateCreated() {
        return $this->date_created;
    }
    
    public function getDateUpdated() {
        return $this->date_updated;
    }
    
    public function getDateDeleted() {
        return $this->date_deleted;
    }
    
    /**
     * 根据评价CommentIds查询数据
     * @param type $CommentIds
     * @param type $with
     * @return type
     */
    public function getByIds($CommentIds, $attr = null, $with = null, $options = null) {
        $criteria = new CDbCriteria;
        if (is_array($with)) {
            $criteria->with = $with;
        }
        $criteria->addCondition('t.date_deleted is NULL');
        $criteria->addInCondition('t.id', $CommentIds);
        return $this->find($criteria);
    }
    
    /**
     * 根据BookingIds查询数据
     */
    public function getBookingIds($BookingIds, $attr = null, $with = null, $options = null){
        $criteria = new CDbCriteria;
        if (is_array($with)) {
            $criteria->with = $with;
        }
        $criteria->addCondition('t.date_deleted is NULL');
        $criteria->addInCondition('t.bk_id', $BookingIds);
        return $this->find($criteria);
    }
}