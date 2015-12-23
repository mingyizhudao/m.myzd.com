<style type="text/css">    
    input[type='text'],input[type='password'],input[type='number']{
        text-align:center;
    }
    .register-form{margin: 10px 20px 0;}
</style>
<?php
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
$urlCreateBooking = $this->createAbsoluteUrl("/booking/testCreate");
$urlUploadFile = $this->createAbsoluteUrl("/booking/uploadFile");
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'doctor-form',
    'htmlOptions' => array('class' => 'register-form', "enctype" => "multipart/form-data", 'data-ajax' => 'false', 'data-actionUrl' => $urlCreateBooking, 'data-url-uploadFile' => $urlUploadFile),
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
    <label for="DoctorForm_mobile" class="ui-hidden-accessible">手机号:</label>
    <?php echo $form->numberField($model, 'mobile', array('class' => '', 'placeholder' => '请输入手机号')); ?>        
    <div class="mt5"></div>
    <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>
</div>
<div class="ui-field-contain verify_code">
    <label for="verify_code" class="ui-hidden-accessible">验证码:</label>
    <?php echo $form->numberField($model, 'verify_code', array('class' => '', 'autocomplete' => 'off', 'placeholder' => '请输入验证码')); ?>        
    <div class="mt5"></div>
    

</div>
<div class="ui-field-contain">
    <label for="DoctorForm_mobile" class="ui-hidden-accessible">密码:</label>
    <?php echo $form->passwordField($model, 'password', array('class' => '', 'placeholder' => '设置密码')); ?>        
    <div class="mt5"></div>
</div>
<div class="ui-field-contain">
    <label for="DoctorForm_mobile" class="ui-hidden-accessible">确认密码:</label>
    <?php echo $form->passwordField($model, 'password_repeat', array('class' => '', 'placeholder' => '请再次确认密码')); ?>        
    <div class="mt5"></div>
</div>
<div class="ui-field-contain">
    <input id="btnSubmitEnquiry" class="btn-success" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
</div>
<?php $this->endWidget(); ?>
<br />
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            initForm();
        }, 200);

        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            sendSmsVerifyCode($(this));
        });
    });

    function initForm() {
        var htmlstr = "<button class='ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-plus' style='margin:0;'>添加文件</button>";
        $("#btn-addfiles_wrap").css("position", "relative").prepend(htmlstr).find("input[type='file']").attr("capture", "camera");
        //console.log($("#btn-addfiles_wrap").html());
    }

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