<?php
$urlHome = $this->getHomeUrl();
$urlExpertteam = $this->createUrl('expertteam/index');
$urlHospital = $this->createUrl('expertteam/index');
$urlOverseas = $this->createUrl('overseas/index');
$urlEnquiry = $this->createUrl('app/enquiry');
?>
<div data-role="footer" data-tap-toggle="false" data-position="fixed" class="ui-footer ui-footer-fixed slideup">   
    <div data-role="navbar" class="ui-navbar" role="navigation">
        <ul class="ui-grid-c">
       <!--     <li class="ui-block-a"><a href="<?php echo $urlHome; ?>" data-prefetch="true" data-transition="slidefade" data-icon="home" data-title="首页">首页</a></li>-->
            <li class="ui-block-a"><a id="f-nav-home" href="<?php echo $urlHome; ?>" data-ajax=false xrel="external" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-home nobg">预约手术</a></li>
            <li class="ui-block-b"><a id="f-nav-expertteam" href="<?php echo $urlExpertteam; ?>" data-ajax=false xrel="external" data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top  m-icon-cloud nobg">明星团队</a></li>
            <li class="ui-block-c"><a id="f-nav-overseas" href="<?php echo $urlOverseas; ?>" data-ajax=false data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-globe nobg">海外医疗</a></li>
            <li class="ui-block-d"><a id="f-nav-contactus" href="<?php echo $urlEnquiry; ?>" data-ajax=false data-prefetch="true" data-transition="slidefade" class="ui-link ui-btn ui-btn-icon-top m-icon-call nobg">快速预约</a></li>
        </ul>
    </div>
</div>