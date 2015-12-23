<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/city.js', CClientScript::POS_END);
?>
<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlDisease = $this->createAbsoluteUrl('/api/list', array('model' => 'disease'));
$urlDoctor = $this->createAbsoluteUrl('/api/list', array('model' => 'doctor'));
$urlCity = $this->createAbsoluteUrl('/api/list', array('model' => 'city'));
$urlExpertteamView = $this->createUrl('expertteam/view', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBooking = $this->createUrl('booking/create');
$urlHomeFindDoctor = $this->createUrl('home/findDoctor');
$this->show_footer = false;
?>
<div id="section_container">
    <section class="active">
        <header class="head-title1">
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="title1"></div>
            <nav class="right btn_city">
                <span class="cityTitle"></span>
                <img class="w25" src="<?php echo $urlResImage ?>image/mark.png">
            </nav>
        </header>
        <article id="sickexpert_article" class="active"  data-scroll="true">
            <div id="diseaseHtml"></div>
            <div id="expertteamHtml"></div>
            <div id="doctorHtml"></div>
        </article>
    </section>
</div>
<script>
    $(document).ready(function () {
        J.showMask();
        //请求专家团队
        var diseaseId = getId('id');
        var requestUrl = '<?php echo $urlDisease; ?>/' + diseaseId + '?api=4&appv=10';
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyDisease(data);
                readyExpertteam(data);
            }
        });
        //请求专家
        var dptId = getId('dptId');
        var cityId = getId('cityId');
        var requestDoctorUrl = '';
        if (cityId == '') {
            requestDoctorUrl = '<?php echo $urlDoctor; ?>?getcount=0&disease=' + diseaseId + '&page=1&api=4';
        } else {
            requestDoctorUrl = '<?php echo $urlDoctor; ?>?getcount=0&disease=' + diseaseId + '&city=' + cityId + '&page=1&api=4';
        }
        $.ajax({
            url: requestDoctorUrl,
            success: function (data) {
                //console.log(data);
                readyDoctor(data);
            }
        });
        //请求城市列表
        $.ajax({
            url: '<?php echo $urlCity; ?>',
            success: function (data) {
                //console.log(data);
                readyCity(data);
            }
        });
        //请求城市

        var url = window.location.href;
        if ((url.indexOf('cityId')) != -1) {
            url = url.substr(0, (url.indexOf('cityId') - 1));
        }
        $cityHtml = '';
        $.ajax({
            url: '<?php echo $urlCity; ?>',
            async: false,
            success: function (data) {
                //console.log(data);
                $cityHtml = readyPage(data, url);
            }
        });
        J.hideMask();


        function readyDisease(data) {
            var disease = data.results.disease;
            var innerHtml = '<div class="color-black bg-gray pt10 pb10 pl5 pr5 text-justify">' + disease.desc + '</div>';
            $('#diseaseHtml').html(innerHtml);
            $('.title1').html(disease.name);
        }
        function readyExpertteam(data) {
            var leader = data.results.leader;
            var team = data.results.team;
            var innerHtml = '';
            if (leader) {
                innerHtml += '<div class="grid mt10">' +
                        '<div class="col-0 w100p">' +
                        '<img class="img80"  src="' + leader.imageUrl + '">' +
                        '</div>' +
                        '<div class="ml10 col-1">' +
                        '<div class="team-name mt10 doctor-title">' + team.name +
                        '</div>' +
                        '<div class="team-hospital mt5 color-gray">' +
                        '<span>' + leader.mTitle + '/' + leader.aTitle + '</span>' +
                        '</div>' +
                        '<div class="team-slogan mt5 color-gray">' + leader.hospital + '</div>' +
                        '</div>' +
                        '<div class="col-1 mt10 mr10 text-right">' +
                        '<a href="<?php echo $urlExpertteamView; ?>/' + team.id + '" data-target="link" class="button reserve_button"  >查看</a>' +
                        '</div>' +
                        '</div>' +
                        '<div class="color-black ml10 mb10 mt10">' +
                        '<img class="honor" src="<?php echo $urlResImage ?>image/honor.png">&nbsp;<span>专家荣誉</span>';
                var honour = leader.honour;
                if (honour.length > 0) {
                    for (var i = 0; i < honour.length; i++) {
                        innerHtml += '<div>' + (i + 1) + '.' + honour[i] + '</div>';
                    }
                } else {
                    innerHtml += '<div>暂无荣耀</div>';
                }
            }
            $('#expertteamHtml').html(innerHtml);
        }
        function readyDoctor(data) {
            var results = data.results;
            var innerHtml = '<div class="team_divider mb20"></div>' +
                    '<div class="bb-black pt10"></div>' +
                    '<div class="list_title mt20 mb20 text-center">' +
                    '<span>推荐专家</span>' +
                    '</div>';
            if (results) {
                for (var i = 0; i < results.length; i++) {
                    var doctor = results[i];
                    innerHtml += '<div class="team_divider"></div>' +
                            '<div class="grid mt10">' +
                            '<div class="col-1 w25 ml7">' +
                            '<img class="img80"  src="' + doctor.imageUrl + '">' +
                            '</div>' +
                            '<div class="ml10 col-1 w50">' +
                            '<div class="team-name mt10 -title font-s15">' + doctor.name;
                    if (doctor.hpDeptName) {
                        innerHtml += '<span class="ml2">' + doctor.hpDeptName + '</span>';
                    }
                    var bookingBtn = '';
                    bookingBtn = doctor.isContracted == 1 ? '<a href="<?php echo $urlBooking; ?>?did=' + doctor.id + '" data-target="link" class="button reserve_button">预约</a>' : '';
                    innerHtml += '</div>' +
                            '<div class="team-hospital mt5 color-gray">' +
                            '<span >' + doctor.mTitle + '/' + doctor.aTitle + '</span>' +
                            '</div>' +
                            '<div class="team-slogan mt5 color-black">' + doctor.hpName +
                            '</div>' +
                            '</div>' +
                            '<div class="col-1 w25 mt10 mr10 text-right">' +
                            bookingBtn+
                            '</div>' +
                            '</div>' +
                            '<div class="color-black ml10 mt10 mr10 mb10 text-justify">擅长:' + doctor.desc + '</div>';
                }
            } else {
                innerHtml += '<div>暂无专家信息</div>';
            }
            $('#doctorHtml').html(innerHtml);
        }
        function readyCity(data) {
            var results = data.results;
            var cityId = getId('cityId');
            var cityName = '';
            if (cityId != '') {
                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var subCity = results[i].subCity;
                        for (var j = 0; j < subCity.length; j++) {
                            if (cityId == subCity[j].id) {
                                cityName = subCity[j].city;
                            }
                        }
                    }
                }
            } else {
                cityName = '北京'
            }
            $('.cityTitle').html(cityName);
        }
        function getId(name) {
            var id = '';
            var url = window.location.search;
            if (url.indexOf('?') != -1) {
                var str = url.substr(1);
                strs = str.split('&');
                for (var i = 0; i < strs.length; i++) {
                    if ((strs[i].split('=')[0]) == name) {
                        id = unescape(strs[i].split('=')[1]);
                    }
                }
            }
            return id;
        }
    });
</script>