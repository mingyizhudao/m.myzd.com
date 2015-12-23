<?php
$urlHome = $this->createUrl('home/index');
$urlExpertteam = $this->createUrl('expertteam/index');
$urlHospital = $this->createUrl('hospital/index');
$urlBooking = $this->createUrl('booking/create');
$urlLogin = $this->createUrl('user/personal');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>
<footer class="bg-white m-footer-area">
    <div class="grid" style="width:100%;height:100%;">
        <div class="col-1">
            <a id="f-nav-home" href="<?php echo $this->createUrl('home/index') ?>" data-target="link" >
                <div class="color-gray m-icon-home text-center footer-active pb5" data-active="home">名医主刀</div>
            </a>
        </div>
        <div class="col-1">
            <a id="f-nav-expertteam" href="<?php echo $this->createUrl('expertteam/index') ?>" data-target="link" >
                <div class="color-gray m-icon-expert text-center footer-active" data-active="expertteam">明星团队</div>
            </a>
        </div>
        <div class="col-1">     
            <a id="f-nav-hospital" href="<?php echo $this->createUrl('hospital/index') ?>" data-target="link" >
                <div class="color-gray m-icon-hospital text-center footer-active" data-active="hospital">合作医院</div>
            </a>
        </div>
        <div class="col-1">     
            <a  id="f-nav-account" href="<?php echo $this->createUrl('user/login') ?>" data-target="link" >
                <div class="color-gray m-icon-center text-center footer-active" data-active="center">个人中心</div>
            </a>
        </div>
    </div>
</footer>
<script>
    /*新页面，自动给footer中添加active*/
    $(document).ready(function () {
        var active = $('section').attr('data-active');

        $('.footer-active').each(function () {
            if ($(this).attr('data-active') == active) {
                $(this).addClass('active');
            }
        });
    });
</script>