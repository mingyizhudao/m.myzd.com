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
$urlHomeMyzy = $this->createUrl('home/page', array('view' => 'myzy'));
$urlHomeMyyz = $this->createUrl('home/page', array('view' => 'myyz'));
?>
<article id="home_article" data-active="home_footer" class="active bg-gray5" data-scroll="true">
    <div>
        <div class="titleImg">
            <img src="<?php echo $urlResImage; ?>homeBg.jpg" class="w100">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=1">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=2">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=3">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=4">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=5">
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
                        <a href="<?php echo $urlHospitalTop; ?>?innerDeptId=6">
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
            <div class="grid mt10 bg-white">
                <div class="col-1 w50 br-gray2 grid middle">
                    <a href="<?php echo $urlBookingQuickbook; ?>">
                        <div class="pl10 pr10 text-center">
                            <div class="text-center">
                                <img class="w68p" src="<?php echo $urlResImage; ?>shoushuzhitongche.png">
                            </div>
                            <div class="color-black10 pt10 font-s16">手术直通车</div>
                            <div class="color-gray4 font-s12">直接预约名医</div>
                        </div>
                    </a>
                </div>
                <div class="col-1 w50">
                    <div class="bb-gray6">
                        <a href="<?php echo $urlDoctorSearch; ?>?disease_sub_category=2">
                            <div class="grid pt15 pb15 pl10 pr10">
                                <div class="col-0 color-black">
                                    <div class="color-black10 font-s16">找名医</div>
                                    <div class="color-gray4 font-s12">各地名医推荐</div>
                                </div>
                                <div class="col-1 text-center">
                                    <img class="w46p" src="<?php echo $urlResImage; ?>findDoctor.png">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <div class="grid pt15 pb15 pl10 pr10" onclick="NTKF.im_openInPageChat('kf_9138_1451451713805');">
                            <div class="col-0 color-black">
                                <div class="color-black10 font-s16">在线客服</div>
                                <div class="color-gray4 font-s12">咨询了解我们</div>
                            </div>
                            <div class="col-1 text-center">
                                <img class="w46p" src="<?php echo $urlResImage; ?>onlineService.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        var height = $('.titleImg').height() - 110;
        $('.titlePosition').css({"margin-top": height + "px"});
    });
</script>