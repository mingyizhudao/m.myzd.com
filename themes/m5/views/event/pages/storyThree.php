<?php
$this->setPageTitle('溺水妈妈的奇迹');
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
        <div class="title">溺水妈妈的奇迹</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 mt26">
        <div class="font-s21 color-black5">年轻妈妈的生命倒计时，急需寻找“续命”肺源</div>
        <div class="mt21 font-s12">2015-09-29<span class="color-blue ml7">来源:名医主刀</span></div>
        <div class="color-black6">
            <div class="text-indent-2 mt26">在大家准备和亲人团聚欢度十一长假的时候，有一个家庭却在承受亲人命悬一线的折磨。36岁的胡女士，是一位年轻的妈妈，原本拥有幸福美满的家庭，家里有两个孩子，老大6岁，老二仅仅8个月。就在9月13号晚上，这位年轻的妈妈由于车祸不幸坠入河中而溺水，被救上岸时已经停止了呼吸，原本以为这位妈妈将永远的离开人世了，因为她溺水时间长达12分钟，但奇迹却发生了，经抢救后年轻的妈妈竟然有了呼吸，这是多么顽强的生命。</div>
            <div class="text-indent-2 mt16">经过2周的抢救治疗，年轻妈妈的病况并没有好转，由于在溺水过程中吸入大量淤泥，再加上肺部缺氧长达12分钟，导致肺部严重损伤，并出现严重萎缩，生命岌岌可危。目前这位年轻的妈妈在湘雅三医院重症监护室气管切开靠呼吸机及ECMO维持生命，经过无锡人民医院陈静瑜教授、协和医院ICU王小亭教授和中南大学湘雅三医院ICU杨明施教授的共同诊治，诊断结果为双肺毁损实变，肺功能不可逆，急需肺移植。</div>
            <div class="mt26 color-black">陈静瑜主任也在个人微博中写到：</div>
            <div class="mt16">
                <img src="<?php echo $urlResImage; ?>zhuanti/mmjxfy_01.png" class="w100">
            </div>
            <div class="mt26">
                <img src="<?php echo $urlResImage; ?>zhuanti/mmjxfy_02.jpg" class="w100">
            </div>
            <div class="mt12 font-s12">（患者目前在湘雅附三院重症监护室肺气管切开靠呼吸机及ECMO维持生命）</div>
            <div class="mt26">
                <img src="<?php echo $urlResImage; ?>zhuanti/mmjxfy_03.jpg" class="w100">
            </div>
            <div class="mt12 font-s12">（目前双肺毁损实变急需肺移植，急需有心脑死亡爱心器官捐献的A或者O型肺源）</div>
            <div class="mt26">
                <img src="<?php echo $urlResImage; ?>zhuanti/mmjxfy_04.jpg" class="w100">
            </div>
            <div class="mt12 font-s12">（目前双肺毁损实变急需肺移植，急需有心脑死亡爱心器官捐献的A或者O型肺源）</div>
            <div class="mt26 bb-dashed-gray"></div>
            <div class="mt26 text-indent-2">名医主刀从一开始就得到这个消息，利用平台资源，汇聚了多方专家为患者进行会诊，为的就是挽救这位母亲的生命。一般人溺水肺泡中的氧气含量能维持4~6分钟，而这位母亲却坚持了12分钟，这是爱的力量支撑着她，让她与死神做顽强的拼搏。我们深深的被年轻妈妈的意志所感动，我们希望通过这篇文章，可以帮助年轻的妈妈找到合适的肺源，挽救她的生命，让生命的奇迹可以继续延续。</div>
            <div class="mt16 text-indent-2">我们同时号召更多的人可以加入到传播队伍之中，来帮助胡女士寻找肺源，也许您顺手转发的这条消息，就能让一条生命获得重生，让奇迹再次出现。</div>
            <div class="color-red2 mb20">
                <div class="mt26">目前急需：有心脑死亡爱心器官捐献的A或者O型肺源。</div>
                <div class="mt5">救助热线：400 119 7900</div>
            </div>
        </div>
    </div>
</article>