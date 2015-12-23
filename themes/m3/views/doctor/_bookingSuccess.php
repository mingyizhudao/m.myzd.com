<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                    ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pBookingSuccess');
$this->setPageTitle('提交成功');
?>
<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <style>
        .text20{font-size: 20px}
        .ui-content{line-height: 2em;}
    </style>
    <div data-role="content">
        <div class="text-center mt50 text20">
            <i class="fa fa-check"></i> 您的需求已经反馈！
        </div>
        <div class="text-center mt30">
            名医主刀助手会尽快帮您确认，并在第一时间反馈给您，请注意保持手机通畅。
        </div>
        <div class="text-center mt30">
            <a data-ajax='false' href='<?php echo $this->createUrl('doctor/createPatient'); ?>'><span class="btn btn-success"> 完 成 </span></a>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>
