<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHospitalView = $this->createAbsoluteUrl('/api/list', array('model' => 'hospital'));

$urlHospitalDept = $this->createUrl('hospital/dept', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<div id="section_container">
    <section id="hdetail_section" class="active" data-init="true">
        <header class="head-title1">
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="title1"></div>
        </header>
        <article id="expert_list_article" class="active articleHtml"  data-scroll="true">
            <ul class="list dpt">

            </ul>
        </article>
    </section>
</div>
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
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/4.png">';
                } else if (dpt == '外科') {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/1.png">';
                } else if (dpt == '妇产科') {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/5.png">';
                } else if (dpt == '眼科') {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/3.png">';
                } else if (dpt == '骨科') {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/2.png">';
                } else if (dpt == '小儿外科') {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/6.png">';
                } else {
                    innerHtml += '<img src="<?php echo $urlResImage ?>/image/1/7.png">';
                }
                innerHtml += '<span class="text18 color-green">' + dpt + '</span>' +
                        '</div>' +
                        '<div class="dptStyle">';
                for (var i = 0; i < departments[dpt].length; i++) {
                    innerHtml += '<a href="<?php echo $urlHospitalDept ?>/' + departments[dpt][i].id + '" data-target="link">' +
                            '<div  class="color-black ml10 button2">' + departments[dpt][i].name + '</div>' +
                            '</a>';
                }
                innerHtml += '</div></li>';

            }
        }
        innerHtml += '</ul>';
        $('.title1').html(hospital.name);
        $('.articleHtml').html(innerHtml);
    }
    function getHospitalId() {
        var url = window.location.href;
        var id = url.substr(url.lastIndexOf('/') + 1, url.length);
        return id;
    }
</script>