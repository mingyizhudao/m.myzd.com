<?php
header("Content-Type: text/html; charset=utf-8");

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/demo.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/dist/jquery.validate.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/phpBooking.js', CClientScript::POS_END);
?>
<?php
$urlCreateBooking = $this->createAbsoluteUrl("/booking/testCreate");
$urlUploadFile = $this->createAbsoluteUrl("/booking/uploadFile");
?>
<div id="pBooking" data-role="page" data-title="快速预约" data-add-back-btn="true" data-back-btn-text="返回"  data-nav-rel="#f-nav-enquiry">

    <div data-role="content" class="ui-content">
        <section class="m-panel sect-form">
            <div>
                <form class="form-horizontal" data-actionUrl="<?php echo $urlCreateBooking; ?>" data-url-uploadFile="<?php echo $urlUploadFile; ?>" method="post" id="booking-form" role="form">
                    <div data-role="fieldcontain">
                        <div class="ui-field-contain">
                            <label for="booking_name" class="">手机号:</label>
                            <input type="text" name="booking[name]" id="booking_name" class="" placeholder="请输入就诊人姓名">
                            <div class="errorMessage" id="booking_name_em_" style=""></div>
                        </div>
                        <div class="ui-field-contain">
                            <label for="booking_name" class="">身份证号:</label>
                            <input type="text" name="booking[idcard]" id="booking_idcard" class="" placeholder="请输入身份证号">
                            <div class="errorMessage" id="booking_idcard_em_" style=""></div>
                        </div>
                        <div class="ui-field-contain">
                            <label for="booking_team" class="">专家团队:</label>
                            <input type="text" name="booking[team]" id="booking_team" class="" value="" placeholder="" readonly>
                            <div class="errorMessage" id="booking_team_em_" style=""></div>
                        </div>
                        <!--                        <div class="ui-field-contain">
                                                    <label for="booking_doctor" class="">医生:</label>
                                                    <input type="text" name="booking[doctor]" id="booking_doctor" class="" value="许建屏" placeholder="" readonly>
                                                    <div class="errorMessage" id="booking_doctor_em_" style=""></div>
                                                </div>-->
                        <div class="ui-field-contain">
                            <div>为了专家更好地诊断，我们建议您上传完整清晰的检查报告和影像资料。</div>
                            <div class="mt10 color-red">（可后期补充：个人中心-预约单-预约单详情)</div>
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
                                        </div>
                                    </div>
                                    <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
                                    <!--                                    <div class="statusBar uploadBtn">提交</div>-->
                                </div>

                            </div>
                        </div>
                        <div class="ui-field-contain">
                            <input id="btnSubmitEnquiry" class="btn-success statusBar uploadBtn state-pedding" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade" id="tipModal" tabindex="-1" role="dialog" aria-labelledby="tipModallLabel">
                <div class="modal-dialog mt20" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">错误提示</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="form-result-success" class="ui-content" data-role="popup" style="display:none;color:#fff;background-color:rgba(0, 0, 0, 0.75);">
            <p>提交成功！</p><p>我们的名医助手会在第一时间与您确认预约的详情。</p>
        </div>
    </div>
</div>
