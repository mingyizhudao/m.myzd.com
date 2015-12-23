<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                             ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pCreateBooking');
$this->setPageTitle('疾病信息');
$urlLogin = $this->createUrl('doctor/login');
?>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/demo.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/dist/jquery.validate.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/phpBooking.js', CClientScript::POS_END);
?>
<style>
    .patientinfo span{padding: 0 9px;}
    .border-right{border-right: 1px solid #888;}
    .ui-grid-b .ui-block-a,.ui-grid-b .ui-block-c{width: 45%;}
    .ui-grid-b .ui-block-b{width: 10%;padding: 14px 0;text-align: center;}
</style>
<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div>
            <form class="form-horizontal" method="post" id="booking-form" role="form">
                <div data-role="fieldcontain">
                    <div class="ui-field-contain">
                        <label for="booking_info" class="patientinfo">
                            <span>患者基本信息：</span><span class="patientname">王力宏</span><span class="patientage border-right">19岁</span><span class="patientgender border-right">男</span><span class="patientcity">上海</span>
                        </label>
                    </div>
                    <div class="ui-field-contain">
                        <label for="booking_star_date" class="">意向就诊时间:</label>
                        <div class="ui-grid-b">
                            <div class="ui-block-a">
                                <input type="date" name="booking[star_date]" id="booking[star_date]" value="" class="ui-input-text ui-body-c">
                                <div class="errorMessage" id="booking_star_date_em_" style=""></div>
                            </div>
                            <div class="ui-block-b">
                                ----
                            </div>
                            <div class="ui-block-c">
                                <input type="date" name="booking[end_date]" id="booking[end_date]" value="" class="ui-input-text ui-body-c">
                                <div class="errorMessage" id="booking_end_date_em_" style=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="booking_dis" class="">疾病诊断:</label>
                        <input type="text" name="booking[dis]" id="booking_dis" class="" placeholder="请输入疾病诊断">
                        <div class="errorMessage" id="booking_dis_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="booking_patient_condition" class="">病史描述:</label>
                        <div>
                            <textarea name="booking[patient_condition]" id="booking_patient_condition" placeholder="请输入病史描述"></textarea>
                        </div>
                        <div class="errorMessage" id="booking_patient_condition_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="booking_patient_condition" class="">影像资料:</label>
                        <div class="">    
                            <!--图片上传区域 -->
                            <div id="uploader" class="wu-example">
                                <div class="queueList">
                                    <div id="dndArea" class="placeholder">
                                        <div id="filePicker"></div>
<!--                                            <p>或将照片拖到这里，单次最多可选10张</p>-->
                                    </div>
                                </div>
                                <div class="statusBar" style="display:none;">
                                    <div class="progress">
                                        <span class="text">0%</span>
                                        <span class="percentage"></span>
                                    </div>
                                    <div class="info"></div>
                                    <div class="btns">
                                        <div id="filePicker2"></div>
                                        <!--                                            <div class="uploadBtn">提交</div>-->
                                        <div class="ui-field-contain">
                                            <input id="btnSubmit" class="btn-success statusBar uploadBtn state-pedding" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
                                        </div>
                                    </div>
                                </div>
                                <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
                                <!--                                    <div class="statusBar uploadBtn">提交</div>-->
                            </div>

                        </div>
                    </div>

                </div>
            </form>
            <a id="toTip" class="hide" href="#tipPage" data-rel="dialog">提示页</a>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>
<div data-role="page" id="tipPage" data-title="错误提示" data-close-btn="right">
    <div data-role="header">
        <h1>错误提示</h1>
    </div>

    <div data-role="content">
        <p>文件添加失败</p>
        <a href="javascript:;" data-role="button" data-rel="back" >确 定</a> 
    </div>
</div> 
