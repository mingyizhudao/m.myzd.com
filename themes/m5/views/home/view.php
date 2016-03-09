<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
?>
<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDoctorViewSearch = $this->createAbsoluteUrl('doctor/viewSearch');
$urlHospitalTop = $this->createAbsoluteUrl('hospital/top');
$urlDoctorSearch = $this->createAbsoluteUrl('doctor/search');
$urlBookingQuickbook = $this->createAbsoluteUrl('booking/quickbook');
$urlEventZhuantiOne = $this->createUrl('event/view', array('page' => 'zhuantiOne'));
$urlEventZhuantiFour = $this->createUrl('event/view', array('page' => 'zhuantiFour'));
$urlEventZhuantiFive = $this->createUrl('event/view', array('page' => 'zhuantiFive'));
$urlEventZhuantiSix = $this->createUrl('event/view', array('page' => 'zhuantiSix'));
$urlHomeMyzy = $this->createUrl('home/page', array('view' => 'myzy'));
?>
<header id="home_header" class="bg-green">
    <div class="grid">
        <div class="col-1 w15"></div>
        <div class="col-1 w70 pt1">
            <a href="<?php echo $urlDoctorViewSearch; ?>" class="text-center">
                <div class="searchDiv color-green5">
                    搜疾病、医生
                </div>
            </a>
        </div>
        <div class="col-1 w15 text-right pt11 pr15">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p">
            </a>
        </div>
    </div>

</header>
<article id="home_article" data-active="home_footer" class="active" data-scroll="true">
    <div>
        <div id="team-bxslider" class="">
            <ul class="bxslider">

            </ul>
        </div>
        <div class="grid">
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=1">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>wai.png">
                    </div>
                    <div class="color-black text-center font-s16">外科</div>
                </a>
            </div>
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=2">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>gu.png">
                    </div>
                    <div class="color-black text-center font-s16">骨科</div>
                </a>
            </div>
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=3">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>fu.png">
                    </div>
                    <div class="color-black text-center font-s16">妇产科</div>
                </a>
            </div>
        </div>
        <div class="grid mt15">
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=4">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>xiao.png">
                    </div>
                    <div class="color-black text-center font-s16">小儿外科</div>
                </a>
            </div>
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=5">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>wu.png">
                    </div>
                    <div class="color-black text-center font-s16">五官科</div>
                </a>
            </div>
            <div class="w33">
                <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=6">
                    <div class="text-center">
                        <img class="w54p" src="<?php echo $urlResImage; ?>nei.png">
                    </div>
                    <div class="color-black text-center font-s16">内科</div>
                </a>
            </div>
        </div>
        <div class="grid bt5-gray bb5-gray mt15">
            <div class="w45 br-gray">
                <a href="<?php echo $urlBookingQuickbook; ?>">
                    <div class="text-center pt20">
                        <img class="w75p" src="<?php echo $urlResImage; ?>shoushuzhitongche.png">
                    </div>
                    <div class="mt10 mb20 color-black text-center font-s16">手术直通车</div>
                </a>
            </div>
            <div class="w55">
                <div class="bb-gray">
                    <a href="<?php echo $urlDoctorSearch; ?>?disease_sub_category=2">
                        <div class="grid pt15 pb15">
                            <div class="col-0 text-center pl20 pr20">
                                <img class="w46p" src="<?php echo $urlResImage; ?>findDoctor.png">
                            </div>
                            <div class="col-1 color-black font-s16 vertical-center">
                                找名医
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="<?php echo $urlHomeMyzy; ?>">
                        <div class="grid pt15 pb15">
                            <div class="col-0 text-center pl20 pr20">
                                <img class="w44p" src="<?php echo $urlResImage; ?>mygy.png">
                            </div>
                            <div class="col-1 color-black font-s16 vertical-center">
                                名医公益
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $html = '<li class="slide">' +
                '<a href="<?php echo $urlEventZhuantiFive; ?>">' +
                '<img class="w100" src="<?php echo $urlResImage; ?>zhuanti/Five/bg_kataerwangzi.jpg">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlEventZhuantiSix; ?>">' +
                '<img class="w100" src="<?php echo $urlResImage; ?>/zhuanti/Six/bg_six.jpg">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlEventZhuantiFour; ?>">' +
                '<img class="w100" src="<?php echo $urlResImage; ?>/zhuanti/bg_mingYiZhuYi.jpg">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlEventZhuantiOne; ?>">' +
                '<img class="w100" src="<?php echo $urlResImage; ?>/zhuanti/bg_lujinsong.jpg">' +
                '</a>' +
                '</li>';
        $('#home_article .bxslider').html($html);

        $('.bxslider').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
    });
</script>