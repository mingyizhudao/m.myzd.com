<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/forgetPwdValidator.js', CClientScript::POS_END);
?>
<?php
/*
 * $model UserDoctorMobileLoginForm.
 */
$this->setPageID('pForgetPassword');
$this->setPageTitle('忘记密码');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$urlAction = $this->createUrl('user/ajaxForgetPassword');
$urlReturn = "#success";
$urlLogin = $this->createUrl('user/login');
$authActionType = AuthSmsVerify::ACTION_USER_PASSWORD_RESET;
?>
<div id="<?php echo $this->getPageID(); ?>" data-theme="a" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-nav-rel="#f-nav-account">
    <style type="text/css">            
        .logo-img>img{width:auto;height:50px;margin: 0 auto 2em auto;display: block;}
        .ui-btn.ui-icon-user{display: none;}
    </style>
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
        <div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'changePwd-form',
                'action' => $urlAction,
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'htmlOptions' => array('role' => 'form', 'autocomplete' => 'off', 'data-ajax' => 'false', 'data-returnUrl' => $urlReturn),
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
                <?php echo $form->numberField($model, 'verify_code', array('placeholder' => '请输入验证码')); ?>
                <?php echo $form->error($model, 'verify_code'); ?>
                <div></div>
            </div>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'password_new', array('class' => 'ui-hidden-accessible')); ?>                                
                <?php echo $form->passwordField($model, 'password_new', array('placeholder' => '请输入新密码')); ?>
                <?php echo $form->error($model, 'password_new'); ?>
                <div></div>
            </div>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'password_repeat', array('class' => 'ui-hidden-accessible')); ?>                                
                <?php echo $form->passwordField($model, 'password_repeat', array('placeholder' => '请重复新密码')); ?>
                <?php echo $form->error($model, 'password_repeat'); ?>
                <div></div>
                <div class="ui-field-contain">
                    <input id="btnSubmit" type="submit" data-ajax="false"  name="yt0" value="提交">              
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
            var domForm = $("#changePwd-form");
            var domMobile = domForm.find("#ForgetPasswordForm_username");
            var mobile = domMobile.val();
            if (mobile.length === 0) {
                $("#ForgetPasswordForm_username").parent().next().html("<div id='ForgetPasswordForm_username-error' class='error'>请输入手机号码</div>");
                //domMobile.parent().addClass("error");
            } else if (!validatorMobile(mobile)) {
                $("#ForgetPasswordForm_username").parent().next().html("<div id='ForgetPasswordForm_username-error' class='error'>请输入正确的中国手机号码!</div>");
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
<div id="success" data-role="page" data-title="修改成功" data-nav-rel="#f-nav-account">
    <div data-role="content">
        <div>
            <h4 class="text-center">修改成功！</h4>
        </div>
        <br />
        <br />
        <div>
            <a id="confirmBtn" href="<?php echo $urlLogin; ?>" data-ajax="false" class="ui-btn">重新登录</a>
        </div>
    </div>
</div>

