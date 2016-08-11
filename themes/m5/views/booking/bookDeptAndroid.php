<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCreateAndroid.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCreateAndroid.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/bootstrap.min.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/main.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/highlight.css');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/plupload.full.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/zh_CN.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/ui.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/qiniu.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/highlight.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/jquery-1.9.1.min.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/qiniu.base.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/qiniu.base.min.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formvalidate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/bookingUpload.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约科室');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("qiniu/ajaxBookingFile");
$urlReturn = $this->createUrl('order/view');
$urlAgreement = $this->createUrl('user/index', array('page' => 'aboutAgreement'));
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$this->show_footer = false;
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//成功到达预约单页面
$SITE_8 = PatientStatLog::SITE_8;
$SITE_9 = PatientStatLog::SITE_9;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
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
<article id="bookingAndroid_article" class="active android_article"  data-scroll="true">
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
        echo $form->hiddenField($model, 'hp_dept_id', array('name' => 'booking[hp_dept_id]'));
        ?>
        <input type="hidden" id="booking_id" value="">
        <input type="hidden" id="salesOrderRefNo" value="">
        <input type="hidden" id="domain" value="http://mr.file.mingyizhudao.com">
        <input type="hidden" id="uptoken_url" value="<?php echo $urlQiniuAjaxToken; ?>">
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
        <?php
        $this->endWidget();
        ?>
        <div class="pt20 pl15 pr15 pb20 ui-field-contain">
            <div class="">
                <label for="uploaderCorp">请选择病历</label>
                <div class="body mt10">
                    <div class="text-center">
                        <div id="container">
                            <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                                <span>选择影像资料</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 mt10">
                        <table class="table table-striped table-hover text-left" style="display:none">
                            <tbody id="fsUploadProgress">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="login_form mt40 pb60 hide">
            <button id="btnSubmit" type="button" name="yt0" class="button yy-btn block mt10 bg-blue uploadBtn state-pedding">提交</button>
        </div>
    </div>
</article>
<div id="loading_popup" style="" class="loading">
    <i class="icon spinner"></i>
    <p>加载中...</p>
</div>
<div id="jingle_toast" class="mobileTip toast"><a href="#">网络异常，请稍后上传</a></div>
<script>
     function bookStat(keyword){
              $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_8; ?>', 'stat[key_word]':keyword},
                success: function (data) {

                }
            });
     }
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
        bookStat('预约科室页面');
    });
</script>