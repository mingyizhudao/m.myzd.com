<?php
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'doctor-form',
    'htmlOptions' => array('class' => '', "enctype" => "multipart/form-data", 'data-ajax' => 'false'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnType' => true,
        'validateOnDelay' => 500,
        'errorCssClass' => 'error',
    ),
    'enableAjaxValidation' => true,
        ));
echo CHtml::hiddenField("smsverify[actionUrl]", $urlGetSmsVerifyCode);
echo CHtml::hiddenField("smsverify[actionType]", $authActionType);
?>


<div class="ui-field-contain">
    <label for="DoctorForm_mobile" class="">手机号:</label>
    <?php echo $form->textField($model, 'mobile', array('class' => '', 'maxlength' => 11, 'placeholder' => '请输入手机号')); ?>        
    <?php echo $form->error($model, 'mobile'); ?>
</div>
<div class="ui-field-contain verify_code">
    <label for="verify_code" class="">验证码:</label>
    <?php echo $form->textField($model, 'verify_code', array('class' => '', 'maxlength' => 6, 'autocomplete' => 'off', 'placeholder' => '请输入验证码')); ?>        
    <?php echo $form->error($model, 'verify_code'); ?>
    <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>

</div>
<div class="ui-field-contain">
    <label for="password" class="">登录密码:</label>
    <?php echo $form->passwordField($model, 'password', array('class' => '', 'autocomplete' => 'off', 'maxlength' => 40, 'placeholder' => '4至20位英文或数字')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="ui-field-contain">          
    <label for="DoctorForm_terms">同意名医主刀<a class="" href="<?php echo $this->createUrl('site/page', array('view' => 'terms')); ?>" target="_blank">《在线服务条款》</a></label>  
    <?php echo $form->checkBox($model, 'terms', array('class' => '', 'value' => 1, 'checked' => true)); ?>
    <?php echo $form->error($model, 'terms'); ?>
</div>

<div class="ui-field-contain">
    <input id="btnSubmitEnquiry" class="btn-success" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
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
        var domMobile = $("#DoctorForm_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#DoctorForm_mobile_em_").text("请输入手机号码").show();
            domMobile.parent().addClass("error");
        } else if (domMobile.parent().hasClass("error")) {
            // mobile input field as error, so do nothing.
        } else {
            buttonTimerStart(domBtn, 60000);
            $domForm = $("#doctor-form");
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
</script>