<?php
/**
 * $data.
 */
$this->setPageID('pMobile');
$this->setPageTitle('名医主刀');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlAboutus = $this->createUrl('home/page', array('view' => 'aboutus'));
$urlLogout = $this->createUrl('user/logout');
$urlUserView = $this->createUrl('user/view');
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$urlUserCommonProblem = $this->createUrl('user/commonProblem');
?>
<style>
    .w8p{width:8px;}
    .w19p{width:19px;}
    .w21p{width:21px;}
    .w23p{width:23px;}
    .w26p{width:26px;}

    header#user_header{
        border-bottom: inherit;
    }
    #user_article .orderNext{
        background: url('<?php echo $urlResImage; ?>nextGray.png') no-repeat;
        background-size: 9px;
        background-position: 95% 50%;
    }
    #user_article .nextImg{
        background: url('<?php echo $urlResImage; ?>nextBlack.png') no-repeat;
        background-size: 8px;
        background-position: 95% 50%;
    }
    #user_article .bookingOrder{
        background: url('<?php echo $urlResImage; ?>bookingOrder.png') no-repeat;
        background-size:26px;
        padding: 3px 0px 1px 35px;
    }

</style>
<header id="user_header" class="bg-green">
    <h1 class="title color-white">个人中心</h1>
</header>
<article id="user_article" data-active="user_footer" class="active"  data-scroll="true">
    <div>
        <div class="bg-green">
            <div class="grid font-s16 w100 pt20 pb20">
                <div class="col-0 w80p ml30 mr30">
                    <img src="<?php echo $urlResImage ?>headImg.png" class="w80p">
                </div>
                <div class="col-1 vertical-center color-white">
                    您好,<?php echo $user->username; ?>
                </div>
            </div>
        </div>
        <div class="bb10-gray"></div>
        <div class="grid pad10 bb-gray orderNext">
            <div class="col-1 w60 font-s15 bookingOrder">
                手术预约单
            </div>
            <div class="grid col-1 w40 text-right">
                <div class="col-1"></div>
                <a href="<?php echo $urlPatientBookingList; ?>" class="color-gray">
                    <div class="col-0 pr20 pt5">全部订单</div>
                </a>
            </div>
        </div>
        <div class="grid text-center pt10 pb10">
            <div class="col-1 w25">
                <a href="<?php echo $urlPatientBookingList; ?>?status=1">
                    <div>
                        <img src="<?php echo $urlResImage; ?>waitPay.png" class="w19p">
                    </div>
                    <div class="color-gray pt3">
                        待支付
                    </div>
                </a>
            </div>
            <div class="col-1 w25">
                <a href="<?php echo $urlPatientBookingList; ?>?status=2">
                    <div>
                        <img src="<?php echo $urlResImage; ?>arrangementIn.png" class="w23p">
                    </div>
                    <div class="color-gray">
                        安排中
                    </div>
                </a>
            </div>
            <div class="col-1 w25">
                <a href="<?php echo $urlPatientBookingList; ?>?status=3">
                    <div>
                        <img src="<?php echo $urlResImage; ?>waitConfirm.png" class="w19p">
                    </div>
                    <div class="color-gray pt1">
                        待确认
                    </div>
                </a>
            </div>
            <div class="col-1 w25">
                <a href="<?php echo $urlPatientBookingList; ?>?status=4">
                    <div>
                        <img src="<?php echo $urlResImage; ?>waitEvaluate.png" class="w21p">
                    </div>
                    <div class="color-gray pt1">
                        待评价
                    </div>
                </a>
            </div>
        </div>
        <div class="bb10-gray"></div>
        <a href='<?php echo $urlUserCommonProblem; ?>'>
            <div class="pad10 color-black nextImg grid">
                <div class="col-0">
                    <img src="<?php echo $urlResImage; ?>commonProblem.png" class="w26p">
                </div>
                <div class="col-1 pl10 pt2 font-s16">
                    常见问题
                </div>
            </div>
        </a>
        <div class="bb10-gray"></div>
        <a id="aboutus">
            <div class="pad10 color-black nextImg grid">
                <div class="col-0">
                    <img src="<?php echo $urlResImage; ?>aboutUs.png" class="w26p">
                </div>
                <div class="col-1 pl10 pt2 font-s16">
                    关于我们
                </div>
            </div>
        </a>
        <a href=''>
            <div class="pad10 color-black nextImg grid hide">
                <div class="col-0">
                    <img src="<?php echo $urlResImage; ?>service.png" class="w26p">
                </div>
                <div class="col-1 pl10 pt2 font-s16">
                    服务介绍
                </div>
            </div>
        </a>
        <div class="bb10-gray"></div>
        <a id="contactUs">
            <div class="pad10 color-black nextImg grid">
                <div class="col-0">
                    <img src="<?php echo $urlResImage; ?>contactService.png" class="w26p">
                </div>
                <div class="col-1 pl10 pt2 font-s16">
                    联系客服
                </div>
            </div>
        </a>
        <a id="btn_actionsheet1">
            <div class="pad10 color-black nextImg grid">
                <div class="col-0">
                    <img src="<?php echo $urlResImage; ?>exitLogin.png" class="w20p ml2">
                </div>
                <div class="col-1 pl10 pt2 font-s16">
                    退出登录
                </div>
            </div>
        </a>
    </div>
</article>
<script>
    $("#btn_actionsheet1").tap(function () {
//        J.confirm('退出', '您确定要退出该账号？', function () {
//            location.href = '<?php //echo $urlLogout;   ?>';
//        }, function () {
//            setTimeout(function () {
//                location.href = '<?php //echo $urlUserView;   ?>';
//            }, 200);
//        });
        J.customConfirm('退出',
                '<div class="mb10">您确定要退出该账号？</div>',
                '<a id="closeLogout" class="w50">取消</a>',
                '<a data="ok" class="color-green w50">暂不参与</a>',
                function () {
                    location.href = '';
                });
        $('#closeLogout').click(function () {
            J.closePopup();
        });
    });
    $('#aboutus').tap(function () {
        location.href = '<?php echo $urlAboutus; ?>';
    });
    $('#contactUs').tap(function () {
        J.popup({
            html: '<ul class="list text-center"><li>拨打名医主刀热线</li><li><a href="tel://4001197900">400-119-7900</a></li><li><a id="close">取消</a></li></ul>',
            pos: 'bottom',
            showCloseBtn: false
        });
        $('#close').click(function () {
            J.closePopup();
        });
    });

</script>