<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/forgetPassword.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('名医主刀');
$urlRegister = $this->createUrl("user/register");
$urlUserValiCaptcha = $this->createUrl("user/valiCaptcha");
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$urlUserAjaxForgetPassword = $this->createUrl("user/ajaxForgetPassword");
$urlUserLogin = $this->createUrl("user/login");
$authActionType = AuthSmsVerify::ACTION_USER_PASSWORD_RESET;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">找回密码</h1>
</header>
<article id="forgetPassword_article" class="active mt10"  data-scroll="true">
    <div class="w100 pl10 pr10">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forgetPassword-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'htmlOptions' => array('data-checkCode' => $urlUserValiCaptcha, 'data-actionurl' => $urlUserAjaxForgetPassword, 'data-returnUrl' => $urlUserLogin),
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
        <div class="input">
            <div class="grid mt20 inputBorder">
                <div class="col-0 iphoneIcon">
                </div>
                <div class="col-1">
                    <?php echo $form->numberField($model, 'username', array('placeholder' => '输入手机号码', 'class' => 'noPaddingInput')); ?>
                </div>
            </div>
        </div>
        <div class="input">
            <div class="grid mt20 inputBorder">
                <div id="captchaCode" class="col-1 grid br-gray">
                    <div class="col-0 captchaCodeIcon">
                    </div>
                    <div class="col-1">
                        <input type="text" id="ForgetPasswordForm_captcha_code" name="ForgetPasswordForm[captcha_code]" class="noPaddingInput" placeholder="输入图形验证码" value="<?php echo empty($captcha_code) ? '' : $captcha_code; ?>">
                    </div>
                </div>
                <div class="col-0 w112p">
                    <a href="javascript:void(0);"><img id="vailcode" class="h40p" src="" onclick="this.src = '<?php echo $this->createUrl('user/getCaptcha'); ?>/' + Math.random()"></a>
                </div>
            </div>
        </div>
        <div class="input">
            <div class="grid mt20 inputBorder">
                <div class="col-1 grid br-gray">
                    <div class="col-0 smsCodeIcon">
                    </div>
                    <div class="col-1">
                        <?php echo $form->numberField($model, 'verify_code', array('placeholder' => '输入验证码', 'class' => 'noPaddingInput')); ?>
                    </div>
                </div>
                <div class="col-0 w112p">
                    <button id="btn-sendSmsCode" class="btn btn-sendSmsCode ui-corner-all ui-shadow bg-green color-white">获取验证码</button>
                </div>
            </div>
        </div>
        <div class="input">
            <div class="grid mt20 inputBorder">
                <div class="col-1 grid">
                    <div class="col-0 passwordIcon">
                    </div>
                    <div class="col-1">
                        <?php echo $form->passwordField($model, 'password_new', array('placeholder' => '输入新密码', 'class' => 'noPaddingInput')); ?>
                    </div>
                </div>
                <div class="col-0 smsSwitch smsHideIcon">
                </div>
            </div>
        </div>
        <div class="pt30">
<!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
            <a id="btnSubmit" class="btn btn-green">登录/注册</a>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</article>
<script>
    function vailcode() {
        $("#vailcode").attr("src", "<?php echo $this->createUrl('user/getCaptcha'); ?>/" + Math.random());
    }
    $(document).ready(function () {
        vailcode();
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });
        $('.smsSwitch').click(function () {
            if ($(this).hasClass('smsHideIcon')) {
                $('#ForgetPasswordForm_password_new').attr('type', 'text');
                $(this).removeClass('smsHideIcon');
                $(this).addClass('smsDisplayIcon');
            } else {
                $('#ForgetPasswordForm_password_new').attr('type', 'password');
                $(this).removeClass('smsDisplayIcon');
                $(this).addClass('smsHideIcon');
            }
        });
    });
    function checkCaptchaCode(domBtn) {
        //清楚错误信息
        $('.errorMessage').remove();
        var domForm = $("#forgetPassword-form");
        var actionUrl = domForm.attr('data-actionurl');
        var captchaCode = $('#ForgetPasswordForm_captcha_code').val();
        var domMobile = domForm.find("#ForgetPasswordForm_username");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#ForgetPasswordForm_username-error").remove();
            $("#ForgetPasswordForm_username").parents('div.input').append("<div id='ForgetPasswordForm_username-error' class='error'>请输入手机号码</div>");
            //domMobile.parent().addClass("error");
        } else if (!validatorMobile(mobile)) {
            $("#ForgetPasswordForm_username-error").remove();
            $("#ForgetPasswordForm_username").parents('div.input').append("<div id='ForgetPasswordForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
        } else if (captchaCode == '') {
            $("#ForgetPasswordForm_username-error").remove();
            $('#ForgetPasswordForm_captcha_code-error').remove();
            $('#captchaCode').parents('div.input').append('<div id="ForgetPasswordForm_captcha_code-error" class="error">请输入图形验证码</div>');
        } else {
            $("#ForgetPasswordForm_username-error").remove();
            $('#ForgetPasswordForm_captcha_code-error').remove();
            //check验证码
            domForm.ajaxSubmit({
                url: '<?php echo $urlUserValiCaptcha; ?>?co_code=' + captchaCode,
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'ok') {
                        sendSmsVerifyCode(domBtn, domForm, mobile, captchaCode);
                    } else {
                        $('#captchaCode').parents('div.input').append('<div id="ForgetPasswordForm_captcha_code-error" class="error">' + data.error + '</div>');
                    }
                }
            });
        }
    }

    function sendSmsVerifyCode(domBtn, domForm, mobile, captchaCode) {
        $(".error").html("");//删除错误信息
        var actionUrl = domForm.find("input[name='smsverify[actionUrl]']").val();
        var actionType = domForm.find("input[name='smsverify[actionType]']").val();
        var formData = new FormData();
        formData.append("AuthSmsVerify[mobile]", mobile);
        formData.append("AuthSmsVerify[actionType]", actionType);
        $.ajax({
            type: 'post',
            url: actionUrl + '?captcha_code=' + captchaCode,
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            'success': function (data) {
                console.log(data);
                if (data.status === true || data.status === 'ok') {
                    //domForm[0].reset();
                    buttonTimerStart(domBtn, 60000);
                }
                else {
                    console.log(data);
                    if (data.errors.captcha_code != undefined) {
                        $('#captchaCode').parents('div.input').append('<div id="ForgetPasswordForm_captcha_code-error" class="error">' + data.errors.captcha_code + '</div>');
                    }
                }
            },
            'error': function (data) {
                console.log(data);
            },
            'complete': function () {
            }
        });
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