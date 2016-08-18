<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/vendor/webuploader.custom.1.0.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/booking.min.1.1.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = 'http://file.mingyizhudao.com/api/uploadbookingfile';
$urlReturn = $this->createUrl('order/view');
$this->show_footer = false;
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
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<footer>
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16">预约</button>
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
            <div class="grid pt20 pb20">
                <div class="col-0 w90p color-black4">上传病例:</div>
                <div class="col-1 mr15">
                </div>
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