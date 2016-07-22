<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/pingpp-html5-master/example-wap/styles/pinus.css">
<?php
/*
 * $data
 */
$this->setPageTitle('订单');
$order = $data->results->salesOrder;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$payUrl = $this->createUrl('payment/doPingxxPay');
//$refUrl = $this->createAbsoluteUrl('order/view');
$isApp = Yii::app()->request->getQuery('app', 1);
$refUrl = $this->createAbsoluteUrl('order/view', array('refNo' => $order->refNo, 'app' => $isApp));
$orderPayDeposit = $this->createAbsoluteUrl('order/payDeposit');
$patientBookingList = $this->createAbsoluteUrl('booking/patientBookingList');
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$urlSuccess = $this->createUrl('user/view');
$this->show_footer = false;
?>
<div id="section_container" <?php echo $this->createPageAttributes(); ?>>
    <section id="order_section" class="active" data-init="true">
        <?php if ($isApp == 1) { ?>
            <header class="bg-green">
                <div class="title"><?php echo $this->pageTitle; ?></div>
            </header>
        <?php } ?>
        <article id="order" class="active" data-scroll="true">
            <div class="order-content"><span class="color-green">请支付</span><span class="color-green pull-right"><?php echo $order->finalAmount ?>元</span></div>
            <div class="divider"></div>
            <div class="order-content"><span class="color-green">订单号:</span><?php echo $order->refNo ?></div>
            <div class="order-content"><span class="color-green">订单标题:</span><?php echo $order->subject ?></div>
            <div class="order-content">
                <div class="color-green mb5">订单详情:</div>
                <?php echo $order->description ?>
            </div>

            <div class="order-content"><span class="color-green">订单状态:</span><?php echo ($order->isPaid) == 1 ? '已支付' : '待支付'; ?></div>
            <div class="mt40">
                <form class="form-horizontal">
                    <div class="checkbox hide">
                        <label>
                            <input type="checkbox" checked> 同意名医主刀《<a href="<?php echo $this->createUrl('site/page', array('view' => 'terms')); ?>">患者服务条款</a>》
                        </label>
                    </div>
                    <!--
                    <div class="form-group text-center mt15">
                        <button class="btn btn-yes btn-lg">确认并支付</button>
                    </div>
                    -->
                    <input id="ref_no" type="hidden" name="order[ref_no]" value="<?php echo $order->refNo; ?>" />
                    <input type="hidden" name="order[bk_ref_no]" value="<?php echo $order->bkRefNo; ?>" />
                </form>
            </div>
            <div class="divider"></div>
            <div class="mt20"></div>
            <?php
            if ($order->isPaid == 0) {
                ?>
                <div class="grid">
                    <?php
                    if ($this->isUserAgentApp()) {
                        echo '<a id="pay" href="javascript:;" class="btn btn-yes btn-block">立即支付</a>';
                    } else {
                        if (($order->orderTypeCode == 'deposit') && ($order->booking_service_id == 2)) {
                            ?>
                            <a id="completePay" href="javascript:;" class="btn btn-yes btn-block">完成</a>
                            <a id="pay" href="javascript:;"></a>
                            <?php
                        } else {
                            ?>
                            <div class="col-1">
                                <a href="<?php echo $urlSuccess; ?>" class="btn btn-default btn-block" data-target="link">暂不支付</a>
                            </div>
                            <div class="col-1">
                                <a id="pay" href="javascript:;" class="btn btn-yes btn-block">立即支付</a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
    <!--            <section class="block">
                    <div class="content2">
                        <div class="app">
                            <div class="ch">
                                <span class="up" onclick="wap_pay('upacp_wap')">银联 WAP</span>
                                <span class="up" onclick="wap_pay('alipay_pc_direct')">支付宝 即时到账</span>
                                <span class="up alipay" onclick="wap_pay('alipay_wap')">&nbsp;</span>
                                <span class="up weixin" onclick="wap_pay('wx_pub')">&nbsp;</span>
                                <span class="up" onclick="wap_pay('bfb_wap')">百度钱包 WAP</span>
                                <span class="up" onclick="wap_pay('jdpay_wap')">京东支付 WAP</span>
                                <span class="up" onclick="wap_pay('yeepay_wap')">易宝支付 WAP</span>
                                <span class="up" onclick="wap_pay('yeepay_wap')">易宝支付 WAP</span>
                                <span class="up yeepay" onclick="wap_pay('yeepay_wap')">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </section>-->
                <?php
            }
            ?>
        </article>
    </section>
</div>
<!--<script type="text/javascript" src="https://one.pingxx.com/lib/pingpp_one.js"></script>-->
<script type="text/javascript" src="http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/pingpp-one/pingpp-one.js"></script>
<script type="text/javascript">
    $('#completePay').click(function () {
        var formdata = $('.form-horizontal').serializeArray();
        $.ajax({
            type: 'post',
            url: '<?php echo $orderPayDeposit; ?>',
            data: formdata,
            success: function (data) {
                //console.log(data);
                if (data.status == 'ok') {
                    location.href = '<?php echo $patientBookingList; ?>';
                } else {
                    console.log(data);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    var orderno = document.getElementById('ref_no').value;
    var amount = 0.01;
    document.getElementById('pay').addEventListener('click', function (e) {
        pingpp_one.init({
            app_id: 'app_SWv9qLSGWj1GKqbn', //该应用在ping++的应用ID
            order_no: orderno, //订单在商户系统中的订单号
            amount: amount * 100, //订单价格，单位：人民币 分
            // 壹收款页面上需要展示的渠道，数组，数组顺序即页面展示出的渠道的顺序
            // upmp_wap 渠道在微信内部无法使用，若用户未安装银联手机支付控件，则无法调起支付                
            // channel: ['alipay_wap', 'wx_pub', 'yeepay_wap', 'upacp_wap', 'jdpay_wap', 'bfb_wap'],
            //channel: ['alipay_wap', 'wx_pub', 'yeepay_wap'], //'wx_pub'
            channel: ['alipay_wap', 'yeepay_wap'],
            charge_url: "<?php echo $payUrl; ?>", //商户服务端创建订单的url              
            charge_param: {ref_url: "<?php echo $refUrl; ?>"}, //(可选，用户自定义参数，若存在自定义参数则壹收款会通过 POST 方法透传给 charge_url)
            //open_id: 'o9D7bsrlWC5ecKJdSuyVAYLedjVc'                             //(可选，使用微信公众号支付时必须传入)
            open_id: ""
        }, function (res) {
            console.log("res data...");
            console.log(res);
            //   alert(res.msg);
            if (!res.status) {
                //处理错误
                console.log(res);
                //alert(res.msg);
            }
            else {
                //若微信公众号渠道需要使用壹收款的支付成功页面，则在这里进行成功回调，调用 pingpp_one.success 方法，你也可以自己定义回调函数
                //其他渠道的处理方法请见第 2 节
                pingpp_one.success(function (res) {
                    if (!res.status) {
                        alert(res.msg);
                    }
                }, function () {
                    //这里处理支付成功页面点击“继续购物”按钮触发的方法，例如：若你需要点击“继续购物”按钮跳转到你的购买页，则在该方法内写入 window.location.href = "你的购买页面 url"
                    //window.location.href = 'http://yourdomain.com/payment_succeeded';//示例
                    alert("支付成功的跳转");
                });
            }
        });
    });
</script>