<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
?>
<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDoctorViewSearch = $this->createAbsoluteUrl('doctor/viewSearch');
$urlHospitalSearch = $this->createAbsoluteUrl('hospital/search');
$urlDoctorSearch = $this->createAbsoluteUrl('doctor/search');
$urlBookingQuickbook = $this->createAbsoluteUrl('booking/quickbook');
$urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne'));
$urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour'));
$urlHomeMyzy = $this->createUrl('home/page', array('view' => 'myzy'));
?>
<header class="bg-green">
    <h1 class="title">名医主刀</h1>
</header>
<article id="home_article" data-active="home_footer" class="active" data-scroll="true">
    <div>
        <div id="team-bxslider" class="">
            <ul class="bxslider">
                <li class="slide">
                    <a href="<?php echo $urlEventZhuantiFour; ?>">
                        <img class="w100" src="<?php echo $urlResImage; ?>zhuanti/bg_mingYiZhuYi.jpg">
                    </a>
                </li>
                <li class="slide">
                    <a href="<?php echo $urlEventZhuantiOne; ?>">
                        <img class="w100" src="<?php echo $urlResImage; ?>/zhuanti/bg_lujinsong.jpg">
                    </a>
                </li>
            </ul>
        </div>
        <div class="grid mt20">
            <div class="col-1 w10"></div>
            <div class="col-1 w80">
                <a href="<?php echo $urlDoctorViewSearch; ?>" class="text-center">
                    <div class="searchDiv" data-icon="search">
                        请输入疾病名称
                    </div>
                </a>
            </div>
            <div class="col-1 w10"></div>
        </div>
        <div class="grid mtSize">
            <div class="col-1 w50 grid">
                <div class="col-3"></div>
                <div class="col-0 w100p">
                    <a href="<?php echo $urlHospitalSearch; ?>?disease_sub_category=1">
                        <div class="findDept text-center">找科室</div>
                    </a>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="col-1 w50 grid">
                <div class="col-1"></div>
                <div class="col-0 w100p">
                    <a href="<?php echo $urlDoctorSearch; ?>?disease_sub_category=2">
                        <div class="findDoc text-center">找名医</div>
                    </a>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        <div class="grid mtSize mb20">
            <div class="col-1 w50 grid">
                <div class="col-3"></div>
                <div class="col-0 w100p">
                    <a href="<?php echo $urlHomeMyzy; ?>">
                        <div class="myzy text-center">名医主义</div>
                    </a>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="col-1 w50 grid">
                <div class="col-1"></div>
                <div class="col-0 w100p">
                    <a href="<?php echo $urlBookingQuickbook; ?>">
                        <div class="quickBooking text-center">快速预约</div>
                    </a>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('.bxslider').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
    });
</script>