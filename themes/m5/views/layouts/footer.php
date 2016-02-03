<?php
$urlExpertteam = $this->createUrl('expertteam/index');
$urlHospital = $this->createUrl('hospital/index');
$urlBooking = $this->createUrl('booking/create');

$urlHomeIndex = $this->createUrl('home/index');
$urlHospitalIndex = $this->createUrl('hospital/index');
$urlEventIndex = $this->createUrl('event/index');
$urlUserView = $this->createUrl('user/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>
<footer>
    <ul class="control-group w100">
        <li class="w25" data-active="home_footer">
            <a href="<?php echo $urlHomeIndex; ?>">
                <div class="imgHome">
                </div>
                首页
            </a>
        </li>
        <li class="w25" data-active="hospital_footer">
            <a href="<?php echo $urlHospitalIndex; ?>?city=1">
                <div class="imgHospital">
                </div>
                推荐医院
            </a>
        </li>
        <li class="w25" data-active="find_footer">
            <a href="<?php echo $urlEventIndex; ?>">
                <div class="imgFind">
                </div>
                发现
            </a>
        </li>
        <li class="w25" data-active="user_footer">
            <a href="<?php echo $urlUserView; ?>">
                <div class="imgCenter">
                </div>
                个人中心
            </a>
        </li>
    </ul>
</footer>
<script>
    /*新页面，自动给footer中添加active*/
    $(document).ready(function () {
        var active = $('article').attr('data-active');

        $('footer li').each(function () {
            if ($(this).attr('data-active') == active) {
                $(this).addClass('active');
            }
        });
    });
</script>