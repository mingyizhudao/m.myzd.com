<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/loginValidator.js', CClientScript::POS_END);
?>
<?php
/*
 * $model UserDoctorMobileLoginForm.
 */
$this->setPageID('pUserLogin');
$this->setPageTitle('用户登录');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlRegister = $this->createUrl("user/register", array('addBackBtn' => 1));
$urlForgetPassword = $this->createUrl('user/forgetPassword', array('addBackBtn' => 1));
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_LOGIN;
?>
<div id="<?php echo $this->getPageID(); ?>" data-theme="a" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-account">
    <style type="text/css">            
        .logo-img>img{width:auto;height:50px;margin: 0 auto 2em auto;display: block;}
    </style>
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
        <div>
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

            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'username', array('class' => 'ui-hidden-accessible')); ?>
                <?php echo $form->numberField($model, 'username', array('placeholder' => '输入手机号码')); ?>
                <?php echo $form->error($model, 'username'); ?>
                <div></div>
                <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取短信验证码</button>  
            </div>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'verify_code', array('class' => 'ui-hidden-accessible')); ?>                                
                <?php echo $form->numberField($model, 'verify_code', array('placeholder' => '请输入短信验证码')); ?>
                <?php echo $form->error($model, 'verify_code'); ?>
                <div></div>
            </div>

            <div class="ui-field-contain">
                <input id="btnSubmit" type="submit" data-ajax="false"  name="yt0" value="登录/注册">              
            </div>
            <div class="ui-field-contain">                
                <div class="mt20 text-right">
<!--                    <a href='<?php echo $urlRegister ?>' data-ajax="false" data-transition="slidefade">没有账号？立即注册</a>-->
                </div>

            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>  
    <!-- leftPanel -->
    <?php //$this->renderPartial("//doctor/_leftPanel");  ?>
    <!-- /panel -->
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
                $("#UserDoctorMobileLoginForm_username").parent().next().html("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入手机号码</div>");
                //domMobile.parent().addClass("error");
            } else if (!validatorMobile(mobile)) {
                $("#UserDoctorMobileLoginForm_username").parent().next().html("<div id='UserDoctorMobileLoginForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
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
</div>

