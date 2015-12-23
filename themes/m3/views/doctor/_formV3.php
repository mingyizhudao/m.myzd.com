<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
?>
<!--<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-multiselect.css">-->

<style type="text/css">
    #btn-addfiles_wrap{position:relative;}
    #btn-addfiles_wrap input[type="file"]{position:absolute;top:0;left:0;width:204px;line-height:36px;opacity:0;}
    #btn-addfiles_wrap>.btn:hover, #btn-addfiles:hover{cursor:pointer;}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'doctor-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'htmlOptions' => array('class' => "form-horizontal", 'role' => 'form', 'autocomplete' => 'off', "enctype" => "multipart/form-data"),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnType' => true,
        'validateOnDelay' => 500,
        'errorCssClass' => 'error',
    ),
    'enableAjaxValidation' => true,
        ));
echo CHtml::hiddenField("smsverify[actionUrl]", $urlGetSmsVerifyCode);
echo CHtml::hiddenField("smsverify[actionType]", $authActionType);
?>
<div class="hide">
    <input  class="hide" type="text" />
    <input class="hide"  type="password" />
</div>

<div class="form-group">    
    <label class="col-sm-3 control-label" for="DoctorForm_mobile">手机<span class="required">*</span></label>
    <div class="col-sm-9">
        <?php echo $form->textField($model, 'mobile', array('class' => 'form-control', "maxlength" => 11, 'placeholder' => '请输入手机号')); ?>        
        <?php echo $form->error($model, 'mobile'); ?>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">验证码<span class="required">*</span></label>
    <div class="col-sm-9 controls">
        <div class="input-group">
            <?php echo $form->textField($model, 'verify_code', array('class' => 'form-control', 'maxlength' => 6)); ?>
            <div id="btn-sendSmsCode" class="btn input-group-addon  btn-verifycode">获取验证码</div>
        </div>
        <?php echo $form->error($model, 'verify_code'); ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '4至20位英文或数字')); ?>                    
        <?php echo $form->error($model, 'password'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'fullname', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'placeholder' => '请输入真实姓名')); ?>                  
        <?php echo $form->error($model, 'fullname'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'gender', array('class' => 'col-sm-3 control-label')); ?>    
    <div class="col-sm-9">
        <?php
        $optionsGender = $model->loadOptionsGender();
        if (emptyArray($optionsGender) === false) {
            echo '<div class="checkbox-groups">';
            foreach ($optionsGender as $key => $option) {
                echo '<label class="radio-inline">';
                if ($key == $model->gender) {
                    echo '<input type="radio" name="DoctorForm[gender]" value="' . $key . '" checked>';
                } else {
                    echo '<input type="radio" name="DoctorForm[gender]" value="' . $key . '">';
                }
                echo $option . '</label>';
            }
            echo '</div>';
        }
        ?>
        <?php echo $form->error($model, 'gender'); ?>
    </div>
    <div class="clearfix"></div>
</div>





<div class="form-group">
    <?php echo $form->labelEx($model, 'state_id', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-3">
        <div class="styled-select">
            <?php
            echo $form->dropDownList($model, 'state_id', $model->loadOptionsState(), array(
                'prompt' => '-- 选择 --',
                'class' => 'sel form-control',
                'ajax' => array(
                    'type' => 'get',
                    'url' => $this->createAbsoluteUrl('/region/loadCities'),
                    'data' => array('state' => 'js:this.value'),
                    'update' => '#DoctorForm_city_id',
                )
            ));
            ?>
        </div>  
        <?php echo $form->error($model, 'state_id'); ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'city_id', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-3">
        <div class="styled-select">
            <?php
            echo $form->dropDownList($model, 'city_id', $model->loadOptionsCity(), array(
                'prompt' => '-- 选择 --',
                'class' => 'sel form-control',
                'id' => 'DoctorForm_city_id'
            ));
            ?>
        </div>  
        <?php echo $form->error($model, 'city_id'); ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'hospital_name', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model, 'hospital_name', array('class' => 'form-control', 'placeholder' => '您所在的医院名称')); ?>                    
        <?php echo $form->error($model, 'hospital_name'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'faculty', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model, 'faculty', array('class' => 'form-control', 'placeholder' => '您所在的科室名称')); ?>                    
        <?php echo $form->error($model, 'faculty'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'medical_title', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-3">
        <div class="styled-select">
            <?php
            echo $form->dropDownList($model, 'medical_title', $model->loadOptionsMedicalTitle(), array(
                'prompt' => '-- 选择 --',
                'class' => 'sel form-control',
            ));
            ?>
        </div>
        <?php echo $form->error($model, 'medical_title'); ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'academic_title', array('class' => 'col-sm-3 control-label')); ?>
    <div class="col-sm-3">
        <div class="styled-select">
            <?php
            echo $form->dropDownList($model, 'academic_title', $model->loadOptionsAcademicTitle(), array(
                'prompt' => '-- 选择 --',
                'class' => 'sel form-control',
            ));
            ?>
        </div>
        <?php echo $form->error($model, 'academic_title'); ?>
    </div>
    <div class="clearfix"></div>
</div>


<div class="form-group">    
    <label class="col-sm-3 control-label" for="DoctorForm_DoctorFiles">医师资格证</label>
    <div class="col-sm-9">
        <?php
        $this->widget('CMultiFileUpload', array(
            'model' => $model,
            'attribute' => 'files',
            'id' => "btn-addfiles",
            'name' => 'DoctorFiles',
            'accept' => 'jpg|gif|png',
            //"accept" => "image/*",
            'options' => array(
            //'onFileSelect' => 'function(e, v, m){ alert("onFileSelect - "+v) }',
            //'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
            //'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
            // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
            // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
            // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
            ),
            'denied' => '请上传jpg、png、gif格式',
            'duplicate' => '该文件已被选择',
            'max' => 3, // max 10 files
            //'htmlOptions' => array(),
            'value' => '上传证件',
            'selected' => '已选文件',
                //'file'=>'文件'
        ));
        ?>

    </div>
</div>

<?php if ($model->scenario == 'register') { ?>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox pull-left">
                <label class="radio-label">
                    <?php echo $form->checkBox($model, 'terms', array('class' => 'radio-checkbox', 'value' => 1, 'checked' => true)); ?>同意名医主刀<a class="nostyle" href="<?php echo $this->createUrl('site/page', array('view' => 'terms')); ?>" target="_blank">《在线服务条款》</a>
                </label>
            </div>
            <div class="clearfix"></div>
            <?php echo $form->error($model, 'terms'); ?>
        </div>
    </div>
<?php } ?>

<div class="form-group mt50">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo CHtml::submitButton("注册", array("class" => "btn btn-yes btn-lg btn-block")); ?>        		
    </div>
</div>
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/multiple-select-master/jquery.multiple.select.js', CClientScript::POS_END);
?>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            initForm();
        }, 200);

        $("#btn-sendSmsCode").click(function () {
            sendSmsVerifyCode($(this));
        });
    });

    function initForm() {
        var htmlstr = "<a class='btn btn-primary btn-wide'><i class='fa fa-plus'></i>&nbsp;添加文件</a>";
        $("#btn-addfiles_wrap").css("position", "relative").prepend(htmlstr).find("input[type='file']").attr("capture", "camera");
        //console.log($("#btn-addfiles_wrap").html());
    }

    function sendSmsVerifyCode(domBtn) {
        var domMobile = $("#DoctorForm_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            $("#DoctorForm_mobile_em_").text("请输入手机号码").show();
            domMobile.parent().addClass("error");
        } else if (domMobile.parent().hasClass("error")) {
            // mobile input field as error, so do nothing.
        } else {
            buttonTimerStart(domBtn, 60000);
            $domForm = $("#doctor-form");
            var actionUrl = $domForm.find("input[name='smsverify[actionUrl]']").val();
            var actionType = $domForm.find("input[name='smsverify[actionType]']").val();
            var formData = new FormData();
            formData.append("AuthSmsVerify[mobile]", mobile);
            formData.append("AuthSmsVerify[actionType]", actionType);

            $.ajax({
                type: 'post',
                url: actionUrl,
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                'success': function (data) {
                    if (data.status === true) {
                        //domForm[0].reset();
                    }
                    else {
                        console.log(data);
                    }
                },
                'error': function (data) {
                    console.log(data);
                },
                'complete': function () {
                }
            });
        }
    }
    function buttonTimerStart(domBtn, timer) {
        timer = timer / 1000 //convert to second.
        var interval = 1000;
        var timerTitle = '秒后重发';
        domBtn.attr("disabled", true);
        domBtn.html(timer + timerTitle);

        timerId = setInterval(function () {
            timer--;
            if (timer > 0) {
                domBtn.html(timer + timerTitle);
            } else {
                clearInterval(timerId);
                timerId = null;
                domBtn.html("重新发送");
                domBtn.attr("disabled", false);
            }
        }, interval);
    }
</script>