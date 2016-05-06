<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showHeader = Yii::app()->request->getQuery('header', 1);
$showPage = Yii::app()->request->getQuery('page', 0);
$showApp = Yii::app()->request->getQuery('app', 1);
if ($showApp == 1) {
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne'));
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo'));
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree'));
    $urlEventEightHour = $this->createUrl('event/view', array('page' => 'storyEightHour'));
    $urlEventThyroid = $this->createUrl('event/view', array('page' => 'thyroid'));
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
} else {
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne', 'header' => '0'));
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo', 'header' => '0'));
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree', 'header' => '0'));
    $urlEventEightHour = $this->createUrl('event/view', array('page' => 'storyEightHour', 'header' => '0'));
    $urlEventThyroid = $this->createUrl('event/view', array('page' => 'thyroid', 'header' => '0'));
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
                <a id="zhuanti">手术专题</a>
            </li>
            <li class="<?php echo $showStory; ?>">
                <a id="story">就医故事</a>
            </li>
        </ul>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="zhuanti_article" class="<?php echo $showZt; ?>" data-scroll="true" data-active="find_footer">
    <div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiShapingHealth; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/shapingHealth/banner.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiMygy; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/mygy.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiRobot; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/robot.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFive; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/Qatar.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiSix; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/tumor.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiFour; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/winterSon.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiOne; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/lujinsong.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiTwo; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/coronaryHeartDisease.jpg" class="w100">
            </a>
        </div>
        <div class="mt10">
            <a href="<?php echo $urlEventZhuantiThree; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/DaVinciRobot.jpg" class="w100">
            </a>
        </div>
        <div class="mt10 mb10">
            <a href="<?php echo $urlEventZhuantiXinxg; ?>">
                <img src="<?php echo $urlResImage; ?>zhuanti/banner/cardiovascular.jpg" class="w100">
            </a>
        </div>
    </div>
</article>
<article id="story_article" class="<?php echo $showStory; ?>" data-scroll="true" data-active="find_footer">
    <div class="text-justify">
        <div class="mt10 bg-white">
            <a href="<?php echo $urlEventThyroid; ?>">
                <div class="grid color-black10">
                    <div class="col-1 w40">
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146252591010862">
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
                        <img src="<?php echo $urlResImage; ?>gushi/eightHour/eightHour.png">
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
                        <img src="<?php echo $urlResImage; ?>gushi/storyOne-1.png">
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
                        <img src="<?php echo $urlResImage; ?>gushi/storyTwo-1.png">
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
                        <img src="<?php echo $urlResImage; ?>gushi/storyThree-1.png">
                    </div>
                    <div class="col-1 w60 font-s17 vertical-center pl20 pr20">
                        年轻妈妈的生命倒计时，急需寻找“续命”肺源
                    </div>
                </div>
            </a>
        </div>
    </div>
</article>
<script>
    $('#zhuanti').tap(function () {
        $('#zhuanti_article').addClass('active');
        $('#story_article').removeClass('active');
    });
    $('#story').tap(function () {
        $('#zhuanti_article').removeClass('active');
        $('#story_article').addClass('active');
    });
</script>