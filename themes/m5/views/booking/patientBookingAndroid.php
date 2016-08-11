<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/patientBookingAndroid.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/bootstrap.min.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/main.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/highlight.css');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/plupload.full.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/zh_CN.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/ui.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/qiniu.min.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/highlight.js?ts=' . time(), CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/jquery-1.9.1.min.js?ts=' . time(), CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/jquery.formvalidate.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/m/qiniu.base.min.1.0.css');
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/qiniu.base.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/patientBookingUpload.min.1.0.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('查看详情');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$results = $data->results;
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("qiniu/ajaxBookingFile");
$showStatus = Yii::app()->request->getQuery('showStatus', 0);
$urlReturn = $this->createUrl('booking/patientBookingList', array('status' => $showStatus));
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$user = $this->loadUser();
//$urlBookingFiles = 'http://192.168.31.118/file.myzd.com/api/loadbookingmr?userId=' . $user->id . '&bookingId=' . $results->id;
$urlBookingFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $user->id . '&bookingId=' . $results->id;
$this->show_footer = false;
?>

<header class="bg-green" >
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">查看详情</h1>
    <nav class="right">
        <a id="submitBtn" class="hide">
            保存
        </a>
    </nav>
</header>
<article id="patientBookingAndroid_article" class="active android_article"  data-scroll="true">
    <div>
        <ul class="list">
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">患者姓名:</div>
                    <div class="col-1 text-right"><?php echo $results->patientName; ?></div>
                </div>
            </li>
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">联系方式:</div>
                    <div class="col-1 text-right"><?php echo $results->mobile; ?></div>
                </div>
            </li>
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">就诊专家:</div>
                    <div class="col-1 text-right"><?php echo $results->expertName == '' ? $results->doctorName : $results->expertName; ?></div>
                </div>
            </li>
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">就诊医院:</div>
                    <div class="col-1 text-right"><?php echo $results->hospitalName == '' ? '未填写' : $results->hospitalName; ?></div>
                </div>
            </li>
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">就诊科室:</div>
                    <div class="col-1 text-right"><?php echo $results->hpDeptName == '' ? '未填写' : $results->hpDeptName; ?></div>
                </div>
            </li>
            <li>
                <div class="grid">
                    <div class="col-0 w100p color-gray">疾病名称:</div>
                    <div class="col-1 text-right"><?php echo $results->diseaseName; ?></div>
                </div>
            </li>
            <li>
                <div class="color-gray">疾病描述:</div>
                <div><?php echo $results->diseaseDetail; ?></div>
            </li>
        </ul>
        <div class="pt10 pl10 pr10 pb50">
            <div class="grid">
                <div class="col-0 w100p color-gray">影像资料:</div>
                <div class="col-1">
                </div>
            </div>
            <div id="imglist" class="mt10">

            </div>
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
            ?>
            <input id="booking_id" type="hidden" name="booking[booking_id]" value="<?php echo $results->id; ?>" />
            <input type="hidden" id="domain" value="http://mr.file.mingyizhudao.com">
            <input type="hidden" id="uptoken_url" value="<?php echo $urlQiniuAjaxToken; ?>">
            <div class="body mt10">
                <div class="col-md-12 mt10">
                    <table class="table table-striped table-hover text-left" style="display:none">
                        <tbody id="fsUploadProgress">
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <div id="container">
                        <a class="btn btn-default btn-lg btnFile" id="pickfiles" href="#" >
                            <span>添加资料</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $this->endWidget();
            ?>
            <div id="imgbtn">
                <a id="btnSubmit" class="btn btn-yes btn-abs hide">提交</a>
            </div>
        </div>
    </div>
</article>
<div id="jingle_toast" class="mobileTip toast"><a href="#">网络异常，请稍后上传</a></div>
<script>
    $(document).ready(function () {
        //加载病人病历图片
        var urlBookingFiles = "<?php echo $urlBookingFiles; ?>";
        $.ajax({
            url: urlBookingFiles,
            success: function (data) {
                setImgHtml(data.results.files);
            }
        });
    });

    function setImgHtml(imgfiles) {
        var innerHtml = '';
        if (imgfiles && imgfiles.length > 0) {
            var n = Math.ceil((imgfiles.length) / 3);
            for (var i = 0; i < n; i++) {
                innerHtml += '<div class="grid">';
                for (var j = 0; j < 3; j++) {
                    var num = i * 3 + j;
                    if (num < (imgfiles.length)) {
                        innerHtml += '<div class="col-0 w33 text-center mt5">' +
                                '<img class="btn-img" src="' + imgfiles[num].absFileUrl + '" data-img="' + imgfiles[num].thumbnailUrl + '">' +
                                '</div>';
                    }
                }
                innerHtml += '</div>';
            }
        } else {
            innerHtml += '';
        }
        $("#imglist").html(innerHtml);
        $('.btn-img').click(function () {
            var imgUrl = $(this).attr("data-img");
            J.popup({
                html: '<div class="imgpopup"><img src="' + imgUrl + '"></div>',
                pos: 'top-second',
                showCloseBtn: true
            });
        });
    }
</script>