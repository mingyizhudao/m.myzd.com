<?php
$this->setPageTitle('0元见名医');
$appId = Yii::app()->request->getQuery('appId', '');
$site = Yii::app()->request->getQuery('site', '');
$source = Yii::app()->request->getQuery('app', 0);
if ($source == 0) {
    $urlQuestionnaire = $this->createUrl('questionnaire/view', array('id' => 1));
    $urlQestionnaireService = $this->createUrl('questionnaire/qestionnaireServiceView');
} else {
    $urlQuestionnaire = $this->createUrl('questionnaire/view', array('id' => 1, 'app' => 1));
    $urlQestionnaireService = $this->createUrl('questionnaire/qestionnaireServiceView', array('app' => 1));
}
$this->show_footer = false;
?>
<?php
if ($source == 0) {
    ?>
    <header class="bg-green">
        <h1 class="title">0元见名医</h1>
    </header>
    <?php
}
?>
<article id="beginQuestionnaire_article" class="active" data-scroll="true">
    <div class="font-s15 c-black">
        <div class="pad10 bb-gray">
            <div class="greenIcon">服务介绍</div>
        </div>
        <div class="pt10 pb10 pl20 pr20 text-justify">
            针对有手术需求的患者，名医主刀提供全国知名三甲医院专家的面对面术前咨询服务，让患者获得更全面、更权威的诊疗建议。
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
                名医助手将在工作时间2小时内回访确认
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
                <a href="<?php echo $urlQestionnaireService; ?>" class="color-blue a-underline">服务条款</a>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        var appId = '<?php echo $appId; ?>';
        var site = '<?php echo $site; ?>';
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            if (appId == '6fbe6269c56d4ffa' && site == '3') {
                hm.src = "//hm.baidu.com/hm.js?fa45c0f84056aafc76956e8b702dcf5c";
            } else if (appId == '6fbe6269c56d4ffa' && site == '2') {
                hm.src = "//hm.baidu.com/hm.js?999c4b1af67fd0e7b68024742073f6ab";
            } else if (appId == '6fbe6269c56d4ffa' && site == '1') {
                hm.src = "//hm.baidu.com/hm.js?db96270bc30491fe14303d7547f2b88d";
            } else if (appId == '97da0244566d0654' && site == '6') {
                hm.src = "//hm.baidu.com/hm.js?8e4fa547a79794b4b50110c4369fd4d3";
            } else if (appId == '97da0244566d0654' && site == '5') {
                hm.src = "//hm.baidu.com/hm.js?b9d3666ccdfb2051b3e63b9a8e1b5761";
            } else if (appId == 'd94efdde66a0410f' && site == '1') {
                hm.src = "//hm.baidu.com/hm.js?5b7d44b841a8dda3a75e8703dba2873b";
            } else if (appId == 'c2a04fd2da83f23a' && site == '1') {
                hm.src = "//hm.baidu.com/hm.js?8b3d9d5fdae40f8f4378821397cf4b3e";
            } else if (appId == '6512babcd858d0d2' && site == '1') {
                hm.src = "//hm.baidu.com/hm.js?8261448864992f585487d9653f864466";
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    });
</script>