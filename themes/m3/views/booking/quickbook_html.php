<?php // Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                          ?>	
<?php
/*
 * $model ContactEnquiryForm.
 */
$this->setPageID('pQuickBooking');
$this->setPageTitle('快速预约');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>">
    <div data-role="content">
        <div class="form-wrapper">
            <form class="" method="post" id="contact-enquiry-form" role="form">
                <div data-role="fieldcontain">
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_hopital" class="">医院:</label>
                        <input type="text" name="ContactEnquiryForm[hopital]" id="ContactEnquiryForm_hopital" class="" placeholder="请输入医院">
                        <div class="errorMessage" id="ContactEnquiryForm_hopital_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_faculty" class="">科室:</label>
                        <input type="text" name="ContactEnquiryForm[faculty]" id="ContactEnquiryForm_faculty" class="" placeholder="请输入科室">
                        <div class="errorMessage" id="ContactEnquiryForm_faculty_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_doctor" class="">医生:</label>
                        <input type="text" name="ContactEnquiryForm[doctor]" id="ContactEnquiryForm_doctor" class="" placeholder="请输入医生">
                        <div class="errorMessage" id="ContactEnquiryForm_doctor_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_patientname" class="">患者姓名:</label>
                        <input type="text" name="ContactEnquiryForm[patientname]" id="ContactEnquiryForm_patientname" class="" placeholder="请输入患者姓名">
                        <div class="errorMessage" id="ContactEnquiryForm_patientname_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_mobile" class="">手机号:</label>
                        <input type="number" name="ContactEnquiryForm[mobile]" id="ContactEnquiryForm_mobile" class="" placeholder="请输入手机号">
                        <div class="errorMessage" id="ContactEnquiryForm_mobile_em_" style=""></div>
                        <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_verify_code" class="">验证码:</label>
                        <input type="number" name="ContactEnquiryForm[verify_code]" id="ContactEnquiryForm_verify_code" class="" placeholder="请输入验证码">
                        <div class="errorMessage" id="ContactEnquiryForm_verify_code_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="ContactEnquiryForm_patient_condition" class="">病情描述:</label>
                        <div>
                            <textarea name="ContactEnquiryForm[patient_condition]" id="ContactEnquiryForm_patient_condition" class="" placeholder="请输入病情描述"></textarea>
                        </div>
                        <div class="errorMessage" id="ContactEnquiryForm_patient_condition_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <?php echo $this->renderPartial('_uploadfile'); ?>
                    </div>
                    <div class="ui-field-contain">
                        <input id="btnSubmit" class="btn-success uploadBtn" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
                    </div>
                </div>
            </form>
        </div>
    </div>  

</div>
