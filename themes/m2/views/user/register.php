<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                    ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pUserRegister');
$this->setPageTitle('用户注册');
$urlLogin = $this->createUrl('user/login');
?>


<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-expertteam" data-add-back-btn="true" data-back-btn-text="返回">
    <div data-role="content">
        <div class="">
            <div class="border-bottom">
                <div class="clearfix">
                    <div class="pull-left">
                        <div class="reg-header">用户注册</div>
                    </div>
                    <div class="pull-right mt20">
                        <a class="" href="<?php echo $this->createUrl('doctor/register') ?>">医生注册</a>
                    </div>
                </div>
            </div>
            <div class=""></div>
        </div>
        <div class="mt40">
            <form class="form-horizontal">
                <div data-role="fieldcontain">
                    <div class="ui-field-contain">
                        <label for="UserRegisterForm_username" class="">手机号:</label>
                        <input type="text" name="UserRegisterForm[username]" id="UserRegisterForm_username" class="" placeholder="请输入手机号">
                        <div class="errorMessage" id="UserRegisterForm_username_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain verify_code">
                        <label for="UserRegisterForm_verify_code" class="">验证码:</label>
                        <input type="text" name="UserRegisterForm[verify_code]" id="UserRegisterForm_verify_code" class="" placeholder="请输入验证码">
                        <input type="button" class="pull-right" value="获取验证码">
                        <div class="errorMessage" id="UserRegisterForm_verify_code_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="UserRegisterForm_password" class="">登录密码:</label>
                        <input type="password" name="UserRegisterForm[password]" id="UserRegisterForm_password" class="" placeholder="4至20位英文或数字">
                        <div class="errorMessage" id="UserRegisterForm_password_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="UserRegisterForm_password_repeat" class="">确认密码:</label>
                        <input type="password" name="UserRegisterForm[password_repeat]" id="UserRegisterForm_password_repeat" class="" placeholder="请再次输入密码">
                        <div class="errorMessage" id="UserRegisterForm_password_repeat_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <input id="UserRegisterForm_btnSubmitEnquiry" class="btn-success" data-icon="check" data-iconpos="right" type="submit" name="UserRegisterForm[yt0" value="提交">
                    </div>
                </div>
            </form>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>
