<style type="text/css">    
    #btn-addfiles_wrap{position:relative;}
    #btn-addfiles_wrap input[type="file"]{position:absolute;top:0;left:0;line-height:36px;opacity:0;}
    #btn-addfiles_wrap>.btn:hover, #btn-addfiles:hover{cursor:pointer;}    
</style>
<?php
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'doctor-form',
    'htmlOptions' => array('class' => '', "enctype" => "multipart/form-data", 'data-ajax' => 'false'),
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


<div class="ui-field-contain">
    <label for="DoctorForm_mobile" class="">手机号:</label>
    <?php echo $form->textField($model, 'mobile', array('class' => '', 'maxlength' => 11, 'placeholder' => '请输入手机号')); ?>        
    <?php echo $form->error($model, 'mobile'); ?>
</div>
<div class="ui-field-contain verify_code">
    <label for="verify_code" class="">验证码:</label>
    <?php echo $form->textField($model, 'verify_code', array('class' => '', 'maxlength' => 6, 'autocomplete' => 'off', 'placeholder' => '请输入验证码')); ?>        
    <?php echo $form->error($model, 'verify_code'); ?>
    <button id="btn-sendSmsCode" class="ui-btn ui-corner-all ui-shadow">获取验证码</button>

</div>
<div class="ui-field-contain">
    <label for="password" class="">登录密码:</label>
    <?php echo $form->passwordField($model, 'password', array('class' => '', 'autocomplete' => 'off', 'maxlength' => 40, 'placeholder' => '4至20位英文或数字')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>
<div class="ui-field-contain">
    <label for="fullname" class="">姓名:</label>
    <?php echo $form->textField($model, 'fullname', array('class' => '', 'maxlength' => 45, 'placeholder' => '请输入真实姓名')); ?>                  
    <?php echo $form->error($model, 'fullname'); ?>        
</div>
<div class="ui-field-contain">
    <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>请选择您的性别：</legend>
        <?php
        $optionsGender = $model->loadOptionsGender();
        if (arrayNotEmpty($optionsGender)) {
            foreach ($optionsGender as $key => $option) {
                $id = "gender_" . $key;
                echo '<label for = ' . $id . '>' . $option . "</label>";
                if ($key == $model->gender) {
                    echo '<input type = "radio" name = "DoctorForm[gender]" id = ' . $id . ' value = "' . $key . '" checked>';
                } else {
                    echo '<input type = "radio" name = "DoctorForm[gender]" id = ' . $id . ' value = "' . $key . '">';
                }
            }
        }
        ?>            
    </fieldset>
    <?php echo $form->error($model, 'gender'); ?>
</div>
<div class="ui-field-contain">
    <label for="state_id" class="">选择省份:</label>
    <div class="ui-select">
        <?php
        echo $form->dropDownList($model, 'state_id', $model->loadOptionsState(), array(
            'prompt' => ' --选择省份 --',
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
    <div class="ui-field-contain">
        <label for="city_id" class="">选择城市:</label>
        <div class="ui-select">
            <?php
            echo $form->dropDownList($model, 'city_id', $model->loadOptionsCity(), array                   ( 'prompt'     => '-- 选择 --',
                'id' => 'DoctorForm_city_id'
                ));
                ?>
            </div>
            <?php echo $form->error($model, 'city_id'); ?>
        </div>

        <div class="ui-field-contain">
            <label for="mobile" class="">所属医院:</label>
            <?php echo $form->textField($model, 'hospital_name', array          ('class' => '', 'placeholder' => '您所在的医院名称')); ?>                    
    <?php echo $form->error($model, 'hospital_name'); ?>
</div>
<div class="ui-field-contain">
    <label for="mobile" class="">科室:</label>
    <?php echo $form->textField($model, 'faculty', array('class' => '', 'placeholder' => '您所在的科室名称')); ?>                    
    <?php echo $form->error($model, 'faculty'); ?>
</div>
<div class="ui-field-contain">
    <label for="medical_title" class="">医学职称:</label>
    <div class="ui-select">
        <?php
        echo $form->dropDownList($model, 'medical_title', $model->loadOptionsMedicalTitle(), array(
            'prompt' => '-- 选择医学职称 --',
        ));
        ?>
    </div>
    <?php echo $form->error($model, 'medical_title'); ?>
</div>
<div class="ui-field-contain">
    <label for="academic_title" class="">学术职称:</label>
    <div class="ui-select">
        <?php
        echo $form->dropDownList($model, 'academic_title', $model->loadOptionsAcademicTitle(), array(
            'prompt' => '-- 选择学术职称 --',
        ));
        ?>
    </div>
    <?php echo $form->error($model, 'academic_title'); ?>
</div>

<div class="ui-field-contain">
    <label for="btn-addfiles">医师资格证</label>
    <div>
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

<div class="ui-field-contain">          
    <label for="DoctorForm_terms">同意名医主刀<a class="" href="<?php echo $this->createUrl('site/page', array('view' => 'terms')); ?>" target="_blank">《在线服务条款》</a></label>  
    <?php echo $form->checkBox($model, 'terms', array('class' => '', 'value' => 1, 'checked' => true)); ?>
    <?php echo $form->error($model, 'terms'); ?>
</div>

<div class="ui-field-contain">
    <input id="btnSubmitEnquiry" class="btn-success" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
</div>
<?php $this->endWidget(); ?>
<br />
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            initForm();
        }, 200);

        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();            
            sendSmsVerifyCode($(this));
        });
    });

    function initForm() {
        var htmlstr = "<button class='ui-shadow ui-btn ui-corner-all ui-btn-icon-right ui-icon-plus' style='margin:0;'>添加文件</button>";
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