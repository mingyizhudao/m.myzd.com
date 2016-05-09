<?php
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">名医义诊</h1>
</header>
<article id="myyz_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/14627627707821" class="w100">
        </div>
        <div class="">
            <div class="color-white text-center pt10">
                免费术前方案评估，现约现看
            </div>
            <div class="grid pt10 pb20">
                <div class="col-1 w20"></div>
                <div class="col-1 w60">
                    <a href="<?php echo $urlHomeMyyzDoctor; ?>">
                        <div id="bookingBtn">预约医生</div>
                    </a>
                </div>
                <div class="col-1 w20"></div>
            </div>
        </div>
        <div class="pb20 pt10 bt-red2">
            <div class="font-s21 text-center color-yellow6">
                服务流程
            </div>
            <div class="grid pt10">
                <div class="col-1 w50 grid">
                    <div class="col-1"></div>
                    <div class="stepone"></div>
                    <div class="col-1"></div>
                </div>
                <div class="col-1 w50 grid">
                    <div class="col-1"></div>
                    <div class="steptwo"></div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="grid pt20">
                <div class="col-1 w50 grid">
                    <div class="col-1"></div>
                    <div class="stepthree"></div>
                    <div class="col-1"></div>
                </div>
                <div class="col-1 w50 grid">
                    <div class="col-1"></div>
                    <div class="stepfour"></div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="grid pt20">
                <div class="col-1"></div>
                <div class="stepfive"></div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
</article>