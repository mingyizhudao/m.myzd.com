<?php
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');
$showHeader = Yii::app()->request->getQuery('header', 1);
$showApp = Yii::app()->request->getQuery('app', 1);
if ($showApp == 0) {
    $urlAboutLogin = $this->createUrl('user/index', array('page' => 'aboutLogin', 'header' => 0));
    $urlAboutBooking = $this->createUrl('user/index', array('page' => 'aboutBooking', 'header' => 0));
    $urlAboutCost = $this->createUrl('user/index', array('page' => 'aboutCost', 'header' => 0));
    $urlAboutPlatform = $this->createUrl('user/index', array('page' => 'aboutPlatform', 'header' => 0));
    $urlAboutAgreement = $this->createUrl('user/index', array('page' => 'aboutAgreement', 'header' => 0));
} else {
    $urlAboutLogin = $this->createUrl('user/index', array('page' => 'aboutLogin'));
    $urlAboutBooking = $this->createUrl('user/index', array('page' => 'aboutBooking'));
    $urlAboutCost = $this->createUrl('user/index', array('page' => 'aboutCost'));
    $urlAboutPlatform = $this->createUrl('user/index', array('page' => 'aboutPlatform'));
    $urlAboutAgreement = $this->createUrl('user/index', array('page' => 'aboutAgreement'));
}
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php if ($showHeader == 1) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">常见问题</h1>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article class="active" data-scroll="true">
    <div>
        <ul class="list">
            <li>
                <a class="font-s16" href="<?php echo $urlAboutLogin; ?>">
                    1.关于注册/登录
                </a>
            </li>
            <li>
                <a class="font-s16" href="<?php echo $urlAboutBooking; ?>">
                    2.关于预约
                </a>
            </li>
            <li>
                <a class="font-s16" href="<?php echo $urlAboutCost; ?>">
                    3.关于费用
                </a>
            </li>
            <li>
                <a class="font-s16" href="<?php echo $urlAboutPlatform; ?>">
                    4.关于平台
                </a>
            </li>
            <li>
                <a class="font-s16" href="<?php echo $urlAboutAgreement; ?>">
                    5.名医主刀服务协议
                </a>
            </li>
        </ul>
    </div>
</article>