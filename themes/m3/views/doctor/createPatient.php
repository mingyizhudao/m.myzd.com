<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                                                  ?>	
<?php
/*
 * $model PatientForm.
 */
$this->setPageID('pCreatePatientMR');
$this->setPageTitle('创建患者');
?>
<style>
    #patientForm{margin: 15px 20px 0;}
    .ui-controlgroup-controls .ui-btn,.ui-controlgroup-controls .ui-btn:hover{color:#333;background-color: #f2f2f2;border-color: #f2f2f2;}
    .ui-controlgroup-controls .ui-radio{width: 50%;float: left;}
    .ui-radio .ui-btn.ui-radio-on:after{height: 18px;width: 18px;border-width: 6px;}
</style>
<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div>
            <form class="form-horizontal" enctype="multipart/form-data" data-ajax="false" method="post" id="patientForm" role="form">
                <div data-role="fieldcontain">
                    <div class="ui-field-contain">
                        <label for="state_id" class="ui-hidden-accessible">选择省份:</label>
                        <select name="PatientForm[state_id]" id="PatientForm_state_id">
                            <option value=""> --患者所在省份 --</option>
                            <option value="1">北京</option>
                            <option value="2">天津</option>
                            <option value="3">河北</option>
                            <option value="4">山西</option>
                            <option value="5">内蒙古</option>
                        </select>
                        <div class="errorMessage" id="PatientForm_state_id_em_" ></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="city_id" class="ui-hidden-accessible">选择城市:</label>
                        <select name="PatientForm[city_id]" id="PatientForm_city_id">
                            <option value=""> --患者所在城市 --</option>

                        </select>
                        <div class="errorMessage" id="PatientForm_city_id_em_" ></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="PatientForm_fullname" class="ui-hidden-accessible">患者姓名:</label>
                        <input type="text" name="PatientForm[fullname]" id="PatientForm_fullname" class="" placeholder="请输入患者姓名">
                        <div class="errorMessage" id="PatientForm_fullname_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="PatientForm_age" class="ui-hidden-accessible">患者年龄:</label>
                        <input type="number" name="PatientForm[age]" id="PatientForm_age" class="" placeholder="请输入患者年龄">
                        <div class="errorMessage" id="PatientForm_age_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="booking_dis" class="ui-hidden-accessible">患者性别:</label>
                        <div class="ui-controlgroup-controls pl30">
                            <fieldset data-role="controlgroup">
                                <input type="radio" name="PatientForm[gender]" id="man" value="1"/>
                                <label for="man">男</label>
                                <input type="radio" name="PatientForm[gender]" id="feman" value="0"/>
                                <label for="feman">女</label>
                            </fieldset>
                        </div>
                        <div class="errorMessage" id="PatientForm_gender_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <input id="btnSubmit" class="btn-success statusBar uploadBtn state-pedding" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="创建患者">
                    </div>
                </div>
            </form>
        </div>

        <div class="mt30"></div>
    </div>  	
</div>
