<?php
/**
 * $data.
 */
$this->setPageTitle('合作医院');
$urlHospitalView = $this->createAbsoluteUrl('/api/list', array('model' => 'hospital'));
$urlDepartmentView = $this->createUrl('department/view', array('id' => ''));
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
    <h1 class="title"></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article id="hospitalView_article" class="active articleHtml articleBg" data-scroll="true">
    <div>

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
        J.hideMask();
    });
    function readyPage(data) {
        var hospital = data.results.hospital;
        var departments = data.results.departments;
        innerHtml = '<div>';
        if (departments != null) {
            for (var dpt in departments) {
                innerHtml += '<div class="mt5 bg-white"><div class="grid pad10 bb-gray">';
                if (dpt == '内科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302535750635" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '外科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302539369261" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '妇产科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302542491035" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '骨科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302546159954" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '小儿外科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146303115932864" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else if (dpt == '五官科') {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146303121523753" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                } else {
                    innerHtml += '<div class="col-0">' +
                            '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302535750635" class="w25p">' +
                            '</div>' +
                            '<div class="col-1 pl5 font-s16">' + dpt + '</div>';
                }
                innerHtml += '</div>' +
                        '<div class="dptStyle pad10">';
                for (var i = 0; i < departments[dpt].length; i++) {
                    innerHtml += '<a href="<?php echo $urlDepartmentView ?>/' + departments[dpt][i].id + '" data-target="link">' +
                            '<div class="ml20 button2">' + departments[dpt][i].name + '</div>' +
                            '</a>';
                }
                innerHtml += '</div></div>';

            }
        }
        innerHtml += '</div>';
        if (hospital.name.length > 13) {
            $('.title').addClass('font-s16');
        }
        $('.title').html(hospital.name);
        $('.articleHtml').html(innerHtml);
    }
    function getHospitalId() {
        var url = window.location.href;
        var id = url.substr(url.lastIndexOf('/') + 1, url.length);
        return id;
    }
</script>