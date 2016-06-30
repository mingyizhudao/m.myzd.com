<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/uploadMRFile.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
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
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$showStatus = Yii::app()->request->getQuery('showStatus', 0);
$urlReturn = $this->createUrl('booking/patientBookingList', array('status' => $showStatus));
$this->show_footer = false;
?>
<header class="bg-green" >
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
<article id="expert_list_article" class="active"  data-scroll="true">
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
                <div class="col-1 text-right"><?php echo $results->expertName == '' ? '未填写' : $results->expertName; ?></div>
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
        <li class="bb-none mb10">
            <div class="color-gray">疾病描述:</div>
            <div><?php echo $results->diseaseDetail; ?></div>
            <div class="grid mt15">
                <div class="col-0 w100p color-gray">影像资料:</div>
                <div class="col-1">
                </div>
            </div>
            <div id="imgList" class="mt10">
                <?php
                $files = $results->files;
                if (count($files) > 0) {
                    $n = floor(count($files) / 3);
                    for ($i = 0; $i < $n + 1; $i++) {
                        echo '<div class="grid">';
                        for ($j = 0; $j < 3; $j++) {
                            $num = $i * 3 + $j;
                            if ($num < count($files)) {
                                ?>
                                <div class="col-0 w33 text-center mt5">
                                    <img class="btn-img" src="<?php echo $files[$num]->absThumbnailUrl; ?>" data-img="<?php echo $files[$num]->absFileUrl; ?>">
                                </div>
                                <?php
                            }
                        }
                        echo '</div>';
                    }
                }
                ?>
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
            <div class="mt30">
                <!--图片上传区域 -->
                <div id="uploader" class="uploader wu-example">
                    <div class="imglist">
                        <ul class="filelist"></ul>
                    </div>
                    <div class="queueList nomargin">
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
                        <div class="ui-field-contain display-block mt50 clearfix">
                            <button id="btnSubmit" type="button" name="yt0" class="button yy-btn block mt10 btn-yes uploadBtn state-pedding font-s16">提交</button>
                        </div>
                    </div>
                    <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
                    <!--                         <div class="statusBar uploadBtn">提交</div>-->
                </div>
            </div>
            <?php
            $this->endWidget();
            ?>
        </li>
    </ul>
</article>
<script>
    $('.btn-img').tap(function () {
        var imgUrl = $(this).attr("data-img");
        J.popup({
            html: '<div class="imgpopup"><img src="' + imgUrl + '"></div>',
            pos: 'top-second',
            showCloseBtn: true
        });
    });
</script>