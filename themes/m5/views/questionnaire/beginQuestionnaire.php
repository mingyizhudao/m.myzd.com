<?php
$urlQuestionnaire = $this->createUrl('questionnaire/view', array('id' => 1));
$this->show_footer = false;
?>
<header class="bg-green">
    <h1 class="title">名医主刀0元面诊</h1>
</header>
<article id="beginQuestionnaire_article" class="active" data-scroll="true">
    <div class="font-s15 c-black">
        <div class="pad10 bb-gray">
            <div class="greenIcon">服务介绍</div>
        </div>
        <div class="pt10 pb10 pl20 pr20 text-justify">
            针对非首诊手术患者，名医主刀提供全国知名三甲医院专家的面对面术前咨询服务，让患者获得更全面更权威的诊疗建议。
        </div>
        <div class="pad10 bb-gray">
            <div class="greenIcon">服务流程</div>
        </div>
        <div class="pt10 pb10 pl20 pr20">
            <div class="stepOne">
                填写疾病信息
            </div>
            <div class="nextIcon"></div>
            <div class="stepTwo">
                选择意向专家
            </div>
            <div class="nextIcon"></div>
            <div class="stepThree">
                提交申请
            </div>
            <div class="nextIcon"></div>
            <div class="stepFour">
                等待名医助手回访确认(12个小时内)
            </div>
            <div class="nextIcon2 c-black2">
                *工作时间每天9点~18点
            </div>
            <div class="stepFive">
                如申请被确认有效，支付50元预约金
            </div>
            <div class="pl30 c-black2">
                *面诊后将全额退还
            </div>
            <div class="pt40">
                <a href="<?php echo $urlQuestionnaire; ?>" class="btn btn-full bg-orange">马上申请</a>
            </div>
            <div class="text-center pt20">
                <a href="<?php echo $this->createUrl('questionnaire/qestionnaireServiceView'); ?>" class="color-blue a-underline">服务条款</a>
            </div>
        </div>
    </div>
</article>