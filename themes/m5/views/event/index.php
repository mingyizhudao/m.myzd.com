<?php
$urlEventStoryOne = $this->createUrl('event/view', array('page' => 'storyOne'));
$urlEventStoryTwo = $this->createUrl('event/view', array('page' => 'storyTwo'));
$urlEventStoryThree = $this->createUrl('event/view', array('page' => 'storyThree'));
$urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne'));
$urlEventZhuantiTwo = $this->createUrl('event/view', array('page' => 'zhuantiTwo'));
$urlEventZhuantiThree = $this->createUrl('event/view', array('page' => 'zhuantiThree'));
$urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$isShow = Yii::app()->request->getQuery('page', 0);
if ($isShow != 0) {
    $this->show_footer = false;
}
?>
<?php if ($isShow == 0) { ?>
    <header class="bg-green">
        <ul class="control-group">
            <li class="active">
                <a id="zhuanti">手术专题</a>
            </li>
            <li>
                <a id="story">就医故事</a>
            </li>
        </ul>
    </header>
<?php } ?>
<?php
if ($isShow == 0 || $isShow == 1) {
    $showZt = 'active';
    $showStory = '';
} else {
    $showZt = '';
    $showStory = 'active';
}
?>
<article id="zhuanti_article" class="<?php echo $showZt; ?>" data-scroll="true" data-active="find_footer">
    <div>
        <ul class="list">
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
            <li>
                <a href="<?php echo $urlEventZhuantiFour; ?>">
                    <div class="font-s17">
                        【名医主刀--百万公益金】
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