<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/booking.js', CClientScript::POS_END);
/*
 * $model BookExpertTeamForm
 */
$this->show_footer = false;
$this->setPageID('pQuickBooking');
$this->setPageTitle('预约专家团队');
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlReturn = $this->createUrl('order/view');
?>

<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-expertteam" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'booking-form',
                'action' => $urlSubmitForm,
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
            echo $form->hiddenField($model, 'expteam_id', array('name' => 'booking[expteam_id]'));
            //echo $form->hiddenField($model, 'expteam_name', array('name' => 'booking[expteam_name]'));
            ?>
            <div class="ui-field-contain">     
                <h4>预约专家团队：</h4>
                <h4><?php echo $model->expteam_name; ?></h4>
                <h4><?php echo $model->hospital_name; ?></h4>
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
                <button id="btn-sendSmsCode" type="button" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>
            </div>
            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'verify_code'); ?>                                           
                <?php echo $form->numberField($model, 'verify_code', array('name' => 'booking[verify_code]', 'placeholder' => '请输入验证码')); ?>
                <?php echo $form->error($model, 'verify_code'); ?> 
            </div>

            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'disease_name'); ?>                                           
                <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'placeholder' => '请输入确诊疾病')); ?>
                <?php echo $form->error($model, 'disease_name'); ?> 
            </div>

            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'disease_detail'); ?>                                           
                <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'placeholder' => '请尽可能详细的描述患者的病情', 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'disease_detail'); ?> 
            </div>
            <div class="ui-field-contain">
                <?php echo $this->renderPartial('_uploadFile'); ?>
            </div>   
            <div class="ui-field-contain">
                <button id="btnSubmit" type="submit" name="yt0">提交</button>
            </div>
            <?php
            $this->endWidget();
            ?>
        </div>
    </div>
    <!-- popup error message -->
    <a id="triggerPopupError" class="hide" href="#popupError" data-rel="popup" data-position-to="window"></a>
    <div data-role="popup" id="popupError" class="error-popup ui-content">
        <p class="error"></p>
    </div> 
</div>
<div id="success" class="" data-role="page" data-title="提交成功">
    <div data-role="content">
        <div>
            <h4>预约成功！</h4>
            <h4>我们的工作人员会尽快联系您。</h4>
        </div>
        <br />
        <br />
        <div>
            <a href="<?php echo $this->createUrl('home/index'); ?>" data-ajax="false" class="ui-btn">返回首页</a>
        </div>
    </div>
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
            showErrorPopup('请输入手机号码', '#popupError', '#triggerPopupError');
        } else if (domMobile.parent().hasClass("error")) {
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
