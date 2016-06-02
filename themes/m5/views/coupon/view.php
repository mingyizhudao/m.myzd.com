<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/coupon.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js', CClientScript::POS_END);
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
        <article id="hongbao" class="active" data-scroll="true">
            <div class="w100 pt-90 bg couponForm">
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
                    <li class="bb-none">
                        <?php echo $form->numberField($model, 'mobile', array('placeholder' => '请输入手机号')); ?>
                        <?php echo $form->error($model, 'mobile'); ?>
                        <div class="error"></div>
                    </li>
                    <li class="bb-none">
                        <div class="grid">
                            <div class="col-1">
                                <?php echo $form->numberField($model, 'verify_code', array('placeholder' => '请输入验证码')); ?>
                            </div>
                            <div class="col-0 pl5 pr10"></div>
                            <div class="col-0">
                                <button id="btn-sendSmsCode" class="btn btn-sendSmsCode ui-corner-all ui-shadow bg-green color-white">获取验证码</button>
                            </div>
                        </div>
                        <?php echo $form->error($model, 'verify_code'); ?>
                        <div class="error"></div>
                    </li>
                    <li class="bb-none">
                        <div>
                            <?php echo $form->numberField($model, 'coupon_code', array('placeholder' => '请输入专属邀请码')); ?>
                            <?php echo $form->error($model, 'coupon_code'); ?>
                        </div>
                        <div class="error"></div>
                    </li>
                    <li class="bb-none">
                        <div class="grid pt5 pb5">
                            <div class="col-1"></div>
                            <div id="activityRule" class="text-center activity">活动说明</div>
                            <div class="col-1"></div>
                        </div>
                    </li>
                    <li class="bb-none ml20 mr20 color-white pb30">
<!--                            <input id="btnSubmit" class="btn btn-yes btn-block" type="button" data-ajax="false"  name="yt0" value="登录/注册"> -->
                        <div class="">
                            <button id="btnSubmit" class="btn btn-abs btn-login img-btn"><img src="<?php echo $urlResImage; ?>/hongbao/btn-hongbao.png"></button>
                        </div>
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
            </div>
        </article>
        <article id="successHongbao" class="" data-scroll="true">
            <div class="success pt-140">
                <div class="grid mt10 pb20">
                    <div class="col-1"></div>
                    <div class="col-0 w80">
                        <a href="tel://4006277120" class="color-black">
                            <img src="<?php echo $urlResImage; ?>/hongbao/telephone-hongbao.png">
                        </a>
                    </div>
                    <div class="col-1"></div>
                </div>
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

        $('#activityRule').tap(function () {
            var innerHtml = '<div class="bg-red color-white1">' +
                    '<div class="pb20 ml10 mr10">' +
                    '<div class="text-right color-yellow1 pt5 font-s14">' +
                    '<span data-target="closePopup">收起<img src="<?php echo $urlResImage; ?>/hongbao/wire.png"></span>' +
                    '</div>' +
                    '<div class="grid mt10 mb10">' +
                    '<div class="col-1"></div>' +
                    '<div class="w60"><img src="<?php echo $urlResImage; ?>/hongbao/rule-hongbao.png"></div>' +
                    '<div class="col-1"></div>' +
                    '</div>' +
                    '<div class="mt20 font-s12">' +
                    '<div>1.本券为一次性使用券，不找零、不兑现、不开发票</div>' +
                    '<div>2.本券仅可用于抵用预约名医主刀签约医生手术的服务费用</div>' +
                    '<div>3.每次预约只能使用一张抵用券，不能累计使用</div>' +
                    '<div>4.手机号为红包领用的唯一凭证，使用时向客服报出手机号即可</div>' +
                    '<div>5.本活动最终解释权归名医主刀所有</div>' +
                    '<div>6.代金券有效期:2016.01.01~2016.12.31</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            J.popup({
                html: innerHtml,
                pos: 'bottom',
                showCloseBtn: false
            })
        });
    </script>
</div>