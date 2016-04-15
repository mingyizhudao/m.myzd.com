<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/loginValidator.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('名医主刀');

$urlRegister = $this->createUrl("user/register");
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_LOGIN;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$returnUrl = $returnUrl;
$this->show_footer = false;
?>
<article id="login_article" class="active"  data-scroll="true">
    <div class="color-white">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl10 pt10">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
    </div>
    <div class="logo w100 loginform">
        <img src="<?php echo $urlResImage ?>/image/logo.png">
        <div class="mt10 color-white">名医主刀</div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'action' => $this->createUrl('user/login'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'htmlOptions' => array('role' => 'form', 'autocomplete' => 'off', 'data-ajax' => 'false'),
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
        <input type="hidden" name="returnUrl" value="<?php echo $returnUrl; ?>">
        <ul class="list bg-none mt40">
            <li class="bb-none ml10">
                <?php echo $form->numberField($model, 'username', array('placeholder' => '输入手机号码')); ?>
                <?php echo $form->error($model, 'username'); ?>
                <div class="error"></div>
            </li>
            <li class="bb-none ml10">
                <div class="grid">
                    <div class="col-1">
                        <?php  echo $form->textField($model, 'captcha_code', array('placeholder' => '输入图形验证码')); ?>
                    </div>
                    <div class="col-0">
                       <?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer'))); ?>
                    </div>
                </div>
                <?php echo $form->error($model, 'captcha_code'); ?>
                <div class="error"></div>
            </li>
            <li class="bb-none ml10">
                <div class="grid">
                    <div class="col-1">
                        <?php echo $form->numberField($model, 'verify_code', array('placeholder' => '输入验证码')); ?>
                    </div>
                    <div class="col-0">
                        <button id="btn-sendSmsCode" class="btn btn-sendSmsCode ui-corner-all ui-shadow bg-green color-white">获取验证码</button>
                    </div>
                </div>
                <?php echo $form->error($model, 'verify_code'); ?>
                <div class="error"></div>
            </li>
            <li class="bb-none ml20 mr20 color-white">
<!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
                <a id="btnSubmit" class="btn btn-yes btn-login bg-green">登录/注册</a>
            </li>
        </ul>
        <?php $this->endWidget(); ?>
    </div>
</article>
<script>
    $(document).ready(function () {
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            sendSmsVerifyCode($(this));
        });
    });
    function sendSmsVerifyCode(domBtn) {
        var domForm = $("#login-form");
        var domMobile = domForm.find("#UserDoctorMobileLoginForm_username");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $("#UserDoctorMobileLoginForm_username").parents('li').append("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入手机号码</div>");
            //domMobile.parent().addClass("error");
        } else if (!validatorMobile(mobile)) {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $("#UserDoctorMobileLoginForm_username").parents('li').append("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
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
                    console.log(data);
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
                domBtn.attr("disabled", false).removeAttr("disabled");
                ;
            }
        }, interval);
    }
    function validatorMobile(mobile) {
        var mobileReg = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return mobileReg.test(mobile);
    }
</script>