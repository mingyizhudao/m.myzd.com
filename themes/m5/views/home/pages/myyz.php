<?php
$this->setPageTitle('名医义诊');
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//点击预约按钮
$SITE_9 = PatientStatLog::SITE_9;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">名医义诊</h1>
</header>
<footer>
    <button id="booking" class="btn btn-block2 font-s16 bg-red3">
        预约医生
    </button>
</footer>
<article id="myyz_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://static.mingyizhudao.com/14627627707821" class="w100">
        </div>
        <div class="pb20 pt10">
            <div class="font-s21 text-center color-brown font-w800">
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
<script>
    $(document).ready(function () {
       
        $('#booking').click(function () {
            
            location.href = "<?php echo $urlHomeMyyzDoctor; ?>";
        });
    });
</script>