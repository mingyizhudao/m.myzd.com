<style type="text/css">    
    .logo-img>img{width:auto;height:50px;margin: 0 auto 2em auto;display: block;}
</style>
<?php
/*
 * $model UserRegisterForm.
 */
$this->setPageID('pUserRegister');
$this->setPageTitle('用户注册');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>

<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>"  data-nav-rel="#f-nav-account">
    <div data-role="content">
        <div class="logo-img">
            <img src="<?php echo $urlResImage; ?>icons/logo.png"/>
        </div>
        <div>
            <?php
            $this->renderPartial('_formRegister', array('model' => $model));
            ?>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>
