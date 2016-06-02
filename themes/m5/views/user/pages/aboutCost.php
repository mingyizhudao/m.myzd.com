<?php
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlUserIndex = $this->createUrl('user/index', array('pages' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php if ($showHeader == 1) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">关于费用</h1>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 text-justify">
        <div class="pt25 font-s16">
            1.名医主刀为什么是收费服务？
        </div>
        <div class="pt10 color-black6">
            名医主刀为保障服务顺利、满意进行付出运营成本，所以该服务是收费服务。
        </div>
        <div class="pt25 font-s16">
            2.包含哪些服务？
        </div>
        <div class="pt10 color-black6">
            包含术前病例资料整理，专家匹配，第一次面诊陪诊服务费（如有需要，安排门诊）。
        </div>
        <div class="pt25 font-s16">
            3.预约金是否可以退还？
        </div>
        <div class="pt10 color-black6">
            当平台无法对接到患者所指定的专家，而且患者又不接受名医助手推荐的其他名医，则在与患者确认取消服务后的48小时内，将全部预约金200元退至患者支付的账户里。
        </div>
        <div class="pt25 font-s16">
            4.手术需要多少费用？
        </div>
        <div class="pt10 color-black6 pb30">
            具体的手术费用需要根据患者确诊的疾病、身体状况和治疗方式、医院和医生的情况综合评估得出。
        </div>
    </div>
</article>