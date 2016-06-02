<?php
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php if ($showHeader == 1) { ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <div class="title"></div>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="thyroid_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146252367903177" class="w100">
        </div>
        <div class="pl10 pr10">
            <div class="font-s18 pt20 font-w800">
                当甲状腺结节遇上达芬奇手术机器人
            </div>
            <div class="font-s12 pt10 color-gray8">
                名医主刀<span class="ml7">2016-05-06</span>
            </div>
            <div class="font-s12 mt10 grayBg text-justify">
                和大部分患者一样，在来到名医主刀之前，患者李女士在看病的过程中并不顺利：被票贩子骗，被不明来历的“专家”骗，苦等床位不得等等。经历过这一系列坎坷，正当灰心丧气、深感中国就医如此之难时，李女士丈夫在浏览网页时，无意中看到一篇介绍名医主刀平台的文章，于是与名医主刀取得了联系。
            </div>
            <div class="titleBg">
                细致服务
            </div>
            <div class="text-justify">
                3月22日，李女士在名医主刀官网提交预约单，并对平台给予了充分信任，于当天支付了费用。为了更好的服务患者，名医主刀客服提前拿到患者就诊卡帮患者排队预约挂号，在帮患者预约好门诊时间后再通知患者来医院就诊，大大缩短了患者等候排队的时间。
            </div>
            <div class="pt10">
                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146252399368828" class="w100">
            </div>
            <div class="titleBg">
                最优方案
            </div>
            <div class="text-justify">
                4月8日，根据患者近况，名医主刀客服向患者家属介绍了目前国内治疗甲状腺结节最先进的技术——奇手术机器人，并向患者推荐了名医主刀近期将推出的公益项目，经过多方权衡后，李女士认为此方案是目前的最优方案。
            </div>
            <div class="titleBg">
                名医坐镇
            </div>
            <div class="text-justify">
                4月9日，患者上传病例资料，由名医主刀医生审核后，确认患者病情适应达芬奇机器人手术治疗。4月15日上午主任面诊了患者，在面诊过程中，主任详细的分析了患者病情，并解答了患者的疑虑，让李女士对手术充满信心。
            </div>
            <div class="titleBg">
                名医速度
            </div>
            <div class="pb50 text-justify">
                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146252529781342" class="w130p pull-right pl5 pt5">
                4月26日，患者入院，并于第二天上午进行手术，此次手术非常成功。因为达芬奇机器人手术时看到的是3D的，可以将看到的东西放大3到5倍，用裸眼就可以看到更加清楚和准确，手术的时候就更加精确，创伤小，不易留疤，李女士在手术3天后就办理了出院手续。
            </div>
        </div>
    </div>
</article>