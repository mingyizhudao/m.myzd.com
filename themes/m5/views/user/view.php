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
$urlMygy = $this->createUrl('event/view', array('page' => 'mygy'));
?>
<header id="user_header" class="bg-green">
    <h1 class="title color-white">个人中心</h1>
</header>
<article id="user_article" data-active="user_footer" class="active"  data-scroll="true">
    <div>
        <div class="bg-green">
            <div class="w100 pt20 pb10 text-center">
                <img src="<?php echo $urlResImage ?>headImg.png" class="w80p">
            </div>
            <div class="font-s16 text-center color-white pb10">
                您好,<?php echo $user->username; ?>
            </div>
        </div>
        <div class="bg-white">
            <div class="grid pad10 bb-gray orderNext">
                <div class="col-1 w60 font-s15">
                    全部订单
                </div>
                <div class="grid col-1 w40 text-right">
                    <div class="col-1"></div>
                    <a href="<?php echo $urlPatientBookingList; ?>" class="color-gray">
                        <div class="col-0 pr20">查看全部订单</div>
                    </a>
                </div>
            </div>
            <?php
            $waitPayNum = 0;
            $arrangementInNum = 0;
            $waitConfirmNum = 0;
            $waitEvaluateNum = 0;
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]->bkStatus == 1) {
                    $waitPayNum = $data[$i]->num;
                } else if ($data[$i]->bkStatus == 2) {
                    $arrangementInNum = $data[$i]->num;
                } else if ($data[$i]->bkStatus == 5) {
                    $waitConfirmNum = $data[$i]->num;
                } else if ($data[$i]->bkStatus == 6) {
                    $waitEvaluateNum = $data[$i]->num;
                }
            }
            ?>
            <div class="grid text-center pt10 pb10">
                <div class="col-1 w25">
                    <a href="<?php echo $urlPatientBookingList; ?>?status=1">
                        <div class="waitPay">
                            <?php
                            if ($waitPayNum != 0) {
                                ?>
                                <div class="grid">
                                    <div class="col-1"></div>
                                    <div class="col-0 dataNum">
                                        <?php echo $waitPayNum; ?>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="color-gray pt10">
                            待支付
                        </div>
                    </a>
                </div>
                <div class="col-1 w25">
                    <a href="<?php echo $urlPatientBookingList; ?>?status=2">
                        <div class="arrangementIn">
                            <?php
                            if ($arrangementInNum != 0) {
                                ?>
                                <div class="grid">
                                    <div class="col-1"></div>
                                    <div class="col-0 dataNum">
                                        <?php echo $arrangementInNum; ?>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="color-gray pt10">
                            安排中
                        </div>
                    </a>
                </div>
                <div class="col-1 w25">
                    <a href="<?php echo $urlPatientBookingList; ?>?status=5">
                        <div class="waitConfirm">
                            <?php
                            if ($waitConfirmNum != 0) {
                                ?>
                                <div class="grid">
                                    <div class="col-1"></div>
                                    <div class="col-0 dataNum">
                                        <?php echo $waitConfirmNum; ?>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="color-gray pt10">
                            待确认
                        </div>
                    </a>
                </div>
                <div class="col-1 w25">
                    <a href="<?php echo $urlPatientBookingList; ?>?status=6">
                        <div class="waitEvaluate">
                            <?php
                            if ($waitEvaluateNum != 0) {
                                ?>
                                <div class="grid">
                                    <div class="col-1"></div>
                                    <div class="col-0 dataNum">
                                        <?php echo $waitEvaluateNum; ?>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="color-gray pt10">
                            待评价
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt5 bg-white">
            <a href='<?php echo $urlMygy; ?>'>
                <div class="pad10 color-black grid">
                    <div class="col-0">
                        <img src="<?php echo $urlResImage; ?>mygy.png" class="w26p">
                    </div>
                    <div class="col-1 pl10 pt2 font-s16">
                        名医公益
                    </div>
                </div>
            </a>
        </div>
        <div class="mt5 bg-white">
            <a href='<?php echo $urlUserCommonProblem; ?>'>
                <div class="pad10 color-black grid">
                    <div class="col-0">
                        <img src="<?php echo $urlResImage; ?>commonProblem.png" class="w26p">
                    </div>
                    <div class="col-1 pl10 pt2 font-s16">
                        常见问题
                    </div>
                </div>
            </a>
        </div>
        <div class="mt5 bg-white">
            <a id="aboutus">
                <div class="pad10 color-black grid">
                    <div class="col-0">
                        <img src="<?php echo $urlResImage; ?>aboutUs.png" class="w26p">
                    </div>
                    <div class="col-1 pl10 pt2 font-s16">
                        关于我们
                    </div>
                </div>
            </a>
            <a href=''>
                <div class="pad10 color-black grid hide">
                    <div class="col-0">
                        <img src="<?php echo $urlResImage; ?>service.png" class="w26p">
                    </div>
                    <div class="col-1 pl10 pt2 font-s16">
                        服务介绍
                    </div>
                </div>
            </a>
        </div>
        <div class="mt5 bg-white">
            <a id="contactUs">
                <div class="pad10 color-black grid">
                    <div class="col-0">
                        <img src="<?php echo $urlResImage; ?>contactService.png" class="w26p">
                    </div>
                    <div class="col-1 pl10 pt2 font-s16">
                        联系客服
                    </div>
                </div>
            </a>
        </div>
        <div class="mt5 bg-white">
            <a id="btn_actionsheet1">
                <div class="pad10 font-s16 text-center color-black">
                    退出登录
                </div>
            </a>
        </div>
    </div>
</article>
<script>
    $("#btn_actionsheet1").tap(function () {
        J.customConfirm('退出',
                '<div class="mb10">您确定要退出该账号？</div>',
                '<a id="closeLogout" class="w50">取消</a>',
                '<a data="ok" class="color-green w50">退出</a>',
                function () {
                    location.href = '<?php echo $urlLogout; ?>';
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
            html: '<ul class="list text-center"><li>拨打名医主刀热线</li><li><a href="tel://4006277120">400-6277-120</a></li><li><a id="close">取消</a></li></ul>',
            pos: 'bottom',
            showCloseBtn: false
        });
        $('#close').click(function () {
            J.closePopup();
        });
    });

</script>