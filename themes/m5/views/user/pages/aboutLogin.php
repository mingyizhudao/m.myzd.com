<?php
$this->setPageID('pMobile');
$this->setPageTitle('关于注册/登录');
$showHeader = Yii::app()->request->getQuery('header', 1);
// $urlUserIndex = $this->createUrl('user/index', array('pages' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>

<?php if ($showHeader == 1) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">关于注册/登录</h1>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 text-justify">
        <div class="pt25 font-s16">
            1.如何注册名医主刀账号？
        </div>
        <div class="pt10 color-black6">
            名医主刀仅支持手机号注册，点击“注册”-输入常用手机号码，点击“获取验证码”-输入短信中的验证码-设置密码-点击“注册登录”。
        </div>
        <div class="pt25 font-s16">
            2.一个手机号能注册几个用户？
        </div>
        <div class="pt10 color-black6">
            一个手机号只能注册一个账户。
        </div>
        <div class="pt25 font-s16">
            3.为什么注册不成功，提示"手机号已被注册"？
        </div>
        <div class="pt10 color-black6">
            一个手机号只能被注册一次，该提示说明您的手机号已经注册过，不能再次注册。建议直接使用该手机号登录，可以在登录界面点击“获取验证码”，之后通过验证码登录。如仍不成功，请您拨打名医主刀客服电话400-6277-120，我们将为您解决。
        </div>
        <div class="pt25 font-s16">
            4.一直收不到验证码或提示"验证码错误"？
        </div>
        <div class="pt10 color-black6">
            （1）请确认您的手机是否有存在短信屏蔽或者黑名单设置等情况，修改设置后查看是否可以正常接收；
        </div>
        <div class="pt10 color-black6">
            （2）验证码的有效时间为60秒，过时将自动失效；
        </div>
        <div class="pt10 color-black6">
            （3）如果验证码填写正确且在有效时间内，还是一直提示验证码填写错误，建议您清除缓存后重试或卸载名医主刀重新安装；
        </div>
        <div class="pt10 color-black6">
            （4）若以上都不成功，请您拨打名医主刀客服电话400-6277-120。我们将为您解决。
        </div>
        <div class="pt25 font-s16">
            5.登录方式有哪几种？（适用于网站）
        </div>
        <div class="pt10 color-black6 pb30">
            目前平台支持两种登录方式：手机号快速登录和账号密码登录。 您可以直接输入手机号并填写获取到的验证码（如果您尚未注册过，即默认您注册了名医主刀平台，以后每次通过获取验证码登录）。第二种方式是，如果您以前设置过账号密码（账号为您的手机号），您可以使用账号密码登录，免去每次获取验证码的麻烦。
        </div>
    </div>
</article>