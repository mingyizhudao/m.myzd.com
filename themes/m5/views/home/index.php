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
$urlOperationTrain = $this->createUrl('home/page', array('view' => 'operationTrain'));
$urlHomeMyzy = $this->createUrl('home/page', array('view' => 'myzy'));
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlMygy = $this->createUrl('event/view', array('page' => 'mygy'));
$urlCatherine = $this->createUrl('event/view', array('page' => 'catherine'));
?>

<article id="home_article" data-active="home_footer" class="active bg-gray5" data-scroll="true">
    <div>
        <div class="titleImg">
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243634396635" class="w100">
        </div>
        <div class="titlePosition">
            <div class="font-s21 font-w800 text-center color-white">做手术就找名医主刀</div>
            <div class="ml10 mr10 bg-white br5 mt20">
                <div class="bg-white pad10">
                    <a href="<?php echo $urlDoctorViewSearch; ?>">
                        <div class="searchIcon color-black6">
                            搜索疾病、医生或医院
                        </div>
                    </a>
                </div>
            </div>
            <div class="pl10 pr10 bg-white mt20 pb10">
                <div class="grid pt10">
                    <div class="col-1 w33 pr10">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=1&disease_sub_category=1">
                            <div class="bg-blue4">
                                <div class="font-s16 pl5 pt5">
                                    外科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 waike w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 w33 pl5 pr5">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=2&disease_sub_category=13">
                            <div class="bg-yellow6">
                                <div class="font-s16 pl5 pt5">
                                    骨科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 guke w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 w33 pl10">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=3&disease_sub_category=18">
                            <div class="bg-red2">
                                <div class="font-s16 pl5 pt5">
                                    妇产科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 fuke w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="grid mt15">
                    <div class="col-1 w33 pr10">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=4&disease_sub_category=21">
                            <div class="bg-orange">
                                <div class="font-s16 pl5 pt5">
                                    小儿外科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 erke w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 w33 pl5 pr5">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=5&disease_sub_category=28">
                            <div class="bg-blue5">
                                <div class="font-s16 pl5 pt5">
                                    五官科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 wuguanke w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 w33 pl10">
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=6&disease_sub_category=31">
                            <div class="bg-blue6">
                                <div class="font-s16 pl5 pt5">
                                    内科
                                </div>
                                <div class="grid pb5 pr5">
                                    <div class="col-1"></div>
                                    <div class="col-0 neike w35p h35p"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="team-bxslider" class="">
                <ul class="bxslider">

                </ul>
            </div>
            <div class="grid bg-white">
                <div class="col-1 w33 br-gray2">
                    <a href="<?php echo $urlDoctorSearch; ?>?disease_sub_category=2">
                        <div class="pad10 text-center">
                            <div class="text-center">
                                <img class="w55p h55p" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243692944770">
                            </div>
                            <div class="color-black10 pt10 font-s16">找名医</div>
                            <div class="color-gray4 font-s12">各地名医推荐</div>
                        </div>
                    </a>
                </div>
                <div class="col-1 w33 br-gray2">
                    <a href="<?php echo $urlOperationTrain; ?>">
                        <div class="pt10 pb10 text-center">
                            <div class="text-center">
                                <img class="w55p h55p" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146295571287578">
                            </div>
                            <div class="color-black10 pt10 font-s16">快速预约</div>
                            <div class="color-gray4 font-s12">省心放心找名医</div>
                        </div>
                    </a>
                </div>
                <div class="col-1 w33" onclick="NTKF.im_openInPageChat('kf_9138_1451451713805');">
                    <div class="pad10 text-center">
                        <div class="text-center">
                            <img class="w55p h55p" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243699018730">
                        </div>
                        <div class="color-black10 pt10 font-s16">在线客服</div>
                        <div class="color-gray4 font-s12">咨询了解我们</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        //轮播图
        var html = '<li class="slide">' +
                '<a href="<?php echo $urlHomeMyyzDoctor; ?>">' +
                '<img class="w100" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146606890329840">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlMygy; ?>">' +
                '<img class="w100" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146606890358056">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlCatherine; ?>">' +
                '<img class="w100" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146606890232455">' +
                '</a>' +
                '</li>';
        $('#home_article .bxslider').html(html);

        $('.bxslider').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
        
        var height = $('.titleImg').height() - 110;
        $('.titlePosition').css({"margin-top": height + "px"});
    });
</script>