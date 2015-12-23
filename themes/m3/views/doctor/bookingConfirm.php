<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/user.css" . "?v=" . time());                                        ?>	
<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pBookingInfo');
$this->setPageTitle('申请提交');
?>
<div id="<?php echo $this->getPageID(); ?>" class="dr-view wheat" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-add-back-btn="true" data-back-btn-text="返回">
    <style>
        .title{color:#19aea5;padding: 0!important;}
        .patientinfo{margin: 20px 0;letter-spacing: 2px;}
        .patientinfo>span{padding: 0px 9px;}
        .patientinfo .textdesc{line-height: 2em;letter-spacing: 2px;}
        .border-right{border-right: 1px solid #888;}
    </style>
    <div data-role="content">
        <div class="patientinfo">
            <span class="title">患者基本信息：</span><span class="patientname">王力宏</span><span class="patientage border-right">19岁</span><span class="patientgender border-right">男</span><span class="patientcity">上海</span>
        </div>
        <div class="patientinfo">
            <div><span class="title">意向就诊时间：</span></div>
            <div class="mt10">
                <span class="startdate">2000年00月00日</span>----<span class="enddate">3000年00月00日</span>
            </div>
        </div>
        <div class="patientinfo">
            <div><span class="title">疾病诊断：</span></div>
            <div class="mt10">
                <span class="">这里填什么什么病</span>
            </div>
        </div>
        <div class="patientinfo">
            <div><span class="title">病史描述：</span></div>
            <div class="mt10">
                <span class="">这里填一些病史的描述</span>
            </div>
        </div>
        <div class="patientinfo">
            <div><span class="title">就诊情况：</span></div>
            <div class="mt10">
                <span class="textdesc">请简要表述您的需求。例如：北京--北京协和医院--口腔科--王力宏教授来我院完成该例手术。如无明确需求，名医主刀会为您寻找该领域三甲医院副主任医生级别以上的医生前来就诊。</span>
            </div>
        </div>
        <div class="text-center mt30">
            <a href='#' class="btn btn-yes">
                确认提交
            </a>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>
