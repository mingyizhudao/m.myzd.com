<?php
$urlHome = $this->getHomeUrl();
$urlHuizhen = $this->createUrl('huizhen/index');
$urlHospital = $this->createUrl('hospital/index');
$urlOverseas = $this->createUrl('overseas/index');
$urlContactus = $this->createUrl('app/contactus');
?>
<div data-role="footer" data-tap-toggle="false" data-position="fixed" class="ui-footer ui-footer-fixed slideup">   
    <div data-role="navbar" class="ui-navbar" role="navigation">
        <ul class="ui-grid-d">
       <!--     <li class="ui-block-a"><a href="<?php echo $urlHome; ?>" data-prefetch="true" data-transition="slidefade" data-icon="home" data-title="首页">首页</a></li>-->
            <li class="ui-block-a"><a id="f-nav-home" href="<?php echo $urlHome; ?>" xrel="external" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-home nobg">首页</a></li>
            <li class="ui-block-b"><a id="f-nav-huizhen" href="<?php echo $urlHuizhen; ?>" xrel="external" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top  m-icon-cloud nobg">看名医</a></li>
            <li class="ui-block-c"><a id="f-nav-hospital" href="<?php echo $urlHospital; ?>" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-hospital nobg">专属医院</a></li>
            <li class="ui-block-d"><a id="f-nav-overseas" href="<?php echo $urlOverseas; ?>" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-globe nobg">海外医疗</a></li>
            <li class="ui-block-e"><a id="f-nav-contactus" href="<?php echo $urlContactus; ?>" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-call nobg">联系</a></li>
        </ul>
    </div>
</div>