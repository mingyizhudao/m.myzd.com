<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/bookingCreateAndroid.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/ajaxfileupload.js', CClientScript::POS_END);
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
<style>
    .uploadfile{padding-top: 20px;}
    .uploadfile:before{content: '选择文件';padding: 10px 15px;font-size: 14px;background-color: #428bca;color: #fff;border-radius: 5px;}
    .uploadfile{position:relative;}
    .uploadfile input[type="file"]{position:absolute;top:5px;right:35%;width:30%;line-height:36px;opacity:0;}
    .MultiFile-list{margin-top: 10px;}
    .MultiFile-list .MultiFile-label .MultiFile-remove{color: #f00;font-size: 16px;padding-right: 10px;text-decoration: initial;}
</style>
<div id="section_container">
    <!--明星团队-->
    <section id="reserve_expert_section" class="active">
        <header class="head-title1">
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="title1"><?php echo $this->pageTitle; ?></div>
        </header>

        <article id="expert_list_article" class="active"  data-scroll="true">
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
                echo $form->hiddenField($model, 'expteam_id', array('name' => 'booking[expteam_id]'));
                ?>

                <div class="grid pt10 pb10 bb-gray">
                    <div class="col-0 w100p pl10">就诊专家:</div>
                    <div class="col-0"><?php echo $model->expteam_name; ?></div>
                </div>
                <div class="grid pt10 pb10 bb-gray">
                    <div class="col-0 w100p pl10">就诊科室:</div>
                    <div class="col-0"><?php echo $model->hp_dept_name; ?></div>
                </div>
                <div class="grid pt10 pb10 bb-gray">
                    <div class="col-0 w100p pl10">就诊医院:</div>
                    <div class="col-0"><?php echo $model->hospital_name; ?></div>
                </div>
                <div class = "border10-gray"></div>
                <div class="pt10 pl10 pr10 bb-gray ui-field-contain">
                    <div>患者姓名:</div>
                    <div>
                        <?php echo $form->textField($model, 'contact_name', array('name' => 'booking[contact_name]', 'maxlength' => 50)); ?>
                    </div>
                </div>
                <div class="pt10 pl10 pr10 bb-gray ui-field-contain">
                    <div>意向就诊日期:<span class = "color-red">(日期至少间隔7天)</span></div>
                    <div class="grid">
                        <div class="col-1 w45">
                            <?php echo $form->textField($model, 'date_start', array('name' => 'booking[date_start]', 'class' => 'calendar')); ?>
                        </div>
                        <div class="col-1 w10 text-center mt10">
                            至
                        </div>
                        <div class="col-1 w45">
                            <?php echo $form->textField($model, 'date_end', array('name' => 'booking[date_end]', 'class' => 'calendar')); ?>
                        </div>
                    </div>
                </div>
                <div class="pt10 pl10 pr10 bb-gray ui-field-contain">
                    <div>病例名称:</div>
                    <div>
                        <?php echo $form->textField($model, 'disease_name', array('name' => 'booking[disease_name]', 'maxlength' => 50)); ?>
                    </div>
                </div>
                <div class="pt10 pl10 pr10 ui-field-contain">
                    <div>疾病描述:</div>
                    <div>
                        <?php echo $form->textArea($model, 'disease_detail', array('name' => 'booking[disease_detail]', 'maxlength' => 1000, 'rows' => '6')); ?>
                    </div>
                </div>
                <?php
                $this->endWidget();
                ?>
                <div class="uploadfile text-center mt20">
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
                <!--                <div>
                                </div>-->
                <div class="login_form pb60">
                    <button id="btnSubmit" type="button" name="yt0" class="button yy-btn block mt10 bg-blue uploadBtn state-pedding">提交</button>
                </div>
            </div>
        </article>
    </section>
</div>
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
        var y  = newDate.getFullYear(),m = newDate.getMonth()+1,d = newDate.getDate();
        m = (m<10)?('0'+m):m;
        d = (d<10)?('0'+d):d;
        return y + '-' + m + '-' + d;
    }
</script>