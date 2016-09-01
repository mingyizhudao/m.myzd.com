<?php
/**
 * $data.
 */
//$hospital = $data->results->hospital;
//var_dump($data);die;
$this->setPageTitle('手术预约,床位预约,专家预约,哪个医生好_名医主刀网移动版');
$this->setPageKeywords('手术预约,哪个医生好');
$urlHospitalView = $this->createAbsoluteUrl('/api/list', array('model' => 'hospital'));
$urlDepartmentView = $this->createUrl('department/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>

<header id="hospitalView_header" class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title"></h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<article id="hospitalView_article" class="active articleHtml bg-gray" data-scroll="true">
    <div>
        <div class="bg-green color-white text-center">
            <div id="hosName" class="font-s18">
            </div>
            <div id="hosGrade" class="pt5 pb10 grid">
            </div>
        </div>
        <div class="grid pageIcon bg-white">
            <div class="col-1 w50 cardSelect active" data-card="dpet">
                最强科室
            </div>
            <div class="col-1 w50 cardSelect" data-card="hospital">
                医院介绍
            </div>
        </div>
        <div id="hosDept" class="pageCard" data-card="dpet">
        </div>
        <div id="hosDescription" class="pt20 pb20 pr10 pl10 text-justify bg-white hide pageCard" data-card="hospital">
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        J.showMask();
        var id = getHospitalId();
        var requestUrl = '<?php echo $urlHospitalView; ?>/' + id + '?api=4&appv=10';
        $.ajax({
            url: requestUrl,
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });
        $('.cardSelect').click(function () {
            var dataCard = $(this).attr('data-card');
            $('.cardSelect').each(function () {
                if (dataCard == $(this).attr('data-card')) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
            $('.pageCard').each(function () {
                if (dataCard == 'hospital') {
                    $('#hospitalView_article').removeClass('bg-gray');
                } else {
                    $('#hospitalView_article').addClass('bg-gray');
                }
                if (dataCard == $(this).attr('data-card')) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                }
            });
            $('#hospitalView_article').scrollTop(0);
        });
    });
    function readyPage(data) {
        var hospital = data.results.hospital;
        console.log(hospital);
        var departments = data.results.departments;
        innerHtml = '<div>';
        if (departments != null) {
            for (var dpt in departments) {
                innerHtml += '<div class="mt5 bg-white"><div class="grid pad10 bb-gray">';
                if (dpt == '内科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146302535750635" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '外科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146302539369261" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '妇产科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146302542491035" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '骨科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146302546159954" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '小儿外科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146303115932864" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '五官科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146303121523753" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://static.mingyizhudao.com/146302535750635" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                }
                innerHtml += '</div>' +
                        '<div class="dptStyle pad10">';
                for (var i = 0; i < departments[dpt].length; i++) {
                    innerHtml += '<a href="<?php echo $urlDepartmentView ?>/id/' + departments[dpt][i].id + '" data-target="link">' +
                            '<div class="ml20 button2">' + departments[dpt][i].name + '</div>' +
                            '</a>';
                }
                innerHtml += '</div></div>';
            }
        }
        innerHtml += '</div>';
        if (hospital.ShortName.length > 13) {
            $('.title').addClass('font-s16');
        }
        $('#hosName').html(hospital.ShortName);
        var hosGrade = '<div class="col-1"></div>' +
                '<div id="hosClass" class="col-0 pr5">' + hospital.class.substr(0, 2) + '</div>';
        if (hospital.type != '') {
            hosGrade += '<div class="col-0 br-white mt5 mb5"></div>' +
                    '<div id="hosType" class="col-0 pl5">' + hospital.type.substr(0, 2) + '</div>';
        }
        hosGrade += '<div class="col-1"></div>';
        $('#hosGrade').html(hosGrade);
        if (hospital.description != '') {
            $('#hosDescription').html(hospital.description);
        } else {
            var noInformation = '<div class="text-center">' +
                    '<img src="http://static.mingyizhudao.com/146295490734874" class="w170p pt30">' +
                    '<div class="font-s30 color-gray9 pt10">暂无信息</div>' +
                    '</div>';
            $('#hosDescription').html(noInformation);
        }
        $('#hosDept').html(innerHtml);
        J.hideMask();
    }
    function getHospitalId() {
        var url = window.location.href;
        var id = url.substr(url.lastIndexOf('-') + 1, url.length).split('.html')[0];
        return id;
    }
</script>