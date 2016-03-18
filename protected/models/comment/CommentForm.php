<?php

class CommentForm extends EFormModel {

    public $id;
    public $user_id;
    public $user_name;
    public $bk_type;
    public $bk_id;
    public $service;
    public $post_operative;
    public $comment_text;
    public $display_order;
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('comment_text', 'required', 'message' => '请输入{attribute}'),
            array('service, post_operative', 'required', 'message' => '请选择{attribute}星级'),
            array('service, post_operative, user_id, bk_type, bk_id', 'numerical', 'integerOnly' => true),
            array('user_id, bk_id', 'length', 'is' => 11),
            array('user_name', 'length', 'max' => 30),
            array('comment_text', 'length', 'max' => 1000),
            array('id, user_id, user_name, bk_type, bk_id, service, post_operative, comment_text, display_order, date_created, date_updated, date_deleted', 'safe'),
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
    
    
    /**
     * gets and sets values form request parameters.
     * @param array $values
     * @param stirng $request
     */
    public function setValuesFromRequest($values, $request = "get") {
        if ($request == "post") {
            $values = $this->normalizePostFields($values);
        }
    }
    
}