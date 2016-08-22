<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/loginValidator.min.1.0.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('登陆名医主刀网移动版');

$urlRegister = $this->createUrl("user/register");
$urlUserValiCaptcha = $this->createUrl("user/valiCaptcha");
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$urlUserAjaxLogin = $this->createUrl('user/ajaxLogin');
$urlUserForgetPassword = $this->createUrl('user/forgetPassword');
$urlUserRegister = $this->createUrl('user/register');
$urlHomeView = Yii::app()->baseUrl;//$this->createUrl('home/view');
$authActionType = AuthSmsVerify::ACTION_USER_LOGIN;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$returnUrl = $returnUrl;
$this->show_footer = false;
?>

<header class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeView; ?>">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">登录</h1>
    <nav class="right">
        <a href="<?php echo $urlUserRegister; ?>">注册</a>
    </nav>
</header>
<nav class="header-secondary bg-white">
    <div class="grid">
        <div id="pawLoginPage" class="col-1 w50 grid middle bb-green color-black">
            密码登录
        </div>
        <div id="smsLoginPage" class="col-1 w50 grid middle bb-gray color-black">
            验证码登录
        </div>
    </div>
</nav>
<article id="login_article" class="active mt10"  data-scroll="true">
    <div>
        <div id="pawLogin" class="pl10 pr10">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'pawLogin-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'htmlOptions' => array('data-checkCode' => $urlUserValiCaptcha, 'data-actionUrl' => $urlUserAjaxLogin, 'data-returnUrl' => $returnUrl),
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
                        <?php echo $form->numberField($modelByPassword, 'username', array('placeholder' => '请输入手机号码', 'class' => 'noPaddingInput')); ?>
                    </div>
                </div>
            </div>
            <div class="input">
                <div class="grid mt20 inputBorder">
                    <div class="col-0 passwordIcon">
                    </div>
                    <div class="col-1">
                        <?php echo $form->passwordField($modelByPassword, 'password', array('placeholder' => '请输入密码', 'class' => 'noPaddingInput')); ?>
                    </div>
                </div>
            </div>
            <div class="pt30">
    <!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
                <a id="btnPawSubmit" class="btn btn-green">登录</a>
            </div>
            <div class="pt15 text-right">
                <a href="<?php echo $urlUserForgetPassword; ?>" class="color-gray">忘记密码</a>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div id="smsLogin" class="hide pl10 pr10">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'smsLogin-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'htmlOptions' => array('data-checkCode' => $urlUserValiCaptcha, 'data-actionurl' => $urlUserAjaxLogin, 'data-returnUrl' => $returnUrl),
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
            <div class="input">
                <div class="grid mt20 inputBorder">
                    <div class="col-0 iphoneIcon">
                    </div>
                    <div class="col-1">
                        <?php echo $form->numberField($modelByMobile, 'username', array('placeholder' => '输入手机号码', 'class' => 'noPaddingInput')); ?>
                    </div>
                </div>
            </div>
            <div class="input">
                <div class="grid mt20 inputBorder">
                    <div id="captchaCode" class="col-1 grid br-gray">
                        <div class="col-0 captchaCodeIcon">
                        </div>
                        <div class="col-1">
                            <input type="text" id="UserDoctorMobileLoginForm_captcha_code" name="UserDoctorMobileLoginForm[captcha_code]" class="noPaddingInput" placeholder="输入图形验证码">
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
                            <?php echo $form->numberField($modelByMobile, 'verify_code', array('placeholder' => '输入验证码', 'class' => 'noPaddingInput')); ?>
                        </div>
                    </div>
                    <div class="col-0 w112p">
                        <button id="btn-sendSmsCode" class="btn btn-sendSmsCode ui-corner-all ui-shadow bg-green">获取验证码</button>
                    </div>
                </div>
            </div>
            <div class="pt30">
    <!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
                <a id="btnSmsSubmit" class="btn btn-green">登录</a>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        vailcode();
        //切换登录方式
        $('#pawLoginPage').click(function () {
            $(this).removeClass('bb-gray');
            $(this).addClass('bb-green');
            $('#smsLoginPage').removeClass('bb-green');
            $('#smsLoginPage').addClass('bb-gray');
            $('#smsLogin').addClass('hide');
            $('#pawLogin').removeClass('hide');
        });
        $('#smsLoginPage').click(function () {
            $(this).removeClass('bb-gray');
            $(this).addClass('bb-green');
            $('#pawLoginPage').removeClass('bb-green');
            $('#pawLoginPage').addClass('bb-gray');
            $('#smsLogin').removeClass('hide');
            $('#pawLogin').addClass('hide');
        });
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });
    });
    function vailcode() {
        $("#vailcode").attr("src", "<?php echo $this->createUrl('user/getCaptcha'); ?>/" + Math.random());
    }
    function checkCaptchaCode(domBtn) {
        //清楚错误信息
        $('.errorMessage').remove();
        var domForm = $("#smsLogin-form");
        var actionUrl = domForm.attr('data-actionurl');
        var captchaCode = $('#UserDoctorMobileLoginForm_captcha_code').val();
        var domMobile = domForm.find("#UserDoctorMobileLoginForm_username");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $("#UserDoctorMobileLoginForm_username").parents('div.input').append("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入手机号码</div>");
            //domMobile.parent().addClass("error");
        } else if (!validatorMobile(mobile)) {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $("#UserDoctorMobileLoginForm_username").parents('div.input').append("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
        } else if (captchaCode == '') {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $('#UserDoctorMobileLoginForm_captcha_code-error').remove();
            $('#captchaCode').parents('div.input').append('<div id="UserDoctorMobileLoginForm_captcha_code-error" class="error">请输入图形验证码</div>');
        } else {
            $("#UserDoctorMobileLoginForm_username-error").remove();
            $('#UserDoctorMobileLoginForm_captcha_code-error').remove();
            //check验证码
            domForm.ajaxSubmit({
                url: '<?php echo $urlUserValiCaptcha; ?>?co_code=' + captchaCode,
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'ok') {
                        sendSmsVerifyCode(domBtn, domForm, mobile, captchaCode);
                    } else {
                        $('#captchaCode').parents('div.input').append('<div id="UserDoctorMobileLoginForm_captcha_code-error" class="error">' + data.error + '</div>');
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
                //console.log(data);
                if (data.status === true || data.status === 'ok') {
                    //domForm[0].reset();
                    buttonTimerStart(domBtn, 60000);
                }
                else {
                    //console.log(data);
                    if (data.errors.captcha_code != undefined) {
                        $('#captchaCode').parents('div.input').append('<div id="UserDoctorMobileLoginForm_captcha_code-error" class="error">' + data.errors.captcha_code + '</div>');
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