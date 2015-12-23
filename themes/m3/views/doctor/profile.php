<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                                   ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pDoctorRegister');
$this->setPageTitle('医生认证');
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

<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <?php
        if ($this->hasFlashMessage("doctor.success")) {
            $this->renderPartial("_success");
        } else {
            ?>
            <!--
                <div class="border-bottom">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="reg-header">医生注册</div>
                        </div>
                        <div class="pull-right mt20">
                            <a class="" href="<?php echo $this->createUrl('user/register') ?>">用户注册 >></a>
                        </div>
                    </div>
                </div>
            -->
            <div class="">

                <?php
                $urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
                $authActionType = AuthSmsVerify::ACTION_USER_REGISTER;
                $urlCreateBooking = $this->createAbsoluteUrl("/booking/testCreate");
                $urlUploadFile = $this->createAbsoluteUrl("/booking/uploadFile");
                ?>
                <form class="" enctype="multipart/form-data" data-ajax="false" data-actionurl="<?php echo $urlCreateBooking; ?>" data-url-uploadfile="<?php echo $urlUploadFile; ?>" id="doctor-form" method="post">
                    <input type="hidden" value="<?php echo $urlGetSmsVerifyCode; ?>" name="smsverify[actionUrl]" id="smsverify_actionUrl">
                    <input type="hidden" value="100" name="smsverify[actionType]" id="smsverify_actionType">
                    <div class="ui-field-contain">
                        <label for="fullname" class="">姓名:</label>
                        <input class="" maxlength="45" placeholder="请输入真实姓名" name="DoctorForm[fullname]" id="DoctorForm_fullname" type="text">
                        <div class="errorMessage" id="DoctorForm_fullname_em_" ></div>        
                    </div>

                    <div class="ui-field-contain">
                        <label for="state_id" class="">选择省份:</label>
                        <select name="DoctorForm[state_id]" id="DoctorForm_state_id">
                            <option value=""> --选择省份 --</option>
                            <option value="1">北京</option>
                            <option value="2">天津</option>
                            <option value="3">河北</option>
                            <option value="4">山西</option>
                            <option value="5">内蒙古</option>
                            <option value="6">辽宁</option>
                            <option value="7">吉林</option>
                            <option value="8">黑龙江</option>
                            <option value="9">上海</option>
                            <option value="10">江苏</option>
                            <option value="11">浙江</option>
                            <option value="12">安徽</option>
                            <option value="13">福建</option>
                            <option value="14">江西</option>
                            <option value="15">山东</option>
                            <option value="16">河南</option>
                            <option value="17">湖北</option>
                            <option value="18">湖南</option>
                            <option value="19">广东</option>
                            <option value="20">广西</option>
                            <option value="21">海南</option>
                            <option value="22">重庆</option>
                            <option value="23">四川</option>
                            <option value="24">贵州</option>
                            <option value="25">云南</option>
                            <option value="26">西藏</option>
                            <option value="27">陕西</option>
                            <option value="28">甘肃</option>
                            <option value="29">青海</option>
                            <option value="30">宁夏</option>
                            <option value="31">新疆</option>
                            <option value="32">台湾</option>
                            <option value="33">香港</option>
                            <option value="34">澳门</option>
                        </select>
                        <div class="errorMessage" id="DoctorForm_state_id_em_" ></div>

                    </div>

                    <div class="ui-field-contain">
                        <label for="city_id" class="">选择城市:</label>
                        <div class="ui-select">
                            <select id="DoctorForm_city_id" name="DoctorForm[city_id]">
                                <option value="">-- 选择 --</option>
                            </select>
                            <div class="errorMessage" id="DoctorForm_city_id_em_" >

                            </div>

                        </div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="mobile" class="">所属医院:</label>
                        <input class="" placeholder="您所在的医院名称" name="DoctorForm[hospital_name]" id="DoctorForm_hospital_name" type="text" maxlength="45">
                        <div class="errorMessage" id="DoctorForm_hospital_name_em_" ></div></div>
                    <div class="ui-field-contain">
                        <label for="mobile" class="">科室:</label>
                        <input class="" placeholder="您所在的科室名称" name="DoctorForm[faculty]" id="DoctorForm_faculty" type="text" maxlength="45">
                        <div class="errorMessage" id="DoctorForm_faculty_em_" ></div></div>
                    <div class="ui-field-contain">
                        <label for="medical_title" class="">临床职称:</label>
                        <select name="DoctorForm[medical_title]" id="DoctorForm_medical_title">
                            <option value="">-- 选择临床职称 --</option>
                            <option value="1">主任医师</option>
                            <option value="2">副主任医师</option>
                        </select>
                        <div class="errorMessage" id="DoctorForm_medical_title_em_" ></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="academic_title" class="">学术职称:</label>
                        <select name="DoctorForm[academic_title]" id="DoctorForm_academic_title">
                            <option value="">-- 选择学术职称 --</option>
                            <option value="1">教授</option>
                            <option value="2">副教授</option>
                        </select>
                        <div class="errorMessage" id="DoctorForm_academic_title_em_" ></div>
                    </div>

                    <div class="ui-field-contain">
                        <label for="btn-addfiles">医师资格证</label>
                        <div id="uploader" class="wu-example">
                            <div class="queueList">
                                <div id="dndArea" class="placeholder">
                                    <div id="filePicker" class="webuploader-container"><div class="webuploader-pick">点击选择图片</div><div id="rt_rt_1a024omln14qo1pag1lqm143o7me1" style="position: absolute; top: 0px; left: 69.5px; width: 168px; height: 44px; overflow: hidden; bottom: auto; right: auto;"><input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label></div></div>
                    <!--                                            <p>或将照片拖到这里，单次最多可选10张</p>-->
                                </div>
                                <ul class="filelist"></ul></div>
                            <div class="statusBar" style="display:none;">
                                <div class="progress" style="display: none;">
                                    <span class="text">0%</span>
                                    <span class="percentage" style="width: 0%;"></span>
                                </div>
                                <div class="info">共0张（0B），已上传0张</div>
                                <div class="btns">
                                    <div id="filePicker2" class="webuploader-container"><div class="webuploader-pick">继续添加</div><div id="rt_rt_1a024omlp193a8qn9ku1lcs1ggk6" style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;"><input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label></div></div>
                                    <!--                                            <div class="uploadBtn">提交</div>-->

                                </div>
                            </div>
                            <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
                            <!--                                    <div class="statusBar uploadBtn">提交</div>-->
                        </div>
                        <div>

                        </div>
                    </div>

                    <div class="ui-field-contain">          

                        <input id="ytDoctorForm_terms" type="hidden" value="0" name="DoctorForm[terms]">
                        <div class="ui-checkbox">
                            <label for="DoctorForm_terms" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-on">同意名医主刀<a class="ui-link" href="/myzd/mobile/site/page/view/terms" target="_blank">《在线服务条款》</a></label><input class="" value="1" checked="checked" name="DoctorForm[terms]" id="DoctorForm_terms" type="checkbox"></div>    
                        <div class="errorMessage" id="DoctorForm_terms_em_" >
                        </div>
                    </div>

                    <div class="ui-field-contain">
                        <input id="btnSubmit" class="btn-success uploadBtn" data-icon="check" data-iconpos="right" type="submit" name="yt0" value="提交">
                    </div>
                </form>
                <br />
                <a id="toTip" class="hide" href="#tipPage" data-rel="dialog">提示页</a>
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
            </div>

        <?php } ?>
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
