<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/booking.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formvalidate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/booking.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约医生');
$isCommonweal = Yii::app()->request->getQuery('is_commonweal', '0');
$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
//$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlUploadFile = 'http://121.40.127.64:8089/api/uploadbookingfile';
$urlReturn = $this->createUrl('order/view');
$urlAgreement = $this->createUrl('user/index', array('page' => 'aboutAgreement'));
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
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
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
<article id="bookingIos_article" class="active"  data-scroll="true">
    <div class="form-wrapper">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'booking-form',
            'htmlOptions' => array("enctype" => "multipart/form-data", 'data-actionUrl' => $urlSubmitForm, 'data-url-uploadFile' => $urlUploadFile, 'data-url-return' => $urlReturn),
            'enableClientValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnType' => true,
                'validateOnDelay' => 500,
                'errorCssClass' => 'error',
            ),
            'enableAjaxValidation' => false,
        ));
        echo $form->hiddenField($model, 'doctor_id', array('name' => 'booking[doctor_id]'));
        echo $form->hiddenField($model, 'is_commonweal', array('name' => 'booking[is_commonweal]', 'value' => $isCommonweal));
        ?>
        <div class="grid pt20 pb20 pl15 pr15 bb-gray">
            <div class="col-0 w100p color-black4">就诊专家:</div>
            <div class="col-1 text-right"><?php echo $model->doctor_name; ?></div>
        </div>
        <div class="grid pt20 pb20 pl15 pr15 bb-gray">
            <div class="col-0 w100p color-black4">就诊医院:</div>
            <div class="col-1 text-right"><?php echo $model->hospital_name; ?></div>
        </div>
        <div class="grid pt20 pb20 pl15 pr15 bb-gray">
            <div class="col-0 w100p color-black4">就诊科室:</div>
            <div class="col-1 text-right"><?php echo $model->hp_dept_name; ?></div>
        </div>
        <div class="bb10-gray"></div>
        <div class="ui-field-contain pl15 pr15 bb-gray">
            <div class="grid pt20 pb20">
                <div class="col-0 w90p color-black4">患者姓名:</div>
                <div class="col-1">
                    <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'maxlength' => 50, 'class' => 'text-right', 'placeholder' => '请输入患者姓名')); ?>
                </div>
            </div>
        </div>
        <div class="ui-field-contain pl15 pr15 bb-gray">
            <div class="grid pt20 pb20">
                <div class="col-0 w90p color-black4">病例名称:</div>
                <div class="col-1">
                    <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'maxlength' => 50, 'class' => 'text-right', 'placeholder' => '请输入疾病名称')); ?>
                </div>
            </div>
        </div>
        <div class="ui-field-contain pl15 pr15">
            <div class="grid pt20">
                <div class="col-0 w90p color-black4">疾病描述:</div>
            </div>
        </div>
        <div class="ui-field-contain pl15 pr15 bb-gray">
            <div class="col-1 pb20">
                <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'minlength' => 10, 'maxlength' => 1000, 'rows' => '6', 'placeholder' => '请你简要描述下您的病情')); ?>
            </div>
        </div>
        <div class="grid pt20 pb20 pl15 pr15">
            <div class="col-0 w90p color-black4">上传病例:</div>
            <div class="col-1 mr15">
            </div>
        </div>
        <?php
        $this->endWidget();
        ?>
        <div class="pl10 pr10 pb20">    
            <!--图片上传区域 -->
            <div id="uploader" class="uploader wu-example">
                <div class="imglist">
                    <ul class="filelist"></ul>
                </div>
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <!-- <p>或将照片拖到这里，单次最多可选10张</p>-->
                    </div>
                </div>
                <div class="statusBar" style="display:none; padding-bottom: 40px;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div>
                    <div class="info display-block"></div>
                    <div class="display-block pull-right">
                        <!-- btn 继续添加 -->
                        <div id="filePicker2" class=""></div>
                    </div>
                </div>
                <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
                <!--                         <div class="statusBar uploadBtn">提交</div>-->

            </div>
        </div>
        <!--                <div>
                        </div>-->
        <div class="login_form pb60 hide">
            <button id="" type="button" name="yt0" class="button yy-btn block mt10 bg-blue uploadBtn state-pedding">提交</button>
        </div>
    </div>
</article>
<script>
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
    });
</script>