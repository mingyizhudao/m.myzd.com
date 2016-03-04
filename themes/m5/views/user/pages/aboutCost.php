<?php
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlUserIndex = $this->createUrl('user/index', array('pages' => ''));
$this->show_footer = false;
?>
<?php if ($showHeader == 1) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a data-target="back" data-icon="previous"></a>
        </nav>
        <h1 class="title">关于费用</h1>
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
            以下2种情况下退还一半预约金：
        </div>
        <div class="pt10 color-black6">
            （1）权威专家面诊后都认为患者不具备手术条件/手术风险过大/达不到病人期望，而无法安排手术时，退还一半预约金。
        </div>
        <div class="pt10 color-black6">
            （2）主刀医生确认需要手术后，若平台无法在一周内安排到合适床位，退还一半预约金。在与患者确认取消服务后的48小时内，将500元退还到患者支付预约金的账户里。
        </div>
        <div class="pt10 color-black6">
            以下这种情况将全额退款：
        </div>
        <div class="pt10 color-black6">
            平台无法对接到患者所指定的专家，而患者又不接受名医助手推荐的其他名医，则在与患者确认取消服务后的48小时内，将全部预约金退至患者支付的账户里。
        </div>
        <div class="pt25 font-s16">
            4.手术需要多少费用？
        </div>
        <div class="pt10 color-black6 pb30">
            具体的手术费用需要根据患者确诊的疾病、身体状况和治疗方式、医院和医生的情况综合评估得出。
        </div>
    </div>
</article>