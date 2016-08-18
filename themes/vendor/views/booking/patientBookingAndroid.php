<?php
Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/vendor/qiniu.base.min.1.0.css');
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/qiniu.base.min.1.0.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/patientBookingUpload.min.1.0.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageTitle('预约详情');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$results = $data->results;
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("qiniu/ajaxBookingFile");
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$urlReturn = $this->createUrl('booking/patientBookingList', array('status' => 0));
$userId = Yii::app()->session['userId'];
//$urlBookingFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $user->id . '&bookingId=' . $results->id;
$urlBookingFiles = 'http://121.40.127.64:8089/api/loadbookingmr?userId=' . $userId . '&bookingId=' . $results->id;
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
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<article id="expert_list_article" class="active android_article"  data-scroll="true">
    <ul class="list">
        <li class="color-green">预约号:<?php echo $results->refNo; ?></li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">患者姓名:</div>
                <div class="col-1"><?php echo $results->patientName; ?></div>
            </div>
        </li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">联系方式:</div>
                <div class="col-1"><?php echo $results->mobile; ?></div>
            </div>
        </li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">就诊医院:</div>
                <div class="col-1 w-div"><?php echo $results->hospitalName == '' ? '未填写' : $results->hospitalName; ?></div>
            </div>
        </li>
        <li class="nopadding h15p"></li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">就诊科室:</div>
                <div class="col-1 w-div"><?php echo $results->hpDeptName == '' ? '未填写' : $results->hpDeptName; ?></div>
            </div>
        </li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">就诊专家:</div>
                <div class="col-1 w-div"><?php echo $results->expertName == '' ? '未填写' : $results->expertName; ?></div>
            </div>
        </li>
        <li class="nopadding h15p"></li>
        <li>
            <div class="grid">
                <div class="col-0 w100p">病例名称:</div>
                <div class="col-1"><?php echo $results->diseaseName; ?></div>
            </div>
        </li>
        <li class="bb-none mb10">
            <div class="grid">
                <div class="col-0 w100p">病例描述:</div>
                <div class="col-1"><?php echo $results->diseaseDetail; ?></div>
            </div>
            <div class="grid mt15">
                <div class="col-0 w100p">影像资料:</div>
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
            <div class="pt20 pl15 pr15 pb20 ui-field-contain">
                <div class="">
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
            <?php
            $this->endWidget();
            ?>
            <div id="imgbtn">
                <a id="submitBtn" class="btn btn-yes btn-abs hide">提交</a>
            </div>
        </li>
    </ul>
</article>
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