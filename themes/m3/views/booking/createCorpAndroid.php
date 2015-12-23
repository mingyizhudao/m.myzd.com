<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/dist/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/ajaxfileupload.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCorpAndroid.js', CClientScript::POS_END);
/*
 * $model BookQuickForm.
 */
$this->setPageID('pcreateCorpAndroid');
$this->setPageTitle('企业员工快速预约');
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_BOOKING;
$urlSubmitForm = $this->createUrl("booking/ajaxCreateCorp");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlUplaodCorpFile = $this->createUrl('booking/ajaxUploadCorp');
$urlReturn = '#success';
?>

<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>">
    <div data-role="content">
        <style>
            .btn {display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;}
            .btn-primary {color: #fff!important;background-color: #428bca;border-color: #357ebd;}
            .uploadfile .ui-input-text{border: 0;box-shadow: 0 0 0 #fff;}
            .uploadfile .ui-body-inherit{border-color: #fff;}
            .uploadfile .ui-focus{box-shadow: 0 0 0 #fff;}
            .uploadfile{padding-top: 20px;}
            .uploadfile:before{content: '选择文件';padding: 10px 15px;font-size: 14px;background-color: #428bca;color: #fff;border-radius: 5px;}
            .uploadfile{position:relative;}
            .uploadfile input[type="file"]{position:absolute;top:5px;right:35%;width:30%;line-height:36px;opacity:0;}
            .uploadfile .btn:hover, #btn-addfiles:hover{cursor:pointer;}
            .MultiFile-list{margin: 10px;}
            .MultiFile-list .MultiFile-label{margin: 3px 0;}
            .MultiFile-list .MultiFile-label .MultiFile-remove{color: #f00;font-size: 16px;padding-right: 10px;text-decoration: initial;}
            .optional{display:none; border-bottom: 1px solid #a9dadf;padding-bottom: 10px;}
            .optional input{background-color: #f6e5a0;}
            .optional-btn{background-color: #48aeab;color: #fff;font-size: 18px;margin-top: 10px;}
            .error {color: #E21E1A;}
        </style>
        <div class="form-wrapper">
            <div class="ui-field-contain">
                <label for="BookCorpForm_corporate_name">企业名称</label>                                           
                <select name="booking[corporate_name]" id="booking_corporate_name_show">
                    <option value>选择企业名称</option>
                    <option value="滴滴出行">滴滴出行</option>
                    <option value="阿里健康">阿里健康</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="mt20">
                <label for="uploaderCorp">请上传一张企业工牌照片</label>
                <div class="corp uploadfile mt10 text-center">
                    <?php
                    $this->widget('CMultiFileUpload', array(
                        //'model' => $model,
                        'attribute' => 'file',
                        'id' => "btn-addcorpfiles",
                        'name' => 'file', //$_FILES['BookingFiles'].
                        'accept' => 'jpeg|jpg|png',
                        'options' => array(),
                        'denied' => '请上传jpg、png格式',
                        'duplicate' => '该文件已被选择',
                        'max' => 1, // max 1 files
                        //'htmlOptions' => array(),
                        'value' => '上传病历',
                        'selected' => '已选文件',
                            //'file'=>'文件'
                    ));
                    ?>
                </div>
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'booking-form',
                'htmlOptions' => array("enctype" => "multipart/form-data", 'data-actionUrl' => $urlSubmitForm, 'data-url-uploadFile' => $urlUploadFile, 'data-url-return' => $urlReturn, 'data-url-uploadCorpFile' => $urlUplaodCorpFile),
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
            <div class="ui-field-contain">
                <?php echo $form->hiddenField($model, 'corporate_name', array('name' => 'booking[corporate_name]', 'placeholder' => '请输入企业名称')); ?>
                <?php echo $form->error($model, 'corporate_name'); ?> 
            </div>
            <div class="ui-field-contain">   
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
            </div>
            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'contact_name'); ?>                                           
                <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'placeholder' => '请输入患者姓名')); ?>
                <?php echo $form->error($model, 'contact_name'); ?> 
            </div>
            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'mobile'); ?>                                           
                <?php echo $form->numberField($model, 'mobile', array('name' => 'booking[mobile]', 'placeholder' => '请输入手机号')); ?>
                <?php echo $form->error($model, 'mobile'); ?> 
                <button id="btn-sendSmsCode" type="button" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>
            </div>
            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'verify_code'); ?>                                           
                <?php echo $form->numberField($model, 'verify_code', array('name' => 'booking[verify_code]', 'placeholder' => '请输入验证码')); ?>
                <?php echo $form->error($model, 'verify_code'); ?> 
            </div>
            <div class="ui-field-contain text-center optional-btn">
                <div class="ui-icon-carat-d ui-btn-icon-right">填写医院信息（可选填）</div>
            </div>
            <div class="optional">
                <div class="ui-field-contain">
                    <?php echo CHtml::activeLabel($model, 'hospital_name'); ?>                                           
                    <?php echo $form->textField($model, 'hospital_name', array('name' => 'booking[hospital_name]', 'placeholder' => '请输入医院名称，可不填')); ?>
                    <?php echo $form->error($model, 'hospital_name'); ?> 
                </div>
                <div class="ui-field-contain">
                    <?php echo CHtml::activeLabel($model, 'hp_dept_name'); ?>                                           
                    <?php echo $form->textField($model, 'hp_dept_name', array('name' => 'booking[hp_dept_name]', 'placeholder' => '请输入科室名称，可不填')); ?>
                    <?php echo $form->error($model, 'hp_dept_name'); ?> 
                </div>
                <div class="ui-field-contain">
                    <?php echo CHtml::activeLabel($model, 'doctor_name'); ?>                                           
                    <?php echo $form->textField($model, 'doctor_name', array('name' => 'booking[doctor_name]', 'placeholder' => '请输入医生姓名，可不填')); ?>
                    <?php echo $form->error($model, 'doctor_name'); ?> 
                </div>
            </div>
            <div class="ui-field-contain mt20">
                <?php echo CHtml::activeLabel($model, 'disease_name'); ?>                                           
                <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'placeholder' => '请填写确诊疾病')); ?>
                <?php echo $form->error($model, 'disease_name'); ?> 
            </div>
            <div class="ui-field-contain">
                <?php echo CHtml::activeLabel($model, 'disease_detail'); ?>                                           
                <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'placeholder' => '请尽可能详细的描述患者的病情', 'maxlength' => 1000)); ?>
                <?php echo $form->error($model, 'disease_detail'); ?> 
            </div>
            <?php
            $this->endWidget();
            ?>
            <div class=" mt20 patient">
                <label for="uploaderCorp">请选择病历</label>
                <div class="uploadfile text-center mt10">
                    <?php
                    $this->widget('CMultiFileUpload', array(
                        //'model' => $model,
                        'attribute' => 'file',
                        'id' => "btn-addfiles",
                        'name' => 'file', //$_FILES['BookingFiles'].
                        'accept' => 'jpeg|jpg|png',
                        'options' => array(),
                        'denied' => '请上传jpg、png格式',
                        'duplicate' => '该文件已被选择',
                        'max' => 8, // max 8 files
                        //'htmlOptions' => array(),
                        'value' => '上传病历',
                        'selected' => '已选文件',
                            //'file'=>'文件'
                    ));
                    ?>
                </div>
            </div>
            <div class="ui-field-contain">                
                <button id="btnSubmit" type="button" name="yt0">提交</button>
            </div>
        </div>
        <div id="errorConfirm" class="confirmPage">
            <div class="text-center confirmcontent">
                <h4>提示</h4>
                <div class="divider row"></div>
                <h4 class="errorinfo mt20"></h4>
                <div class="mt20"><a class="btn btn-yes cancel">确认</a></div>
            </div>
        </div>
    </div>  
    <!-- popup error message -->
    <a id="triggerPopupError" class="hide" href="#popupError" data-rel="popup" data-position-to="window"></a>
    <div data-role="popup" id="popupError" class="error-popup ui-content">
        <p class="error"></p>
    </div> 
</div>
<div id="success" class="" data-role="page" data-title="提交成功">
    <div data-role="content">
        <div>
            <h4>提交成功！</h4>
            <h4>我们的工作人员会尽快联系您。</h4>
        </div>
        <!--
        <br />
        <br />
        <div>
            <a href="<?php echo $this->createUrl('home/index'); ?>" data-ajax="false" class="ui-btn">返回首页</a>
        </div>
        -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            sendSmsVerifyCode($(this));
        });
        $(".confirmPage .cancel").click(function () {
            $(".confirmPage").hide();
        });
        $(".optional-btn").click(function () {
            var state = $(".optional").is(':visible');
            if (state) {
                $(".optional-btn .ui-btn-icon-right").removeClass("ui-icon-carat-u").addClass("ui-icon-carat-d");
            } else {
                $(".optional-btn .ui-btn-icon-right").removeClass("ui-icon-carat-d").addClass("ui-icon-carat-u");
            }
            $(".optional").slideToggle();
        });
        $("#booking_corporate_name_show").change(function () {
            corporate_name = $(this).val();
            if (corporate_name) {
                $("#booking_corporate_name").val(corporate_name);
                $(this).parents(".ui-field-contain").find("div.error").text("");
            } else {
                $("#booking_corporate_name").val("");
                $("#booking_corporate_name_show").parents(".ui-field-contain").find("div.error").remove();
                $(this).parent().after("<div class='error'>请填写医生企业名称</div> ");
            }
        });
    });
    function sendSmsVerifyCode(domBtn) {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            //$("#booking_mobile_em_").text("请输入手机号码").show();
            //domMobile.parent().addClass("error");
            showErrorPopup('请输入手机号码', '#popupError', '#triggerPopupError');
        } else if (domMobile.hasClass("error")) {
            // mobile input field as error, so do nothing.
        } else {
            buttonTimerStart(domBtn, 60000);
            $domForm = $("#booking-form");
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
</script>
