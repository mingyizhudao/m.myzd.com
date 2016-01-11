<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/coupon.js', CClientScript::POS_END);
?>
<?php
$this->setPageTitle('名医主刀');

$urlRegister = $this->createUrl("user/register");
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_DEFAULT;
$urlResImage = Yii::app()->theme->baseUrl . "/images";

$this->show_footer = false;
?>
<div id="section_container">
    <section id="login_section" data-init="true" class="active">
        <article id="expert_list_article" class="active"  data-scroll="true">
            <div class="w100 couponForm">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                'id' => 'coupon-form',
                'action' => $this->createUrl('coupon/ajaxCreate'),
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
                <ul class="list bg-none">
                    <li class="">
                        <div>请输入手机号码</div>
                        <?php echo $form->numberField($model, 'mobile', array('placeholder' => '输入手机号码')); ?>
                        <?php echo $form->error($model, 'mobile'); ?>
                        <div class="error"></div>
                    </li>
                    <li class="">
                        <div>请输入验证码</div>
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
                    <li class="">
                        <div>请输入劵码</div>
                        <div>
                            <?php echo $form->numberField($model, 'coupon_code', array('placeholder' => '请输入劵码')); ?>
                            <?php echo $form->error($model, 'coupon_code'); ?>
                        </div>
                        <div class="error"></div>
                    </li>
                    <li class="bb-none ml20 mr20 color-white">
<!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
                        <a id="btnSubmit" class="btn btn-yes btn-login bg-green">提交</a>
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
            </div>
        </article>
    </section>
    <script>
        $(document).ready(function () {
            $("#btn-sendSmsCode").click(function (e) {
                e.preventDefault();
                sendSmsVerifyCode($(this));
            });
        });
        function sendSmsVerifyCode(domBtn) {
            var domForm = $("#coupon-form");
            var domMobile = domForm.find("#WxCouponForm_mobile");
            var mobile = domMobile.val();
            if (mobile.length === 0) {
                $("#WxCouponForm_mobile-error").remove();
                $("#WxCouponForm_mobile").parents('li').append("<div id='WxCouponForm_mobile-error' class='error'>请输入手机号码</div>");
                //domMobile.parent().addClass("error");
            } else if (!validatorMobile(mobile)) {
                $("#WxCouponForm_mobile-error").remove();
                $("#WxCouponForm_mobile").parents('li').append("<div id='WxCouponForm_mobile-error' class='error'>请输入正确的中国手机号码!</div>");
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
</div>