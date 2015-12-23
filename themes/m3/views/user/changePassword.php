<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/changePwdValidator.js', CClientScript::POS_END);
?>
<?php
/*
 * $model UserDoctorMobileLoginForm.
 */
$this->setPageID('pChangePassword');
$this->setPageTitle('修改密码');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
$urlAction = $this->createUrl('user/changePassword');
$urlReturn = '#success';
$urlLogin = $this->createUrl('user/login');
$authActionType = AuthSmsVerify::ACTION_USER_LOGIN;
?>
<div id="<?php echo $this->getPageID(); ?>" data-theme="a" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-nav-rel="#f-nav-account">
    <style type="text/css">            
        .logo-img>img{width:auto;height:50px;margin: 0 auto 2em auto;display: block;}
        .required{display: none;}
    </style>
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
        <div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'changePwd-form',
                'action' => $urlAction,
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'htmlOptions' => array('role' => 'form', 'autocomplete' => 'off', 'data-ajax' => 'false', 'data-returnUrl' => $urlReturn),
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnType' => true,
                    'validateOnDelay' => 500,
                    'errorCssClass' => 'error',
                ),
                'enableAjaxValidation' => false,
            ));
            echo CHtml::hiddenField("smsverify[actionUrl]", $urlGetSmsVerifyCode);
            echo CHtml::hiddenField("smsverify[actionType]", $authActionType);
            ?>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'password'); ?>                                
                <?php echo $form->passwordField($model, 'password', array('placeholder' => '请输入原密码')); ?>
                <?php echo $form->error($model, 'password'); ?>
                <div></div>
            </div>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'password_new'); ?>                                
                <?php echo $form->passwordField($model, 'password_new', array('placeholder' => '请输入新密码')); ?>
                <?php echo $form->error($model, 'password_new'); ?>
                <div></div>
            </div>
            <div class="ui-field-contain">
                <?php echo $form->labelEx($model, 'password_repeat'); ?>                                
                <?php echo $form->passwordField($model, 'password_repeat', array('placeholder' => '请确认新密码')); ?>
                <?php echo $form->error($model, 'password_repeat'); ?>
                <div></div>
            </div>
            <div class="ui-field-contain">
                <input id="btnSubmit" type="submit" data-ajax="false"  name="yt0" value="提交">              
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<div id="success" data-role="page" data-title="修改成功" data-nav-rel="#f-nav-account">
    <div data-role="content">
        <div>
            <h4 class="text-center">修改成功！</h4>
        </div>
        <br />
        <br />
        <div>
            <a id="confirmBtn" href="<?php echo $urlLogin; ?>" data-ajax="false" class="ui-btn">重新登录</a>
        </div>
    </div>
</div>

