<?php
$urlHome = $this->createUrl('home/index');
$urlExpertteam = $this->createUrl('expertteam/index');
$urlHospital = $this->createUrl('hospital/index');
$urlBooking = $this->createUrl('booking/create');
$urlLogin = $this->createUrl('user/login');
?>
<div data-role="footer" data-tap-toggle="false" data-position="fixed" class="ui-footer ui-footer-fixed slideup">   
    <div data-role="navbar" class="ui-navbar" role="navigation">
        <ul class="ui-grid-c">
       <!--     <li class="ui-block-a"><a href="<?php echo $urlHome; ?>" data-prefetch="true" data-transition="slidefade" data-icon="home" data-title="首页">首页</a></li>-->
            <li class="ui-block-a"><a id="f-nav-home" href="<?php echo $urlHome; ?>" xrel="external" data-ajax="false" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-home nobg">名医主刀</a></li>
            <li class="ui-block-b"><a id="f-nav-expertteam" href="<?php echo $urlExpertteam; ?>" data-ajax="true" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top  m-icon-cloud nobg">明星团队</a></li>
            <li class="ui-block-c"><a id="f-nav-hospital" href="<?php echo $urlHospital; ?>" data-ajax="false"  data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-globe nobg">推荐医院</a></li>
            <li class="ui-block-d"><a id="f-nav-account" href="<?php echo $urlLogin; ?>" data-ajax="false"  data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-call nobg">个人中心</a></li>
        </ul>
    </div>
</div>