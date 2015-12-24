<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/patientBookingAndroid.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/ajaxfileupload.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/jquery.form.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$results = $data->results;
$urlSubmitForm = $this->createUrl("booking/ajaxCreate");
$urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
$urlReturn = $this->createUrl('booking/patientBookingList');
$this->show_footer = false;
?>
<style>
    .uploadfile{padding-top: 20px;}
    .uploadfile:before{content: '选择文件';padding: 10px 15px;font-size: 14px;background-color: #19aea5;color: #fff;border-radius: 5px;}
    .uploadfile{position:relative;}
    .uploadfile input[type="file"]{position:absolute;top:5px;right:35%;width:30%;line-height:36px;opacity:0;}
    .MultiFile-list{margin-top: 10px;}
    .MultiFile-list .MultiFile-label .MultiFile-remove{color: #f00;font-size: 16px;padding-right: 10px;text-decoration: initial;}
    .btn-yes{display: none;}
</style>
<div id="section_container">
    <section id="orderdetail_section" data-init="true" class="active">
        <header class="head-title1" >
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back" style="color:#fff;"></a>
            </nav>
            <div class="title1">
                <span>预约单详情</span>
            </div>
        </header>
        <article id="expert_list_article" class="active"  data-scroll="true">
            <ul class="list">
                <li class="border-green color-green">预约号:<?php echo $results->refNo; ?></li>
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
                        <div class="col-0 w-div"><?php echo $results->hospitalName == '' ? '未填写' : $results->hospitalName; ?></div>
                    </div>
                </li>
                <li class="nopadding h15p"></li>
                <li>
                    <div class="grid">
                        <div class="col-0 w100p">就诊科室:</div>
                        <div class="col-0 w-div"><?php echo $results->hpDeptName == '' ? '未填写' : $results->hpDeptName; ?></div>
                    </div>
                </li>
                <li>
                    <div class="grid">
                        <div class="col-0 w100p">就诊专家:</div>
                        <div class="col-0 w-div"><?php echo $results->expertName == '' ? '未填写' : $results->expertName; ?></div>
                    </div>
                </li>
                <li>
                    <div class="grid">
                        <div class="col-0 w100p">意向就诊日期:</div>
                        <div class="col-0 w-div">
                            <?php
                            if (!$results->dateStart || !$results->dateEnd) {
                                echo '未填写';
                            } else {
                                echo $results->dateStart . '至' . $results->dateEnd;
                            }
                            ?>
                        </div>
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
                        <div class="col-0">
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
                    <div class="uploadfile text-center mt20">
                        <?php
                        $this->widget('CMultiFileUpload', array(
                            //'model' => $model,
                            'attribute' => 'file',
                            'id' => "btn-addfiles",
                            'name' => 'file', //$_FILES['BookingFiles'].
                            'accept' => 'jpeg|jpg|png',
                            'options' => array(
                                'afterFileSelect' => 'function(e, v, m){ var inputCount = $(".MultiFile-applied").length;if (inputCount == 0) {$("#btnSubmit").removeClass("btn-block");} else {$("#btnSubmit").addClass("btn-block");} }',
                                //'onFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                                //'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                                // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                                // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                                'afterFileRemove' => 'function(e, v, m){ var inputCount = $(".MultiFile-applied").length - 1;if (inputCount == 0) {$("#btnSubmit").removeClass("btn-block");} else {$("#btnSubmit").addClass("btn-block");} }',
                            ),
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
                    <?php
                    $this->endWidget();
                    ?>
                    <div id="imgbtn">
                        <a id="btnSubmit" class="btn btn-yes btn-abs">提交</a>
                    </div>
                </li>
            </ul>
        </article>
    </section>
</div>
<script>
    $('.btn-img').click(function () {
        var imgUrl = $(this).attr("data-img");
        J.popup({
            html: '<div class="imgpopup"><img src="' + imgUrl + '"></div>',
            pos: 'top-second',
            showCloseBtn: true
        });
    });
</script>