<?php
/**
 * $data.
 */
$this->setPageTitle('合作医院');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlDept = $this->createAbsoluteUrl('/api/list', array('model' => 'hospitaldept'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlBooking = $this->createUrl('booking/create');
$this->show_footer = false;
?>
<div id="section_container">
    <section id="everyke_section" data-init="true" class="active">
        <header class="head-title1" >
            <nav class="left">
                <a href="#" data-icon="previous" data-target="back"></a>
            </nav>
            <div class="title1">

            </div>
        </header>
        <article id="expert_list_article" class="active articleHtml" data-scroll="true">
            <ul class="list">

            </ul>
        </article>
    </section>
</div>
<script>
    $(document).ready(function () {
        J.showMask();
        var id = getDeptId();
        var requestUrl = '<?php echo $urlDept; ?>/' + id + '?appv=1&api=5&page=1';
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
        var department = data.results.department;
        var doctors = data.results.doctors;
        innerHtml = '<ul class="list">';
        if (doctors != null) {
            for (var i = 0; i < doctors.length; i++) {
                var bookingBtn = '<a href="' + '<?php echo $urlBooking; ?>' + '?did=' + doctors[i].id + '" data-target="link" class="reserve_button button" ><span>预约</span></a>';
                //bookingBtn = doctors[i].isContracted == 0?'':'<a href="' + '<?php echo $urlBooking; ?>' + '?did=' + doctors[i].id + '" data-target="link" class="reserve_button button" ><span>预约</span></a>';
                innerHtml += '<li class="divider-green">' +
                        '<div class="grid">' +
                        '<div class="col-1 w25">' +
                        '<img class="img80"  src="' + doctors[i].imageUrl + '">' +
                        '</div>' +
                        '<div class="ml10 col-1 w50">' +
                        '<div class="team-name mt10 doctor-title">' + doctors[i].name + '</div>' +
                        '<div class="team-hospital mt20">' +
                        '<span class="color-gray">' + doctors[i].mTitle + '/' + doctors[i].aTitle + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-1 mt10 w25 text-right">' +
                        bookingBtn +
                        '</div>' +
                        '</div>' +
                        '<div class="color-black ml10 text-justify">擅长:' + doctors[i].desc + '</div>' +
                        '</li>';
            }
        } else {
            innerHtml += '<li>暂无信息</li>';
        }
        innerHtml += '</ul>';
        $('.title1').html(department.name);
        $('.articleHtml').html(innerHtml);
    }
    function getDeptId() {
        var url = window.location.href;
        var id = url.substr(url.lastIndexOf('/') + 1, url.length);
        return id;
    }
</script>