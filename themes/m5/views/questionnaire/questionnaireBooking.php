<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formvalidate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/questionnaireBooking.js', CClientScript::POS_END);
?>
<?php
$this->setPageTitle('填写专家信息');
$booking = $this->createUrl('home/page', array('view' => 'booking'));
$urlBooking = $this->createUrl('booking/ajaxQuestionnaireCreate');
$source = Yii::app()->request->getQuery('source', 0);
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlAction = $this->createUrl('booking/ajaxQuestionnaireCreate');
$urlCompleteQuestionnaireView = $this->createUrl('questionnaire/completeQuestionnaireView');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    article{
        background-color: #f1f1f1;
    }
    .w18p{
        width: 18px;
    }
    .inputBar{
        background-color: #fff;
        border-radius: 5px;
        font-size: 15px;
    }
    .noPaddingInput{
        padding: 0px 10px!important;
        margin-bottom: 0px!important;
        border: none!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
        height: 30px!important;
        font-size: 15px;
    }
    .btn-sendSmsCode{
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 3px;
        display: block;
        padding-bottom: 2px;
        border-radius: 3px;
        background-color: #F48124!important;
        height: 50px;
        min-width: 8em;
        width: 100%;
        margin: 0 0!important;
    }
    .error{
        color: #f00;
    }
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">填写专家信息</h1>
</header>
<article class="active" data-scroll="true">
    <div id="doctorInf" class="pl10 pr10 pb20 pt20 font-s15 <?php echo $source == 1 ? '' : 'hide'; ?>">
        <div class="color-gray">
            请告诉我们您想预约的专家信息
        </div>
        <div class="grid inputBar mt10 pt10 pb10">
            <div class="col-0 pl10 pr10 pt3 br-gray">
                意向医生
            </div>
            <div class="col-1">
                <input type="text" name="expect_name" class="noPaddingInput" placeholder="请输入您想预约的专家姓名">
            </div>
        </div>
        <div class="grid inputBar mt10 pt10 pb10">
            <div class="col-0 pl10 pr10 pt3 br-gray">
                所在科室
            </div>
            <div class="col-1">
                <input type="text" name="expect_dept" class="noPaddingInput" placeholder="请输入该专家所在的科室名称">
            </div>
        </div>
        <div class="grid inputBar mt10 pt10 pb10">
            <div class="col-0 pl10 pr10 pt3 br-gray">
                所在医院
            </div>
            <div class="col-1">
                <input type="text" name="expect_hospital" class="noPaddingInput" placeholder="请输入该专家所在的医院名称">
            </div>
        </div>
        <div class="pt30">
            <a id="nextBooking" href="javascript:;" class="btn btn-green">填写完成</a>
        </div>
    </div>
    <div id="bookingView" class="pad10 font-s15 <?php echo $source == 0 ? '' : 'hide'; ?>">
        <?php
        $doctor = '';
        if (isset($data)) {
            $doctor = $data->results->doctor;
        }
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'booking-form',
            'htmlOptions' => array("enctype" => "multipart/form-data", "data-action-url" => $urlAction, 'data-return-url' => $urlCompleteQuestionnaireView),
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
        echo $form->hiddenField($model, 'doctor_id', array('name' => 'booking[id]', 'value' => $doctor == '' ? '' : $doctor->id));
        ?>
        <div class="br5 bg-white font-s16">
            <div class="grid bb-gray pad10">
                <div class="col-1">
                    已选专家
                </div>
                <div class="col-0">
                    <?php
                    if ($source == 1) {
                        ?>
                        <a id="modifyDoctor" href="javascript:;"><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146762518459118" class="w18p"></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="pad10">
                <div class="grid">
                    <div class="col-0 pt3">意向医生：</div>
                    <div class="col-1">
                        <?php echo $form->textField($model, 'doctor_name', array('name' => 'booking[doctor_name]', 'class' => 'noPaddingInput', 'readonly' => 'readonly', 'value' => $doctor == '' ? '' : $doctor->name)); ?>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-0 pt3">所在科室：</div>
                    <div class="col-1">
                        <?php echo $form->textField($model, 'hp_dept_name', array('name' => 'booking[hp_dept_name]', 'class' => 'noPaddingInput', 'readonly' => 'readonly', 'value' => $doctor == '' ? '' : $doctor->hpDeptName)); ?>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-0 pt3">所在医院：</div>
                    <div class="col-1">
                        <?php echo $form->textField($model, 'hospital_name', array('name' => 'booking[hospital_name]', 'class' => 'noPaddingInput', 'readonly' => 'readonly', 'value' => $doctor == '' ? '' : $doctor->hospitalName)); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-field-contain">
            <div class="grid inputBar mt10 pt10 pb10">
                <div class="col-0 pl10 pr10 pt3 br-gray w90p">
                    您的姓名
                </div>
                <div class="col-1">
                    <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'class' => 'noPaddingInput', 'placeholder' => '请输入您的姓名')); ?>
                </div>
            </div>
        </div>
        <div class="ui-field-contain">
            <div class="grid inputBar mt10 pt10 pb10">
                <div class="col-0 pl10 pr10 pt3 br-gray w90p">
                    手机号
                </div>
                <div class="col-1">
                    <?php echo $form->textField($model, 'mobile', array('name' => 'booking[mobile]', 'class' => 'noPaddingInput', 'placeholder' => '请输入您的手机号')); ?>
                </div>
            </div>
        </div>
        <div class="ui-field-contain">
            <div class="grid">
                <div class="col-1 grid inputBar mt10 pt10 pb10">
                    <div class="col-0 pl10 pr10 pt3 br-gray w90p">
                        验证码
                    </div>
                    <div class="col-1">
                        <?php echo $form->textField($model, 'verify_code', array('name' => 'booking[verify_code]', 'class' => 'noPaddingInput', 'placeholder' => '请输入验证码')); ?>
                    </div>
                </div>
                <div class="col-0 mt10 smsIcon font-s16">
                    <button id="btn-sendSmsCode" class="btn btn-sendSmsCode">获取验证码</button>
                </div>
            </div>
        </div>
        <?php
        $this->endWidget();
        ?>
        <div class="pt20">
            <button id="btnSubmit" class="btn btn-green">提交预约</button>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('#nextBooking').click(function () {
            var pageChange = true;
            $('#doctorInf').find('input').each(function () {
                if ($(this).val() == '') {
                    J.showToast('请补全信息', '', '1500');
                    pageChange = false;
                    return false;
                }
            });
            if (pageChange) {
                $('#booking_doctor_name').val($('input[name="expect_name"]').val());
                $('#booking_hp_dept_name').val($('input[name="expect_dept"]').val());
                $('#booking_hospital_name').val($('input[name="expect_hospital"]').val());
                $('#doctorInf').addClass('hide');
                $('title').html('预约单信息');
                $('.title').html('预约单信息');
                $('#bookingView').removeClass('hide');
            }
        });
        $('#modifyDoctor').click(function () {
            $('#doctorInf').find('input').each(function () {
                $(this).val('');
            });
            $('#bookingView').addClass('hide');
            $('title').html('填写专家信息');
            $('.title').html('填写专家信息');
            $('#doctorInf').removeClass('hide');
        });

        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });

        function checkCaptchaCode(domBtn) {
            var mobile = $("#booking_mobile").val();
            if (mobile.length === 0) {
                J.showToast('请输入手机号', '', '1500');
            } else if (mobile.length != 11) {
                J.showToast('请输入正确的手机号', '', '1500');
            } else {
                sendSmsVerifyCode(domBtn, mobile);
            }
        }

        function sendSmsVerifyCode(domBtn, mobile) {
            var domForm = $("#booking-form");
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
                    //console.log(data);
                    if (data.status === true) {
                        buttonTimerStart(domBtn, 60000);
                    } else {
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
    });
</script>