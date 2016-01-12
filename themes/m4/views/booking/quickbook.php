<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/quickBooking.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
/*
 * $model BookQuickForm.
 */
$this->setPageTitle('快速预约');
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlSubmitForm = $this->createUrl("booking/ajaxQuickbook");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlReturn = $this->createUrl('home/index');
$urlHomeIndex = $this->createUrl('home/index');
$this->show_footer = false;
?>
<style>
    .btn {display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;}
</style>
<div id="section_container">
    <section id="corp_section" class="active">
        <article class="active" data-scroll="true">
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
                                <?php echo CHtml::activeLabel($model, 'mobile'); ?>                                           
                                <?php echo $form->numberField($model, 'mobile', array('name' => 'booking[mobile]', 'placeholder' => '请输入手机号')); ?>
                                <?php echo $form->error($model, 'mobile'); ?> 
                                <button id="btn-sendSmsCode" type="button" class="w100 bg-green">获取验证码</button>
                            </div>
                            <div class="ui-field-contain">
                                <?php echo CHtml::activeLabel($model, 'verify_code'); ?>                                           
                                <?php echo $form->numberField($model, 'verify_code', array('name' => 'booking[verify_code]', 'placeholder' => '请输入验证码')); ?>
                                <?php echo $form->error($model, 'verify_code'); ?> 
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
                            <div class="ui-field-contain">
                                <?php echo $this->renderPartial('//booking/_uploadFile'); ?>
                            </div>
                            <div class="ui-field-contain mb10">                
                                <a id="btnSubmit" type="button" name="yt0" class="btn btn-yes btn-abs w100 bg-green">提交</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            sendSmsVerifyCode($(this));
        });
    });

    function sendSmsVerifyCode(domBtn) {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            //$("#booking_mobile_em_").text("请输入手机号码").show();
            //domMobile.parent().addClass("error");
            //showErrorPopup('请输入手机号码', '#popupError', '#triggerPopupError');
            J.showToast('请输入手机号码');
        } else if (domMobile.hasClass("error")) {

            // mobile input field as error, so do nothing.
        } else {
            buttonTimerStart(domBtn, 60000);
            $domForm = $("#booking-form");
            var actionUrl = $domForm.find("input[name='smsverify[actionUrl]']").val();
            var actionType = $domForm.find("input[name='smsverify[actionType]']").val();
            var formData = new FormData();
            formData.append("AuthSmsVerify[mobile]", mobile);
            formData.append("AuthSmsVerify[actionType]", actionType);

            $.ajax({
                type: 'post',
                url: actionUrl,
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                'success': function (data) {
                    if (data.status === true) {
                        //domForm[0].reset();
                    }
                    else {
                        console.log(data);
                    }
                },
                'error': function (data) {
                    console.log(data);
                },
                'complete': function () {
                }
            });
        }
    }
</script>
