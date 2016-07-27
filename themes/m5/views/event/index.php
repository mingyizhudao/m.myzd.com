<?php
$this->setPageTitle('发现');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showHeader = Yii::app()->request->getQuery('header', 1);
$showPage = Yii::app()->request->getQuery('page', 0);
$showApp = Yii::app()->request->getQuery('app', 1);
$urlEventIndex = $this->createUrl('event/index');
if ($showApp == 1) {
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
                <img src="http://static.mingyizhudao.com/146529036735212" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiInternetOperation; ?>">
                <img src="http://static.mingyizhudao.com/146529829828030" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiCancer; ?>">
                <img src="http://static.mingyizhudao.com/146353686584387" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiLungCancer; ?>">
                <img src="http://static.mingyizhudao.com/146348338505141" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiShapingHealth; ?>">
                <img src="http://static.mingyizhudao.com/14630233122529" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiMygy; ?>">
                <img src="http://static.mingyizhudao.com/146302377992350" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiRobot; ?>">
                <img src="http://static.mingyizhudao.com/146302381725650" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFive; ?>">
                <img src="http://static.mingyizhudao.com/146302384917628" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiSix; ?>">
                <img src="http://static.mingyizhudao.com/14630238789848" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFour; ?>">
                <img src="http://static.mingyizhudao.com/146302390598546" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiOne; ?>">
                <img src="http://static.mingyizhudao.com/146302393608770" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiTwo; ?>">
                <img src="http://static.mingyizhudao.com/146302397500068" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiThree; ?>">
                <img src="http://static.mingyizhudao.com/146302402203799" class="w100">
            </a>
        </div>
        <div class="mt10 mb10">
            <a href="<?php echo $urlEventZhuantiXinxg; ?>">
                <img src="http://static.mingyizhudao.com/146302405313136" class="w100">
            </a>
        </div>
    </div>
</article>
<article id="story_article" class="<?php echo $showStory; ?>" data-scroll="true" data-active="find_footer">
    <div class="text-justify">
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