<?php
Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/m/qiniu.base.min.1.0.css');
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/qiniu.base.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/bookingUpload.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("qiniu/ajaxBookingFile");
$urlReturn = $this->createUrl('order/view');
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
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
                <label for="uploaderCorp">上传病例</label>
                <div class="body mt10">
                    <div class="text-center">
                        <div id="container">
                            <a class="btn btn-default btn-lg" id="pickfiles" href="#">
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