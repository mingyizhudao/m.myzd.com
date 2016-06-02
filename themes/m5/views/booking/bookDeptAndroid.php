<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/ajaxfileupload.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCreateAndroid.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formvalidate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/ajaxfileupload.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCreateAndroid.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlReturn = $this->createUrl('order/view');
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
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<footer>
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16">预约</button>
</footer>
<article id="bookingAndroid_article" class="active"  data-scroll="true">
    <style>
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
    </style>
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
        <div class="grid pt20 pb20 bb-gray">
            <div class="col-0 w100p pl15 color-black4">就诊医院:</div>
            <div class="col-1"><?php echo $model->hospital_name; ?></div>
        </div>
        <div class="grid pt20 pb20 bb-gray">
            <div class="col-0 w100p pl15 color-black4">就诊科室:</div>
            <div class="col-1"><?php echo $model->hp_dept_name; ?></div>
        </div>
        <div class="bb10-gray"></div>

        <div class="pl15">
            <div class="ui-field-contain bb-gray">
                <div class="grid pt20 pb20">
                    <div class="col-0 w90p color-black4">患者姓名:</div>
                    <div class="col-1 mr15">
                        <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'maxlength' => 50)); ?>
                    </div>
                </div>
            </div>
            <div class="ui-field-contain bb-gray">
                <div class="grid pt20 pb20">
                    <div class="col-0 w90p color-black4">病例名称:</div>
                    <div class="col-1 mr15">
                        <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'maxlength' => 50)); ?>
                    </div>
                </div>
            </div>
            <div class="ui-field-contain">
                <div class="grid pt20">
                    <div class="col-0 w90p color-black4">疾病描述:</div>
                </div>
            </div>
            <div class="ui-field-contain bb-gray">
                <div class="col-1 mr15 pb20">
                    <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'minlength' => 10, 'maxlength' => 1000, 'rows' => '6')); ?>
                </div>
            </div>
        </div>
        <?php
        $this->endWidget();
        ?>
        <div class="pt20 pl15 pr15 pb20 ui-field-contain">
            <div class="">
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
        </div>
        <!--                <div>
                        </div>-->
        <div class="login_form mt40 pb60 hide">
            <button id="btnSubmit" type="button" name="yt0" class="button yy-btn block mt10 bg-blue uploadBtn state-pedding">提交</button>
        </div>
    </div>
</article>
<div id="loading_popup" style="" class="loading">
    <i class="icon spinner"></i>
    <p>加载中...</p>
</div>
<script>
    Zepto(function ($) {
        $('#booking-form #booking_date_start').tap(function () {
            J.popup({
                html: '<div id="popup_calendar"></div>',
                pos: 'center',
                backgroundOpacity: 0.4,
                showCloseBtn: false,
                onShow: function () {
                    new J.Calendar('#popup_calendar', {
                        date: new Date(),
                        onSelect: function (date) {
                            $("#booking_date_start").val(date);
                            J.closePopup();
                        }
                    });
                }
            });
        });
        $('#booking-form #booking_date_end').tap(function () {
            var dataStart = $("#booking_date_start").val();
            var nowDate = new Date();
            dataStart = dataStart ? getStartTiem(dataStart, 6) : nowDate;
            J.popup({
                html: '<div id="popup_calendar"></div>',
                pos: 'center',
                backgroundOpacity: 0.4,
                showCloseBtn: false,
                onShow: function () {
                    new J.Calendar('#popup_calendar', {
                        date: new Date(dataStart),
                        onSelect: function (date) {
                            $("#booking_date_end").val(date);
                            J.closePopup();
                        }
                    });
                }
            });
        });
    });
    //根据开始时间返回结束时间， +days天
    function getStartTiem(date, days) {
        var timestamp = new Date(date).getTime();
        var newDate = new Date(timestamp + days * 24 * 3600 * 1000);
        var y = newDate.getFullYear(), m = newDate.getMonth() + 1, d = newDate.getDate();
        m = (m < 10) ? ('0' + m) : m;
        d = (d < 10) ? ('0' + d) : d;
        return y + '-' + m + '-' + d;
    }
</script>