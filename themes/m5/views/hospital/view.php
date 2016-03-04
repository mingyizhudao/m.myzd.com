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
        <a href="#" data-icon="previous" data-target="back"></a>
    </nav>
    <h1 class="title"></h1>
</header>
<article id="hospitalView_article" class="active articleHtml"  data-scroll="true">
    <ul class="list dpt">

    </ul>
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
        innerHtml = '<ul class="list dpt">';
        if (departments != null) {
            for (var dpt in departments) {
                innerHtml += '<li><div class="mb5">';
                if (dpt == '口腔科') {
                    innerHtml += '<span class="kouQ text18 color-green mt5">' + dpt + '</span>';
                } else if (dpt == '外科') {
                    innerHtml += '<span class="waiK text18 color-green mt5">' + dpt + '</span>';
                } else if (dpt == '妇产科') {
                    innerHtml += '<span class="fuC text18 color-green mt5">' + dpt + '</span>';
                } else if (dpt == '眼科') {
                    innerHtml += '<span class="yanK text18 color-green mt5">' + dpt + '</span>';
                } else if (dpt == '骨科') {
                    innerHtml += '<span class="guK text18 color-green mt5">' + dpt + '</span>';
                } else if (dpt == '小儿外科') {
                    innerHtml += '<span class="xiaoE text18 color-green mt5">' + dpt + '</span>';
                } else {
                    innerHtml += '<span class="other text18 color-green mt5">' + dpt + '</span>';
                }
                innerHtml += '</div>' +
                        '<div class="dptStyle">';
                for (var i = 0; i < departments[dpt].length; i++) {
                    innerHtml += '<a href="<?php echo $urlDepartmentView ?>/' + departments[dpt][i].id + '" data-target="link">' +
                            '<div  class="color-black ml10 button2">' + departments[dpt][i].name + '</div>' +
                            '</a>';
                }
                innerHtml += '</div></li>';

            }
        }
        innerHtml += '</ul>';
        if (hospital.name.length > 15) {
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