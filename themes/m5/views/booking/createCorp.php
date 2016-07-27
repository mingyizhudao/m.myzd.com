<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCorpPatient.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCorp.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formvalidate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCorpPatient.min.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCorp.min.js?ts=' . time(), CClientScript::POS_END);
/*
 * $model BookQuickForm.
 */
$this->setPageTitle('企业员工快速预约');
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlSubmitForm = $this->createUrl("booking/ajaxCreateCorp");
//$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlUploadFile = 'http://file.mingyizhudao.com/api/uploadbookingfile';
$urlUplaodCorpFile = $this->createUrl('booking/ajaxUploadCorp');
$urlUserValiCaptcha = $this->createUrl("user/valiCaptcha");
$urlReturn = $this->createUrl('home/view');
$urlAgreement = $this->createUrl('user/index', array('page' => 'aboutAgreement'));
$this->show_footer = false;
?>
<header class="bg-green">
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
</header>
<footer class="agreement_footer">
    <div class="w100">
        <div class="text-center pt5">
            <label for="agreement">
                <input id="agreement" type="checkbox" class="h14p">
                <span class="pl5">我已同意</span>
            </label>
            <a href="<?php echo $urlAgreement; ?>" class="color-green">名医主刀服务协议</a>
        </div>
        <button id="btnSubmit" type="button" class="button buttonSubmit font-s16" disabled="true">预约</button>
    </div>
</footer>
<article id="createCop_article" class="active"  data-scroll="true">
    <style>
        .optional{display:none;padding-bottom: 10px;}
        .optional input{background-color: #f6e5a0;}
        .optional-btn{background-color: #48aeab;color: #fff;font-size: 18px;margin: 0px 20px 0px 10px;border-bottom: 1px solid rgba(0,0,0,.1);padding: 15px 0;}
        .uploader .filelist div.file-panel span.cancel{display: block;width: auto;height: auto;background: 0;text-indent:0;float: none;color: #fff;margin: 0;padding: 5px 0;}
    </style>
    <div class="form-wrapper">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'booking-form',
            'htmlOptions' => array("enctype" => "multipart/form-data", 'data-actionUrl' => $urlSubmitForm, 'data-url-uploadFile' => $urlUploadFile, 'data-url-return' => $urlReturn, 'data-url-uploadCorp' => $urlUplaodCorpFile, 'data-checkCode' => $urlUserValiCaptcha),
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
        echo $form->hiddenField($model, 'bk_type', array('name' => 'booking[bk_type]'));
        echo $form->hiddenField($model, 'bk_status', array('name' => 'booking[bk_status]'));
        ?> 
        <ul class="list pb30">
            <li>
                <?php echo CHtml::activeLabel($model, 'corporate_name'); ?>                                           
                <select name="booking[corporate_name]" id="booking_corporate_name">
                    <option value>选择企业名称</option>
                    <option value="滴滴出行">滴滴出行</option>
                    <option value="阿里健康">阿里健康</option>
                    <option value="其他">其他</option>
                </select>
                <?php echo $form->error($model, 'corporate_name'); ?> 
            </li>
            <li class="corp">
                <label for="uploaderCorp">请上传一张企业工牌照片</label>
                <div id="uploaderCorp" class="uploader">
                    <div class="queueList">
                        <div id="dndArea" class="placeholder">
                            <!-- btn 选择图片 -->
                            <div id="filePicker3">&nbsp;选择图片</div>
                        <!-- <p>或将照片拖到这里，单次最多可选10张</p>-->
                            <ul class="filelistCorp"></ul>
                        </div>
                    </div>
                    <div class="statusBar clearfix" style="display:none;">
                        <div class="progress" style="display: none;">
                            <span class="text">0%</span>
                            <span class="percentage" style="width: 0%;"></span>
                        </div>
                        <div class="info">共0张（0B），已上传0张</div>
                        <div class="">
                            <!-- btn 继续添加 -->
                            <div id="filePicker4" class="pull-right"></div>                          

                        </div>
                    </div>
                </div>
            </li>
            <li>
                <?php echo CHtml::activeLabel($model, 'corp_staff_rel'); ?>  
                <select name="booking[corp_staff_rel]" id="booking_corp_staff_rel">
                    <option value>选择与患者的关系</option>
                    <option value="本人">本人</option>
                    <option value="父母">父母</option>
                    <option value="妻子/丈夫">妻子/丈夫</option>
                    <option value="子女">子女</option>
                    <option value="其他直系亲属">其他直系亲属</option>
                </select>
                <?php echo $form->error($model, 'gender'); ?>
            </li>
            <li>
                <?php echo CHtml::activeLabel($model, 'contact_name'); ?>                                           
                <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'placeholder' => '请输入患者姓名')); ?>
                <?php echo $form->error($model, 'contact_name'); ?> 
            </li>

            <li>
                <div id="captchaCode" class="grid">
                    <div class="col-1 w50">
                        <div>请输入图形验证码</div>
                        <input type="text" id="booking_captcha_code" name="booking[captcha_code]" placeholder="请输入图形验证码">
                    </div>
                    <div class="col-1 w50 pt20">
                        <!--<button id="btn-sendSmsCode" type="button" class="w100 bg-green border-r3">获取验证码</button>-->
                        <a href="javascript:void(0);"><img id="vailcode" class="h40p" src="" onclick="this.src = '<?php echo $this->createUrl('user/getCaptcha'); ?>/' + Math.random()"></a>
                    </div>
                </div>
            </li>

            <li>
                <?php echo CHtml::activeLabel($model, 'mobile'); ?>                                           
                <?php echo $form->numberField($model, 'mobile', array('name' => 'booking[mobile]', 'placeholder' => '请输入手机号')); ?>
                <?php echo $form->error($model, 'mobile'); ?> 
                <button id="btn-sendSmsCode" class="btn btn-sendSmsCode ui-corner-all ui-shadow">获取短信验证码</button>
            </li>
            <li>
                <?php echo CHtml::activeLabel($model, 'verify_code'); ?>                                           
                <?php echo $form->numberField($model, 'verify_code', array('name' => 'booking[verify_code]', 'placeholder' => '请输入验证码')); ?>
                <?php echo $form->error($model, 'verify_code'); ?> 
            </li>

            <div class="text-center optional-btn">
                <div class="ui-icon-carat-d ui-btn-icon-right">填写医院信息（可选填）</div>
            </div>

            <div class="optional list">
                <li>
                    <?php echo CHtml::activeLabel($model, 'hospital_name'); ?>                                           
                    <?php echo $form->textField($model, 'hospital_name', array('name' => 'booking[hospital_name]', 'placeholder' => '请输入医院名称，可不填')); ?>
                    <?php echo $form->error($model, 'hospital_name'); ?> 
                </li>
                <li>
                    <?php echo CHtml::activeLabel($model, 'hp_dept_name'); ?>                                           
                    <?php echo $form->textField($model, 'hp_dept_name', array('name' => 'booking[hp_dept_name]', 'placeholder' => '请输入科室名称，可不填')); ?>
                    <?php echo $form->error($model, 'hp_dept_name'); ?> 
                </li>
                <li>
                    <?php echo CHtml::activeLabel($model, 'doctor_name'); ?>                                           
                    <?php echo $form->textField($model, 'doctor_name', array('name' => 'booking[doctor_name]', 'placeholder' => '请输入医生姓名，可不填')); ?>
                    <?php echo $form->error($model, 'doctor_name'); ?> 
                </li>
            </div>
            <li>
                <?php echo CHtml::activeLabel($model, 'disease_name'); ?>                                           
                <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'placeholder' => '请填写确诊疾病')); ?>
                <?php echo $form->error($model, 'disease_name'); ?> 
            </li>
            <li>
                <?php echo CHtml::activeLabel($model, 'disease_detail'); ?>                                           
                <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'placeholder' => '请尽可能详细的描述患者的病情', 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'disease_detail'); ?> 
            </li>
            <li>
                <label for="uploaderCorp">请选择病历</label>
                <?php echo $this->renderPartial('_uploadFile'); ?>
            </li>
        </ul>
        <?php
        $this->endWidget();
        ?>
    </div>
</article>
<div id="jingle_toast" class="corpTip toast"><a href="#">请选择企业工牌照片</a></div>
<div id="jingle_toast" class="mobileTip toast"><a href="#">请填写手机号</a></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="checkbox"]').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $('#btnSubmit').attr('disabled', 'true');
            } else {
                $(this).addClass('active');
                $('#btnSubmit').removeAttr('disabled');
            }
        });
        
        vailcode();
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });
        $(".optional-btn").click(function () {
            var state = $(".optional").is(':visible');
            if (state) {
                $(".optional").hide();
            } else {
                $(".optional").show();
            }
        });
    });
    function vailcode() {
        $("#vailcode").attr("src", "<?php echo $this->createUrl('user/getCaptcha'); ?>/" + Math.random());
    }
    function checkCaptchaCode(domBtn) {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();
        var captchaCode = $('#booking_captcha_code').val();
        if (mobile.length === 0) {
            //$("#booking_mobile_em_").text("请输入手机号码").show();
            //domMobile.parent().addClass("error");
            $(".mobileTip").show();
            setTimeout(function () {
                $(".mobileTip").hide();
            }, 1000);
        } else if (domMobile.hasClass("error")) {
            // mobile input field as error, so do nothing.
        } else if (captchaCode == '') {
            $('#booking_captcha_code-error').remove();
            $('#captchaCode').after('<div id="booking_captcha_code-error" class="error">请填写图形验证码</div>');
        } else {
            $('#booking_captcha_code-error').remove();
            var domForm = $('#booking-form');
            var formdata = domForm.serializeArray();
            //check图形验证码
            $.ajax({type: 'post',
                url: '<?php echo $urlUserValiCaptcha; ?>?co_code=' + captchaCode,
                data: formdata,
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'ok') {
                        sendSmsVerifyCode(domBtn, mobile, captchaCode);
                    } else {
                        $('#captchaCode').after('<div id="booking_captcha_code-error" class="error">' + data.error + '</div>');
                    }
                }
            });
        }
    }

    function sendSmsVerifyCode(domBtn, mobile, captchaCode) {
        $domForm = $("#booking-form");
        var actionUrl = $domForm.find("input[name='smsverify[actionUrl]']").val();
        var actionType = $domForm.find("input[name='smsverify[actionType]']").val();
        var formData = new FormData();
        formData.append("AuthSmsVerify[mobile]", mobile);
        formData.append("AuthSmsVerify[actionType]", actionType);

        $.ajax({
            type: 'post',
            url: actionUrl + '?captcha_code=' + captchaCode,
            data: formData,
            dataType: "json",
            processData: false, contentType: false,
            'success': function (data) {
                if (data.status === true) {
                    buttonTimerStart(domBtn, 60000);
                    //domForm[0].reset();
                }
                else {
                    console.log(data);
                    if (data.errors.captcha_code != undefined) {
                        $('#captchaCode').after('<div id="booking_captcha_code-error" class="error">' + data.errors.captcha_code + '</div>');
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
</script>
