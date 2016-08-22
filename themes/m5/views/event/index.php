<?php

$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showHeader = Yii::app()->request->getQuery('header', 1);
$showPage = Yii::app()->request->getQuery('page', 0);
$showApp = Yii::app()->request->getQuery('app', 1);
$urlEventIndex = $this->createUrl('event/index');
if ($showApp == 1) {
    $this->setPageTitle('就医故事_名医主刀网移动版');
    $this->setPageKeywords('就医故事');
    $this->setPageDescription('让每一位患者在名医主刀“好看病，看好病”是我们不变的宗旨,名医主刀可以给患者带去更多的希望,不仅可以帮助患者尽快预约到专家,还能大大节省患者等待床位的时间,让患者得到最快的治疗。');
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne'));
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo'));
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree'));
    $urlEventEightHour = $this->createUrl('event/view', array('page' => 'storyEightHour'));
    $urlEventThyroid = $this->createUrl('event/view', array('page' => 'thyroid'));
    $urlEventCoats = $this->createUrl('event/view', array('page' => 'coats'));
    $urlEventLumbar = $this->createUrl('event/view', array('page' => 'lumbar'));
    $urlEventBasketballDream = $this->createUrl('event/view', array('page' => 'basketballDream'));
    $urlEventHujinshui = $this->createUrl('event/view', array('page' => 'hujinshui'));
    $urlEventTick = $this->createUrl('event/view', array('page' => 'tick'));
    $urlEventLife = $this->createUrl('event/view', array('page' => 'life'));
    $urlEventTumour = $this->createUrl('event/view', array('page' => 'tumour'));
    $urlEventOperation = $this->createUrl('event/view', array('page' => 'operation'));
    $urlEventRepeatCustomers = $this->createUrl('event/view', array('page' => 'repeatCustomers'));
    $urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne'));
    $urlEventZhuantiTwo = $this->createUrl('event/view', array('page' => 'zhuantiTwo'));
    $urlEventZhuantiThree = $this->createUrl('event/view', array('page' => 'zhuantiThree'));
    $urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour'));
    $urlEventZhuantiFive = $this->createUrl('event/view', array('page' => 'zhuantiFive'));
    $urlEventZhuantiSix = $this->createUrl('event/view', array('page' => 'zhuantiSix'));
    $urlEventZhuantiRobot = $this->createUrl('event/view', array('page' => 'zhuantiRobot'));
    $urlEventZhuantiXinxg = $this->createUrl('event/view', array('page' => 'zhuantiXinxg'));
    $urlEventZhuantiMygy = $this->createUrl('event/view', array('page' => 'mygy'));
    $urlEventZhuantiShapingHealth = $this->createUrl('event/view', array('page' => 'shapingHealth'));
    $urlEventZhuantiLungCancer = $this->createUrl('event/view', array('page' => 'lungCancer'));
    $urlEventZhuantiCancer = $this->createUrl('event/view', array('page' => 'cancer'));
    $urlEventZhuantiCatherine = $this->createUrl('event/view', array('page' => 'catherine'));
    $urlEventZhuantiInternetOperation = $this->createUrl('event/view', array('page' => 'internetOperation'));
} else {
    $this->setPageTitle('手术专题报道_名医主刀网移动版');
    $this->setPageKeywords('手术专题');
    $this->setPageDescription('名医公益联盟是名医主刀倡导发起,并联合公益组织,医生共建的一种可持续公益模式,旨在让更多患者有机会接受更好的治疗。希望通过名医公益联盟,汇聚社会爱心力量,帮助贫困患者解决“好看病,看好病”的切实需求。');
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne', 'header' => '0'));
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo', 'header' => '0'));
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree', 'header' => '0'));
    $urlEventEightHour = $this->createUrl('event/view', array('page' => 'storyEightHour', 'header' => '0'));
    $urlEventThyroid = $this->createUrl('event/view', array('page' => 'thyroid', 'header' => '0'));
    $urlEventCoats = $this->createUrl('event/view', array('page' => 'coats', 'header' => '0'));
    $urlEventLumbar = $this->createUrl('event/view', array('page' => 'lumbar', 'header' => '0'));
    $urlEventBasketballDream = $this->createUrl('event/view', array('page' => 'basketballDream', 'header' => '0'));
    $urlEventHujinshui = $this->createUrl('event/view', array('page' => 'hujinshui', 'header' => '0'));
    $urlEventTick = $this->createUrl('event/view', array('page' => 'tick', 'header' => '0'));
    $urlEventLife = $this->createUrl('event/view', array('page' => 'life', 'header' => '0'));
    $urlEventTumour = $this->createUrl('event/view', array('page' => 'tumour', 'header' => '0'));
    $urlEventOperation = $this->createUrl('event/view', array('page' => 'operation', 'header' => '0'));
    $urlEventRepeatCustomers = $this->createUrl('event/view', array('page' => 'repeatCustomers', 'header' => '0'));
    $urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne', 'header' => '0'));
    $urlEventZhuantiTwo = $this->createUrl('event/view', array('page' => 'zhuantiTwo', 'header' => '0'));
    $urlEventZhuantiThree = $this->createUrl('event/view', array('page' => 'zhuantiThree', 'header' => '0'));
    $urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour', 'header' => '0'));
    $urlEventZhuantiFive = $this->createUrl('event/view', array('page' => 'zhuantiFive', 'header' => '0'));
    $urlEventZhuantiSix = $this->createUrl('event/view', array('page' => 'zhuantiSix', 'header' => '0'));
    $urlEventZhuantiRobot = $this->createUrl('event/view', array('page' => 'zhuantiRobot', 'header' => '0'));
    $urlEventZhuantiXinxg = $this->createUrl('event/view', array('page' => 'zhuantiXinxg', 'header' => '0'));
    $urlEventZhuantiMygy = $this->createUrl('event/view', array('page' => 'mygy', 'header' => '0'));
    $urlEventZhuantiShapingHealth = $this->createUrl('event/view', array('page' => 'shapingHealth', 'header' => '0'));
    $urlEventZhuantiLungCancer = $this->createUrl('event/view', array('page' => 'lungCancer', 'header' => '0'));
    $urlEventZhuantiCancer = $this->createUrl('event/view', array('page' => 'cancer', 'header' => '0'));
    $urlEventZhuantiCatherine = $this->createUrl('event/view', array('page' => 'catherine', 'header' => '0'));
    $urlEventZhuantiInternetOperation = $this->createUrl('event/view', array('page' => 'internetOperation', 'header' => '0'));
}
if ($showHeader == 0) {
    $this->show_footer = false;
}
?>
<?php
if ($showPage == 0) {
    $showZt = 'active';
    $showStory = '';
} else {
    $showZt = '';
    $showStory = 'active';
}
?>

<?php if ($showHeader == 1) { ?>
    <header class="bg-green text-center">
        <ul class="control-group">
            <li class="<?php echo $showZt; ?>">
                <a href="<?php echo $urlEventIndex; ?>/page/0">手术专题</a>
            </li>
            <li class="<?php echo $showStory; ?>">
                <a href="<?php echo $urlEventIndex; ?>/page/1">就医故事</a>
            </li>
        </ul>
    </header>
<?php } ?>
<article id="zhuanti_article" class="<?php echo $showZt; ?>" data-scroll="true" data-active="find_footer">
    <div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiCatherine; ?>">
                <img alt="名医主刀牵手美国凯瑟琳癌症中心_首秀中国" src="http://static.mingyizhudao.com/146529036735212" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiInternetOperation; ?>">
                <img alt="互联网手术中心公益正在进行时" src="http://static.mingyizhudao.com/146529829828030" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiCancer; ?>">
                <img alt="澄清癌症的十个错误认知" src="http://static.mingyizhudao.com/146353686584387" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiLungCancer; ?>">
                <img alt="美国哈弗大学公共卫生学院根据" src="http://static.mingyizhudao.com/146348338505141" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiShapingHealth; ?>">
                <img alt="共享名医资源_共筹健康中国" src="http://static.mingyizhudao.com/14630233122529" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiMygy; ?>">
                <img alt="名医公益联盟" src="http://static.mingyizhudao.com/146302377992350" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiRobot; ?>">
                <img alt="十年磨一剑_一见必倾心" src="http://static.mingyizhudao.com/146302381725650" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFive; ?>">
                <img alt="名医实力_卡塔尔王子中国寻医记" src="http://static.mingyizhudao.com/146302384917628" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiSix; ?>">
                <img alt="80%的人忽视的身体小肿块_险些成癌" src="http://static.mingyizhudao.com/14630238789848" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFour; ?>">
                <img alt="100万冬日暖阳" src="http://static.mingyizhudao.com/146302390598546" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiOne; ?>">
                <img alt="【医生专访】陆劲松" src="http://static.mingyizhudao.com/146302393608770" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiTwo; ?>">
                <img alt="预防冬季冠心病发作_名医专家有妙招" src="http://static.mingyizhudao.com/146302397500068" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiThree; ?>">
                <img alt="您身边真实的大白_达芬奇手术机器人" src="http://static.mingyizhudao.com/146302402203799" class="w100">
            </a>
        </div>
        <div class="mt10 mb10">
            <a href="<?php echo $urlEventZhuantiXinxg; ?>">
                <img alt="警惕双11熬夜秒杀？诱发心血管疾病发！" src="http://static.mingyizhudao.com/146302405313136" class="w100">
            </a>
        </div>
    </div>
</article>
<article id="story_article" class="<?php echo $showStory; ?>" data-scroll="true" data-active="find_footer">
    <div class="text-justify">
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventRepeatCustomers; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/147090011817137">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        手术还有“回头客”
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventOperation; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/147064363369322">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        小政政做手术准备当男孩
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventLife; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146959849335388">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        同病不同命
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventTick; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/14695984486620">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        身首异处的蜱虫，你威风啥
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventTumour; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146838197736239">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        半岁宝宝如何摆脱10厘米肿瘤
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventHujinshui; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146838200295912">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        一个家的支柱倒了，该怎么办
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventBasketballDream; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146656047376611">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        刘翔主治医生助青年小伙重返球场
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventLumbar; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146656037825323">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        看看别的腰椎间盘突出患者怎么治的？
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventCoats; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146649181675956">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        柳叶刀下的外层渗出性视网膜病变（Coats病）
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventThyroid; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146252591010862">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        当甲状腺结节遇上达芬奇手术机器人
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventEightHour; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146302411767530">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        8小时冒雪夜行驰援，医者仁心只为救死扶伤
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventStoryOne; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146302415509477">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        韩阿姨的一封感谢信照亮千万患者就医路
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventStoryTwo; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/146302418555693">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        父亲两次抗癌,只为给女儿更久的爱
                    </div>
                </div>
            </a>
        </div>
        <div class="mt10 bg-white mb10">
            <a href="<?php echo $urlEventStoryThree; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://static.mingyizhudao.com/14630242227414">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        年轻妈妈的生命倒计时，急需寻找“续命”肺源
                    </div>
                </div>
            </a>
        </div>
    </div>
</article>