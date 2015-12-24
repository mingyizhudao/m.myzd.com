<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images";
$urlAboutus = $this->createUrl('home/page',array('view'=>'aboutus'));
$urlLogout = $this->createUrl('user/logout');
?>
<div id="section_container" class="mb51">
    <section id="personal_section" class="active" data-active="center">
        <header class="head-title">
            <div class="title color-green">个人中心</div>
        </header>
        <article id="login_article" class="active"  data-scroll="true">
            <div>
                <div class="person-header">
                    <img class="img80" src="<?php echo $urlResImage ?>/image/p.png">
                    <div class="per-login-phone">您好,<?php echo $user->userName; ?></div>
                </div>
                <ul class="list person-list">
                    <li>
                        <a data-target="link" href="<?php echo $this->createUrl('booking/patientBookingList') ?>">
                            <img class="pl20" src="<?php echo $urlResImage ?>/image/reserve.png">
                            <span class="pl20 color-black text18">预约单</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $urlAboutus; ?>" data-target="link">
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
                    <li>
                        <a id="btn_actionsheet1">
                            <img class="pl20" src="<?php echo $urlResImage ?>/image/reserve.png">
                            <span class="pl20 color-black text18">退出登录</span>
                        </a>
                    </li>
                </ul>
            </div>
        </article>
    </section>
</div>
<script>
    $("#btn_actionsheet1").tap(function () {
        J.confirm('退出', '您确定要退出该账号？', function () {
            location.href = '<?php echo $urlLogout; ?>';
        },function(){
            
        });
    });
    $('#contactUs').tap(function () {
        J.Popup.actionsheet([{
                text: '拨打名医主刀热线',
            }, {
                text: '400-119-7900',
            }
        ]);
    });
</script>