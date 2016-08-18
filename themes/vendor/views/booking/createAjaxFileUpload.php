<?php
Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/vendor/qiniu.base.min.1.0.css');
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/qiniu.base.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/quickBookingUpload.min.1.0.js', CClientScript::POS_END);
/*
 * $model BookQuickForm.
 */
$this->setPageTitle('快速预约');
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlSubmitForm = $this->createUrl("booking/ajaxQuickbook");
$urlUploadFile = $this->createUrl("qiniu/ajaxBookingFile");
$urlReturn = $this->createUrl('order/view');
$urlHomeView = $this->createUrl('home/view');
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$user = $this->getCurrentUser();
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">快速预约</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<article id="quickBookAndroid" class="active android_article" data-scroll="true">
    <div class="ml10 mr10 mt10">
        <div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>">
            <div data-role="content">
                <div class="form-wrapper">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'booking-form',
                        'htmlOptions' => array("enctype" => "multipart/form-data", 'data-actionUrl' => $urlSubmitForm, 'data-url-uploadFile' => $urlUploadFile, 'data-url-return' => $urlReturn),
                        'enableClientValidation' => false,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnType' => true,
                            'validateOnDelay' => 500,
                            'errorCssClass' => 'error',
                        ),
                        'enableAjaxValidation' => false,
                    ));

                    echo CHtml::hiddenField("smsverify[actionUrl]", $urlGetSmsVerifyCode);
                    echo CHtml::hiddenField("smsverify[actionType]", $authActionType);
                    echo $form->hiddenField($model, 'bk_type', array('name' => 'booking[bk_type]'));
                    echo $form->hiddenField($model, 'bk_status', array('name' => 'booking[bk_status]'));
                    ?>
                    <input type="hidden" id="booking_id" value="">
                    <input type="hidden" id="salesOrderRefNo" value="">
                    <input type="hidden" id="domain" value="http://mr.file.mingyizhudao.com">
                    <input type="hidden" id="uptoken_url" value="<?php echo $urlQiniuAjaxToken; ?>">
                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'hospital_name'); ?>                                           
                        <?php echo $form->textField($model, 'hospital_name', array('name' => 'booking[hospital_name]', 'placeholder' => '请输入医院名称，可不填')); ?>
                        <?php echo $form->error($model, 'hospital_name'); ?> 
                    </div>
                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'hp_dept_name'); ?>                                           
                        <?php echo $form->textField($model, 'hp_dept_name', array('name' => 'booking[hp_dept_name]', 'placeholder' => '请输入科室名称，可不填')); ?>
                        <?php echo $form->error($model, 'hp_dept_name'); ?> 
                    </div>
                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'doctor_name'); ?>                                           
                        <?php echo $form->textField($model, 'doctor_name', array('name' => 'booking[doctor_name]', 'placeholder' => '请输入医生姓名，可不填')); ?>
                        <?php echo $form->error($model, 'doctor_name'); ?> 
                    </div>
                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'contact_name'); ?>                                           
                        <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'placeholder' => '请输入患者姓名')); ?>
                        <?php echo $form->error($model, 'contact_name'); ?> 
                    </div>
                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'disease_name'); ?>                                           
                        <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'placeholder' => '请填写确诊疾病')); ?>
                        <?php echo $form->error($model, 'disease_name'); ?> 
                    </div>

                    <div class="ui-field-contain">
                        <?php echo CHtml::activeLabel($model, 'disease_detail'); ?>                                           
                        <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'placeholder' => '请尽可能详细的描述患者的病情', 'maxlength' => 1000)); ?>
                        <?php echo $form->error($model, 'disease_detail'); ?> 
                    </div>
                    <?php
                    $this->endWidget();
                    ?>
                    <div>
                        上传病例或影像资料
                    </div>
                    <div class="body mt10 pb30">
                        <div class="text-center">
                            <div id="container">
                                <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                                    <span>选择影像资料</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 mt10">
                            <table class="table table-striped table-hover text-left" style="display:none">
                                <tbody id="fsUploadProgress">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui-field-contain mt35 mb30">                
                        <button id="btnSubmit" type="button" name="yt0" class="w100 bg-green">提交</button>
                    </div>
                </div>
            </div>  
        </div>
        <div id="success" class="hide">
            <div id="jingle_popup" class="bookingConfirm">
                <div class="bookingDiv">
                    <div>预约成功</div>
                    <div class="mt20">
                        <a href="<?php echo $urlReturn; ?>" class="btn bg-green btn-yes color-black w60">确定</a>
                    </div>
                </div>
            </div>
            <div id="jingle_popup_mask" style="opacity: 0.3; display: block; position:fixed;"></div>
        </div>
    </div>
</article>
<div id="jingle_toast" class="mobileTip toast"><a href="#">请填写手机号</a></div>
<div id="loading_popup" style="" class="loading">
    <i class="icon spinner"></i>
    <p>加载中...</p>
</div>