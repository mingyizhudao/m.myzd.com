<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
?>
<style>
    #home_article .bx-wrapper .bx-pager{left:77%;}
</style>
<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDoctorViewSearch = $this->createAbsoluteUrl('doctor/viewSearch');
$urlHospitalTop = $this->createAbsoluteUrl('hospital/top');
$urlDoctorSearch = $this->createAbsoluteUrl('doctor/search');
$urlOperationTrain = $this->createUrl('home/page', array('view' => 'operationTrain'));
$urlHomeMyzy = $this->createUrl('home/page', array('view' => 'myzy'));
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlChange = $this->createUrl('home/page', array('view' => 'change'));
$urlMedicalSevice = $this->createUrl('home/page', array('view' => 'medicalsevice'));
$urlInternet = $this->createUrl('home/page', array('view' => 'internet'));
$urlBnzOperation=$this->createUrl('home/page',array('view'=>'bnzOperation'));

$urlMygy = $this->createUrl('event/view', array('page' => 'mygy'));
$urlZeroBooking = $this->createUrl('questionnaire/beginQuestionnaireView');
$urlCatherine = $this->createUrl('event/view', array('page' => 'catherine'));
$urlHomeView = Yii::app()->request->hostInfo;
$urlHospitalIndex = $this->createUrl('hospital/index');
$urlEventIndex = $this->createUrl('event/index');
$urlUserView = $this->createUrl('user/view');
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');//http://localhost/myzd/api/stat;
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
            <div class="pl10 pr10 bg-white mt20 pb10" id="dpm-bxslider">
                <ul class="bxslider1">
             
                </ul>
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
                    <a href="<?php echo $urlDoctorSearch; ?>">
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
            location.href = 'http://dct.zoosnet.net/LR/Chatpre.aspx?id=DCT73779034&lng=cn';
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
        $('img.w55p.h55p').click(function () {
            var obj = $(this);
            var data_id = obj.attr("data-id");
            var name = obj.attr("data-name");
            buttonStat(name, data_id);
        });




        //轮播图
        var html ='<li class="slide">' +
                '<a href="<?php echo $urlInternet; ?>">' +
                '<img class="w100" src="http://static.mingyizhudao.com/147693609846958">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlMedicalSevice; ?>">' +
                '<img class="w100" src="http://static.mingyizhudao.com/147505375737374">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlChange; ?>/appId/ddaa785817d165e8/site/1">' +
                '<img class="w100" alt="改变，从现在开始" src="http://static.mingyizhudao.com/147330339912652">' +
                '</a>' +
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlHomeMyyzDoctor; ?>">' +
                '<img class="w100" alt="名医义诊" src="http://static.mingyizhudao.com/146606890329840">' +
                '</a>' + 
                '</li>' +
                '<li class="slide">' +
                '<a href="<?php echo $urlMygy; ?>">' +
                '<img class="w100" alt="名医公益行" src="http://static.mingyizhudao.com/147150951177488">' +
                '</a>' +
                '</li>';
        $('#home_article #team-bxslider .bxslider').html(html);

        $(' .bxslider').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
        $('#home_article #team-bxslider .bxslider').click(function () {
            var obj = $(this);
            bannerStat('banner');
        });

        //轮播图2
        var text= 
        '<li class="slide">'+
                      '<div class="grid pt10"> ' +
                     '<div class="col-1 w33 pr10">  '+
                        '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/101" data-name="普外科"> '+ 
                            '<div class="bg-blue4"> '+
                                 '<div class="font-s16 pl5 pt5">'+  
                                     '普外科 '+ 
                                 '</div> '+ 
                                 '<div class="grid pb5 pr5">' + 
                                    ' <div class="col-1"></div> '+ 
                                     '<div class="col-0 shouwk w35p h35p"></div>' + 
                                 '</div> ' +
                             '</div>  '+
                        ' </a> '+ 
                     '</div>' + 

                     
                     '<div class="col-1 w33 pl5 pr5">' + 
                         '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/102" data-name="骨科"> '+ 
                            ' <div class="y1"> '+
                                ' <div class="font-s16 pl5 pt5"> '+
                                     '骨科 '+ 
                                 '</div> ' +
                                 '<div class="grid pb5 pr5"> ' +
                                     '<div class="col-1"></div> ' +
                                     '<div class="col-0 guk w35p h35p"></div> ' +
                                 '</div>  '+
                            '</div> '+ 
                         '</a> ' +
                     '</div> '+ 
                     '<div class="col-1 w33 pl10">' + 
                        '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/103" data-name="神经外科">'+
                             '<div class="o1" > '+
                                 '<div class="font-s16 pl5 pt5"> '+ 
                                    ' 神经外科 ' +
                                 '</div>  '+
                                 '<div class="grid pb5 pr5">  '+
                                     '<div class="col-1"></div>  '+
                                     '<div class="col-0 shenjwk w35p h35p"></div> '+ 
                                 '</div>'+  
                             '</div> ' +
                         '</a>' + 
                    '</div>' +
                 '</div> ' +
                 '<div class="grid mt15"> ' +
                    '<div class="col-1 w33 pr10"> '+ 
                         '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/105" data-name="胸外科">  '+
                             '<div class="b1"> '+
                                 '<div class="font-s16 pl5 pt5"> '+
                                    ' 胸外科'  +
                                '</div> ' +
                                '<div class="grid pb5 pr5"> ' +
                                     '<div class="col-1"></div> ' +
                                     '<div class="col-0 xiongwk w35p h35p"></div>'+
                                ' </div>'  +
                             '</div> ' +
                         '</a> ' +
                     '</div>'+  
                     '<div class="col-1 w33 pl5 pr5">'+ 
                        ' <a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/104" data-name="泌尿外科"> '+ 
                             '<div class="bg-blue5">' +
                                 '<div class="font-s16 pl5 pt5"> '+ 
                                     '泌尿外科 '+
                                 '</div>'+  
                                 '<div class="grid pb5 pr5">'+  
                                    ' <div class="col-1"></div>'+  
                                     '<div class="col-0 minwk w35p h35p"></div> '+ 
                                 '</div>'+  
                            '</div> '+ 
                        '</a>'+  
                     '</div> '+ 
                     '<div class="col-1 w33 pl10">'+  
                         '<a class="departmentcontent" data-name="眼科 " data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/108">'+  
                             '<div class="b2"> '+
                                 '<div class="font-s16 pl5 pt5"> '+ 
                                    '眼科  '+
                                 '</div>  '+
                                 '<div class="grid pb5 pr5">'  +
                                     '<div class="col-1"></div>'  +
                                     '<div class="col-0 yank w35p h35p"></div> ' +
                                 '</div>  '+
                             '</div>' + 
                         '</a>  '+
                     '</div> ' +
                 '</div> '+   
                '</li>'+
                '<li class="slide">'+
                 '<div class="grid pt10"> '+ 
                     '<div class="col-0 w33 pr10">'+  
                        '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/106" data-name="心血管外科">'+  
                            '<div class="y2" > '+
                                ' <div class="font-s16 pl5 pt5"> '+ 
                                     '心血管外科  '+
                                 '</div> '+ 
                                 '<div class="grid pb5 pr5">'+ 
                                     '<div class="col-1"></div> '+ 
                                     '<div class="col-0 xinxgwk w35p h35p"></div>'+ 
                                 '</div> ' +
                             '</div> '+
                         '</a>'+  
                     '</div>'+ 
                     '<div class="col-0 w33 pl5 pr5"> '+ 
                         '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/109" data-name="耳鼻喉科"> '+ 
                             '<div class="b3" >  '+
                                ' <div class="font-s16 pl5 pt5"> '+ 
                                    '耳鼻喉科 '+ 
                                 '</div>'+  
                                 '<div class="grid pb5 pr5"> '+ 
                                     '<div class="col-1"></div> '+ 
                                     '<div class="col-0 erbhk w35p h35p"></div>'+  
                                ' </div> '+
                             '</div> '+ 
                         '</a> '+ 
                     '</div>  '+
                     '<div class="col-0 w33 pl10"> '+ 
                        '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/107" data-name="整形外科">'+  
                             '<div class="h" > '+
                               '<div class="font-s16 pl5 pt5">  '+
                                    '整形外科 '+
                                 '</div> '+
                                 '<div class="grid pb5 pr5"> '+ 
                                    '<div class="col-1"></div>  '+
                                     '<div class="col-0 zhengxwk w35p h35p"></div>  '+
                                 '</div> '+
                            '</div>'+ 
                         '</a> ' +
                    '</div> '+
                 '</div> '+ 
                ' <div class="grid mt15"> '+ 
                     '<div class="col-1 w33 pr10">' + 
                         '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/110" data-name="颌面外科"> '+ 
                            ' <div class="b4" >  '+
                                '<div class="font-s16 pl5 pt5"> '+ 
                                   ' 颌面外科  '+
                                 '</div> '+
                                 '<div class="grid pb5 pr5">'+  
                                    '<div class="col-1"></div>  '+
                                    '<div class="col-0 hemwk w35p h35p"></div> '+
                                 '</div>  '+
                             '</div>'+  
                         '</a> '+ 
                     '</div>'+  
                     '<div class="col-1 w33 pl5 pr5">'+  
                         '<a class="departmentcontent" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/111" data-name="妇科">'+  
                             '<div class="o2" > '+
                                 '<div class="font-s16 pl5 pt5"> ' +
                                     '妇科 '+
                                ' </div> ' +
                                 '<div class="grid pb5 pr5">'+  
                                    ' <div class="col-1"></div> '+ 
                                    ' <div class="col-0 fuk w35p h35p"></div> '+ 
                                 '</div> ' +
                             '</div> '+
                         '</a> ' +
                     '</div>' + 
                     '<div class="col-1 w33 pl10">' + 
                        ' <a class="departmentcontent" data-name="小儿外科" data-href="<?php echo $urlHospitalTop; ?>/disease_sub_category/112"> '+ 
                            ' <div  class="bg-orange"> '+ 
                                ' <div class="font-s16 pl5 pt5"> ' +
                                   '小儿外科 '+ 
                                ' </div>'+
                                 '<div class="grid pb5 pr5"> '+ 
                                     '<div class="col-1"></div> '+
                                     '<div class="col-0 xiaoewk w35p h35p"></div> ' +
                                 '</div> '+ 
                             '</div>' + 
                         '</a> '+
                     '</div> ' +
                 '</div> '   +
                '</li>';
          
            
         $('#home_article #dpm-bxslider .bxslider1').html(text);

        $('.departmentcontent').click(function () {
            var obj = $(this);
            var name = obj.attr("data-name");
            var url = obj.attr("data-href");
            departmentStat(name);
            window.location = url;
        });

         $(' .bxslider1').bxSlider({
            mode: 'fade',
            slideMargin: 0,
            controls: false,
            auto: true
        });
        

        var height = $('.titleImg').height() - 110;
        $('.titlePosition').css({"margin-top": height + "px"});
    });
</script>