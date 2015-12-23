<style type="text/css">    
    input[type='text'],input[type='password'],input[type='number']{
        text-align:center;
    }
    .ui-btn.ui-icon-user{display: none;}
</style>
<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/registerValidator.js', CClientScript::POS_END);
?>
<?php
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
$urlRegister = $this->createUrl('user/ajaxRegister');
$urlReturn = $this->createUrl('user/login');
$urlLogin = $this->createUrl('user/login');
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'action' => $urlRegister,
    'htmlOptions' => array('class' => 'register-form', "enctype" => "multipart/form-data", 'data-ajax' => 'false', 'data-registerUrl' => $urlRegister, 'data-returnUrl' => $urlReturn),
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
?>
<div class="ui-field-contain">
    <?php echo $form->labelEx($model, 'username', array('class' => 'ui-hidden-accessible')); ?>                                
    <?php echo $form->numberField($model, 'username', array('placeholder' => '请输入手机号')); ?>
    <div></div>
    <?php echo $form->error($model, 'username'); ?>    
    <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取短信验证码</button>    
</div>
<div class="ui-field-contain verify_code">
    <?php echo $form->labelEx($model, 'verify_code', array('class' => 'ui-hidden-accessible')); ?>         
    <?php echo $form->numberField($model, 'verify_code', array('class' => '', 'autocomplete' => 'off', 'placeholder' => '请输入短信验证码')); ?>       
    <div></div>
    <?php echo $form->error($model, 'verify_code'); ?>  
</div>
<div class="ui-field-contain">
    <?php echo $form->labelEx($model, 'password', array('class' => 'ui-hidden-accessible')); ?>         
    <?php echo $form->passwordField($model, 'password', array('placeholder' => '请输入登录密码')); ?>      
    <div></div>
    <?php echo $form->error($model, 'password'); ?>  
</div>
<div class="ui-field-contain">
    <?php echo $form->labelEx($model, 'password_repeat', array('class' => 'ui-hidden-accessible')); ?>         
    <?php echo $form->passwordField($model, 'password_repeat', array('placeholder' => '请确认密码')); ?>     
    <div></div>
    <?php echo $form->error($model, 'password_repeat'); ?>  
</div>
<div class="ui-field-contain">
    <input id="btnSubmitRegister" class="btn-success" xdata-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
</div>
<div class="ui-field-contain text-right">
    <div class="mt20">
        <a href='<?php echo $urlLogin; ?>' data-ajax="false" data-transition="slidefade">已有账号，马上登录</a>
    </div>
</div>
<?php $this->endWidget(); ?>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            sendSmsVerifyCode($(this));
        });
    });

    function sendSmsVerifyCode(domBtn) {
        var domForm = $("#user-form");
        var domMobile = domForm.find("#UserRegisterForm_username");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#UserRegisterForm_username").parent().next().html("<div id='UserRegisterForm_username-error' class='error'>请输入手机号码</div>");
            $("#UserRegisterForm_username").focus();
        } else if (!validatorMobile(mobile)) {
            $("#UserRegisterForm_username").parent().next().html("<div id='UserRegisterForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
        } else {
            $(".error").html("");//删除错误信息
            buttonTimerStart(domBtn, 60000);
            var actionUrl = domForm.find("input[name='smsverify[actionUrl]']").val();
            var actionType = domForm.find("input[name='smsverify[actionType]']").val();
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
                    if (data.status === true || data.status === 'ok') {
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
    function buttonTimerStart(domBtn, timer) {
        timer = timer / 1000 //convert to second.
        var interval = 1000;
        var timerTitle = '秒后重发';
        domBtn.attr("disabled", true);
        domBtn.html(timer + timerTitle);

        timerId = setInterval(function () {
            timer--;
            if (timer > 0) {
                domBtn.html(timer + timerTitle);
            } else {
                clearInterval(timerId);
                timerId = null;
                domBtn.html("重新发送");
                domBtn.attr("disabled", false);
            }
        }, interval);
    }
    function validatorMobile(mobile) {
        var mobileReg = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return mobileReg.test(mobile);
    }
</script>