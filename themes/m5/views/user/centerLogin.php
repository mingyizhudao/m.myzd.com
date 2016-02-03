<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlHospital = $this->createUrl('hospital/index', array('addBackBtn' => 1));
$urlOverseas = $this->createUrl('overseas/index', array('addBackBtn' => 1));

$furl = $this->createUrl('faculty/view');
$tUrl = $this->createUrl('expertteam/view');


$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlLogin = $this->createUrl('user/login');
?>
<div id="section_container">
    <section id="centerLogin_section" class="active" data-active="center">
        <header class="head-title">
            <div class="title color-green">
                个人中心
            </div>
        </header>
        <article id="centerLogin_article" class="active" data-scroll="true">
            <div>
                <div class="person-header">
                    <a href="<?php echo $urlLogin; ?>" data-target="link">
                        <img class="img80" src="<?php echo $urlResImage ?>/image/p.png">
                    </a>
                    <div class="per-login-phone">您好,请登录</div>
                </div>
                <ul class="list person-list">
                    <li>
                        <a data-target="link" href="<?php echo $this->createUrl('booking/patientBookingList') ?>">
                            <img class="pl20" src="<?php echo $urlResImage ?>/image/reserve.png">
                            <span class="pl20 color-black text18">预约单</span>
                        </a>
                    </li>
                    <li>
                        <a href="aboutus" data-target="link">
                            <img class="pl20" src="<?php echo $urlResImage ?>/image/serve.png">
                            <span class="pl20 color-black text18">关于我们</span>
                        </a>
                    </li>
                    <li>
                        <a id="contactUs">
                            <img class="pl20" src="<?php echo $urlResImage ?>/image/phone.png">
                            <span class="pl20 color-black text18" >客服电话</span>
                        </a>
                    </li>
                </ul>
            </div>
        </article>
    </section>
</div>