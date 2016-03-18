<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('支付订单');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$data = 1; //安排专家中
?>
<style>
    .bt-gray5{
        border-top: 1px solid #ececec;
    }
    .bb-gray5{
        border-bottom: 1px solid #ececec;
    }

    #evaluate_article.bg{
        background-color: #EAEFF1;
    }
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">支付订单</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article id='evaluate_article' class="active bg" data-scroll="true">
    <div class=''>
        <div class="bg-white pl10 pr10">
            <div class="pt20 color-green font-s18">
                感谢您的评价:祝您早日康复!
            </div>
            <div class='mt10'>
                主刀医生:刘跃武
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    服务效率:
                </div>
                <div class='col-1'>
                    <span data-star='1' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='2' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='3' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='4' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='5' class='serviceStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                </div>
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    手术效果:
                </div>
                <div class='col-1 color-gray'>
                    <span data-star='1' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='2' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='3' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='4' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                    <span data-star='5' class='operationStar pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                </div>
            </div>
            <div class="pt10 pb10 mt10 bt-gray5 bb-gray5">
                如果您无法简介的表达你的想法，那只能说明你还不够了解它，你觉得我说的对不对呀
            </div>
            <div class="mt10 font-s12 letter-s1">
                <div>订单编号:MYZD20160119012</div>
                <div class="grid">
                    <div class="col-0">
                        已付手术预约金:1000元
                    </div>
                    <div class="col-1 text-right">
                        2016-02-23 23:23:23
                    </div>
                </div>
                <div class="grid">
                    <div class="col-0">
                        已付平台服务费:20000元
                    </div>
                    <div class="col-1 text-right">
                        2016-02-23 23:23:23
                    </div>
                </div>
                <div class="text-right pt10 pb10">
                    <a class="color-green">
                        查看详情>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>