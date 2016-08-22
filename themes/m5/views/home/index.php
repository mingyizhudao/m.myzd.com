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
$urlZeroBooking = $this->createUrl('questionnaire/beginQuestionnaireView');
$urlCatherine = $this->createUrl('event/view', array('page' => 'catherine'));
$urlHomeView = Yii::app()->baseUrl;
$urlHospitalIndex = $this->createUrl('hospital/index');
$urlEventIndex = $this->createUrl('event/index');
$urlUserView = $this->createUrl('user/view');
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//激活搜索框搜索
$SITE_1 = PatientStatLog::SITE_1;
//点击科室按钮
$SITE_2 = PatientStatLog::SITE_2;
//点击找名医按钮
$SITE_3 = PatientStatLog::SITE_3;
//点击快速预约按钮
$SITE_4 = PatientStatLog::SITE_4;
//banner
$SITE_5 = PatientStatLog::SITE_5;
//点击在线客服按钮
$SITE_6 = PatientStatLog::SITE_6;
?>
<article id="home_article" data-active="home_footer" class="active bg-gray5" data-scroll="true">
    <div>
        <div class="titleImg">
            <img src="http://static.mingyizhudao.com/146243634396635" class="w100">
        </div>
        <div class="titlePosition">
            <div class="font-s21 font-w800 text-center color-white">做手术就找名医主刀</div>
            <div class="ml10 mr10 bg-white br5 mt20">
                <div class="bg-white pad10">
                    <a href="<?php echo $urlDoctorViewSearch; ?>" id="searchIcon" data-name="激活搜索框搜索">
                        <div class="searchIcon color-black6">
                            搜索疾病、医生或医院
                        </div>
                    </a>
                </div>
            </div>
            <div class="pl10 pr10 bg-white mt20 pb10">
                <div class="grid pt10">
                    <div class="col-1 w33 pr10">
                        <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=1&disease_sub_category=1" data-name="外科">
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
                        <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=2&disease_sub_category=13" data-name="骨科">
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
                        <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=3&disease_sub_category=18" data-name="妇产科">
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
                        <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=4&disease_sub_category=21" data-name="小儿外科">
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
                        <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=5&disease_sub_category=28" data-name="五官科">
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
                        <a class="departmentcontent" data-name="内科" data-href="<?php echo $urlHospitalTop; ?>?innerDeptId=6&disease_sub_category=31">
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
            <div class="text-right">
                <div id="freePhone" href="javascript:;">
                    免费
                </div>
            </div>
            <div id="team-bxslider" class="mt-57">
                <ul class="bxslider">

                </ul>
            </div>
            <div class="grid bg-white">
                <div class="col-1 w33 br-gray2">
                    <a href="<?php echo $urlDoctorSearch; ?>?disease_sub_category=2">
                        <div class="pad10 text-center">
                            <div class="text-center">
                                <img class="w55p h55p" src="http://static.mingyizhudao.com/146243692944770" data-id="<?php echo $SITE_3; ?>" data-name="找名医">
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
                                <img class="w55p h55p" src="http://static.mingyizhudao.com/146295571287578" data-id="<?php echo $SITE_4; ?>" data-name="快速预约">
                            </div>
                            <div class="color-black10 pt10 font-s16">快速预约</div>
                            <div class="color-gray4 font-s12">省心放心找名医</div>
                        </div>
                    </a>
                </div>
                <div id="consultation" class="col-1 w33">
                    <div class="pad10 text-center">
                        <div class="text-center">
                            <img class="w55p h55p" src="http://static.mingyizhudao.com/146243699018730" data-id="<?php echo $SITE_6; ?>" data-name="在线客服">
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
        $('#freePhone').click(function () {
            J.customConfirm('友情提示',
                    '<div class="mb10">立即拨打免费客服热线400-6277-120</div>',
                    '<a id="closeLogout" class="w50">取消</a>',
                    '<a id="dial" class="color-green w50">拨打</a>',
                    function () {
                    });
            $('#closeLogout').click(function () {
                J.closePopup();
            });
            $('#dial').click(function () {
                J.closePopup();
                location.href = 'tel://4006277120';
            });
        });

        $('#consultation').click(function () {
            location.href = 'http://p.qiao.baidu.com/im/index?siteid=9290674&ucid=10135139';
        });
        function searchStat(keyword) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_1; ?>', 'stat[key_word]': keyword},
                success: function (data) {

                }
            });
        }
        function buttonStat(keyword, data_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': data_id, 'stat[key_word]': keyword},
                success: function (data) {

                }
            });
        }
        function departmentStat(keyword) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_2; ?>', 'stat[key_word]': keyword},
                success: function (data) {

                }
            });
        }
        function bannerStat(keyword) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_5; ?>', 'stat[key_word]': keyword},
                success: function (data) {

                }
            });

        }
        $('#searchIcon').click(function () {
            var obj = $(this);
            var name = obj.attr("data-name");
            searchStat(name);

        });
        $('.departmentcontent').click(function () {
            var obj = $(this);
            var name = obj.attr("data-name");
            var url = obj.attr("data-href");
            departmentStat(name);
            window.location = url;
        });
        $('img.w55p.h55p').click(function () {
            var obj = $(this);
            var data_id = obj.attr("data-id");
            var name = obj.attr("data-name");
            buttonStat(name, data_id);
        });




        //轮播图
        var html = '<li class="slide">' +
                '<a href="<?php echo $urlZeroBooking; ?>?appId=ddaa785817d165e8&site=1">' +
                '<img class="w100" src="http://static.mingyizhudao.com/146906610294170">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlHomeMyyzDoctor; ?>">' +
                '<img class="w100" src="http://static.mingyizhudao.com/146606890329840">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlMygy; ?>">' +
                '<img class="w100" src="http://static.mingyizhudao.com/147150951177488">' +
                '</a>' +
                '</li>';
        $('#home_article .bxslider').html(html);

        $('.bxslider').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
        $('#home_article .bxslider').click(function () {
            var obj = $(this);
            bannerStat('banner');
        });

        var height = $('.titleImg').height() - 110;
        $('.titlePosition').css({"margin-top": height + "px"});
    });
</script>