<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showHeader = Yii::app()->request->getQuery('header', 1);
$showPage = Yii::app()->request->getQuery('page', 0);
$showApp = Yii::app()->request->getQuery('app', 1);
if ($showApp == 1) {
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne'));
} else {
    $urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo'));
} else {
    $urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree'));
} else {
    $urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne'));
} else {
    $urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiTwo = $this->createUrl('event/view', array('page' => 'zhuantiTwo'));
} else {
    $urlEventZhuantiTwo = $this->createUrl('event/view', array('page' => 'zhuantiTwo', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiThree = $this->createUrl('event/view', array('page' => 'zhuantiThree'));
} else {
    $urlEventZhuantiThree = $this->createUrl('event/view', array('page' => 'zhuantiThree', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour'));
} else {
    $urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiFive = $this->createUrl('event/view', array('page' => 'zhuantiFive'));
} else {
    $urlEventZhuantiFive = $this->createUrl('event/view', array('page' => 'zhuantiFive', 'header' => '0'));
}
if ($showApp == 1) {
    $urlEventZhuantiSix = $this->createUrl('event/view', array('page' => 'zhuantiSix'));
} else {
    $urlEventZhuantiSix = $this->createUrl('event/view', array('page' => 'zhuantiSix', 'header' => '0'));
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
    <header class="bg-green">
        <ul class="control-group">
            <li class="<?php echo $showZt; ?>">
                <a id="zhuanti">手术专题</a>
            </li>
            <li class="<?php echo $showStory; ?>">
                <a id="story">就医故事</a>
            </li>
        </ul>
    </header>
<?php } ?>
<article id="zhuanti_article" class="<?php echo $showZt; ?>" data-scroll="true" data-active="find_footer">
    <div>
        <ul class="list">
            <li>
                <a href="<?php echo $urlEventZhuantiFive; ?>">
                    <div class="font-s17">
                        【卡塔尔王子中国寻医记】
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventZhuantiSix; ?>">
                    <div class="font-s17">
                        【80%的人忽视的身体小肿块，险些成癌】
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventZhuantiFour; ?>">
                    <div class="font-s17">
                        【名医主刀--百万公益金】
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventZhuantiOne; ?>">
                    <div class="font-s17">
                        【医生专访 陆劲松】"深夜10点的病房"
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventZhuantiTwo; ?>">
                    <div class="font-s17">
                        【预防冬季冠心病发作】名医专家有妙招
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventZhuantiThree; ?>">
                    <div class="font-s17">
                        【泌尿疾病的克星】达芬奇手术机器人
                    </div>
                </a>
            </li>
        </ul>
    </div>
</article>
<article id="story_article" class="<?php echo $showStory; ?>" data-scroll="true" data-active="find_footer">
    <div>
        <ul class="list">
            <li>
                <a href="<?php echo $urlEventStoryOne; ?>">
                    <div class="grid">
                        <div class="col-1 w80 font-s17">
                            韩阿姨的一封感谢信照亮千万患者就医路
                        </div>
                        <div class="col-1 w20 text-right">
                            <img src="<?php echo $urlResImage; ?>gushi/storyOne-1.png" class="w60p">
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventStoryTwo; ?>">
                    <div class="grid">
                        <div class="col-1 w80 font-s17">
                            父亲两次抗癌,只为给女儿更久的爱
                        </div>
                        <div class="col-1 w20 text-right">
                            <img src="<?php echo $urlResImage; ?>gushi/storyTwo-1.png" class="w60p">
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $urlEventStoryThree; ?>">
                    <div class="grid">
                        <div class="col-1 w80 font-s17">
                            年轻妈妈的生命倒计时，急需寻找“续命”肺源
                        </div>
                        <div class="col-1 w20 text-right">
                            <img src="<?php echo $urlResImage; ?>gushi/storyThree-1.png" class="w60p">
                        </div>
                    </div>
                </a>
            </li>
        </ul>
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