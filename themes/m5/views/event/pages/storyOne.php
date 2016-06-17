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
        <div class="title">故事</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 mt26">
        <div class="font-s21 color-black5">韩阿姨的一封感谢信照亮千万患者就医路</div>
        <div class="mt21 font-s12">2015-08-04<span class="color-blue ml7">来源:名医主刀</span></div>
        <div class="color-black6">
            <div class="text-indent-2 mt26">韩阿姨家住河南，今年6月份和家人来北京看病。韩阿姨开始觉得看病自己到医院挂号最让人放心，自己来到医院找到医生才是最真实的，但是到北京看病没有认识的医生，又不知如何选择医院，病情又急需手术，这让韩阿姨和她的家人陷入了困境。韩阿姨尝试了许多方法去医院挂号，每天很早去医院排队，当韩阿姨挂上专家号之后被专家告知需要手术却没有床位的时候，韩阿姨和她家人又一次陷入失望。</div>
            <div class="text-indent-2 mt16">但是患者排队挂号的时间是非常宝贵的，多等一秒病情就加重一分，危险就多一分。中国一年有很多的患者因等排队等床位延误病情，甚至还有的在等待的过程中病情加重远离人世。</div>
            <div class="text-indent-2 mt16">7月6号韩阿姨的儿子找到了我们。在客服的帮助下，韩阿姨家人在网站提交了病例，我们医疗客服在专家库中为其精准匹配相关专家，当天就为其对接到北京安贞医院胸外科专家。医疗客服将韩阿姨病例资料传送到专家手中。专家当天了解其详细病情及身体状况之后第二天为其安排手术，并且手术非常成功。互联网手术直通车居然这样便捷，这让韩阿姨深深记住“名医主刀”这几个字。</div>
            <div class="mt16 mb20">
                <img src="<?php echo $urlResImage; ?>zhuanti/hanayi.jpg" class="w100">
            </div>
        </div>
    </div>
</article>