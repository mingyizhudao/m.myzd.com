<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                   ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pDoctorRegister');
$this->setPageTitle('医生注册');
$urlLogin = $this->createUrl('doctor/login');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <style type="text/css">    
        .logo-img>img{width: 50%;margin: 10px auto 0;display: block;}
    </style>
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
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
                $this->renderPartial('_formRegister', array('model' => $model));
                ?>
            </div>

        <?php } ?>
        <div class="mt30"></div>
    </div>  	
</div>
