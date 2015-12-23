<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/booking.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlReturn = $this->createUrl('order/view');
$this->show_footer = false;
?>
<div id="section_container">
    <!--明星团队-->
    <section id="reserve_expert_section" class="active">
        <header class="head-title1">
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="title1">预约单</div>
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
                echo $form->hiddenField($model, 'doctor_id', array('name' => 'booking[doctor_id]'));
                ?>
                <div class="grid pt10 pb10 bb-gray">
                    <div class="col-0 w100p pl10">就诊专家:</div>
                    <div class="col-0"><?php echo $model->doctor_name; ?></div>
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
                <div class="pt10 pl10 pr10 bb-gray">
                    <div>意向就诊日期:<span class = "color-red">(日期至少间隔7天)</span></div>
                    <div class="grid">
                        <div class="col-1 w45 ui-field-contain">
                            <?php echo $form->textField($model, 'date_start', array('name' => 'booking[date_start]', 'class' => 'calendar')); ?>
                        </div>
                        <div class="col-1 w10 text-center mt10">
                            至
                        </div>
                        <div class="col-1 w45 ui-field-contain">
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
                <div class="pl10 pr10">    
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
                <div class="login_form pb60">
                    <button id="btnSubmit" type="button" name="yt0" class="button yy-btn block mt10 bg-blue uploadBtn state-pedding">提交</button>
                </div>
            </div>
        </article>
    </section>
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
        var startdate = [newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate()].join('-');
        return startdate;
    }
</script>