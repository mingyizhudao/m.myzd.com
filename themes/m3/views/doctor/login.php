<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                       ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pDoctorLogin');
$this->setPageTitle('名医主刀');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>">
    <style type="text/css">    
        #login-form{margin: 20px 20px 0;}
        .logo-img>img{width: 50%;margin: 50px auto 0;display: block;}
    </style>
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
        <div>
            <form class="form-horizontal" method="post" id="login-form" role="form">
                <div data-role="fieldcontain">
                    <div class="ui-field-contain">
                        <label for="DoctorForm_mobile" class="ui-hidden-accessible">手机号:</label>
                        <input type="number" name="DoctorForm[mobile]" id="DoctorForm_mobile" class="" placeholder="请输入手机号">
                        <div class="errorMessage" id="DoctorForm_mobile_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <label for="DoctorForm_password" class="ui-hidden-accessible">密码:</label>
                        <input type="password" name="DoctorForm[password]" id="DoctorForm_password" class="" placeholder="请输入密码">
                        <div class="errorMessage" id="DoctorForm_password_em_" style=""></div>
                    </div>
                    <div class="ui-field-contain">
                        <input id="btnSubmit" class="btn-success " data-icon="check" data-iconpos="right" type="submit" name="yt0" value="登录">
                        <div class="mt20 text-right">
                            <a href='<?php echo $this->createUrl('doctor/register') ?>' class="">没有账号？立即注册</a>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>  	
</div>
