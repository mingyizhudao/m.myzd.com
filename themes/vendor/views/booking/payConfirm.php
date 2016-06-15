<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('支付订单');
$urlPatientBooking = $this->createUrl('booking/patientBooking', array('id' => ''));
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$status = Yii::app()->request->getQuery('status', 0);
$payUrl = $this->createUrl('/payment/doPingxxPay');
$refUrl = $this->createAbsoluteUrl('order/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_header = false;
$results = $data->results;
?>
<style>
    #payOrder_article .list>li{padding: 10px;}
    #payOrder_article .bbb{box-shadow: 2px 2px 2px #cccccc}
    #payOrder_article .list>li:first-child{border-top: inherit;}
    article#payOrder_article{background-color: #eaeff1;}
    .popup-title{color: #333333;}
</style>
<?php
$orderInfos = $data->results->orderInfo;
if (!empty($orderInfos)) {
    for ($i = 0; $i < count($orderInfos); $i++) {
        if ($orderInfos[$i]->order_type == 'deposit') {
            $orderInfo = $orderInfos[$i];
        } else if ($orderInfos[$i]->order_type == 'service') {
            $serviceInfo = $orderInfos[$i];
        }
    }
}
?>
<header class="bg-green">
    <nav class="left">
        <?php
        if ($serviceInfo->is_paid == 0) {
            ?>
            <a id="noPay">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
            <?php
        } else {
            ?>
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
            <?php
        }
        ?>
    </nav>
    <h1 class="title">支付订单</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<footer class="bg-white grid">
    <div class="col-1 w60 color-green middle grid">¥<?php echo $serviceInfo->final_amount; ?>元</div>
    <?php
    if ($serviceInfo->is_paid == 0) {
        echo '<div id="pay" class="col-1 w40 bg-green color-white middle grid">支付</div>';
    } else {
        echo '<div class="col-1 w40 bg-gray4 color-white middle grid">已支付</div>';
    }
    ?>
</footer>
<article id='payOrder_article' class="active" data-scroll="true">
    <div>
        <div class="grid pl10 pr10 mt20 color-green font-s18">
            <div class="col-0">
                <img src="<?php echo $urlResImage; ?>payOrderImg.png" class="w20p mr10">
            </div>
            <div class="col-1 pt3">
                当前状态:确认手术时间
            </div>
        </div>
        <div class="mt20 ml10 mr10 bbb">
            <ul class="list">
                <li class="grid">
                    <div class="col-0">就诊专家</div>
                    <div class="col-1 text-right"><?php echo $results->expertName; ?></div>
                </li>
                <li class="grid">
                    <div class="col-0">就诊医院</div>
                    <div class="col-1 text-right"><?php echo $results->hospitalName; ?></div>
                </li>
                <li class="grid">
                    <div class="col-0">就诊科室</div>
                    <div class="col-1 text-right"><?php echo $results->hpDeptName; ?></div>
                </li>
                <li class="grid">
                    <div class="col-0">疾病名称</div>
                    <div class="col-1 text-right"><?php echo $results->diseaseName; ?></div>
                </li>
                <li>
                    <div>疾病描述</div>
                    <div><?php echo $results->diseaseDetail; ?></div>
                </li>
                <li>
                    <div class="text-right">
                        <a  href="<?php echo $urlPatientBooking; ?>/<?php echo $results->id; ?>" class="color-green">查看详情<span data-icon="play"></span></a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="font-s12 letter-s1 ml20 mr20 mt10">
            <div>订单编号:<?php echo $results->refNo; ?></div>
            <div>
                <span>已付手术预约金:<?php echo $orderInfo->final_amount; ?>元</span>
                <span><?php echo $orderInfo->date_closed; ?></span>
            </div>
        </div>
        <input id="ref_no" type="hidden" name="order[ref_no]" value="<?php echo $serviceInfo->refNo; ?>" />
    </div>
</article>
<script type="text/javascript" src="http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/pingpp-one/pingpp-one.js"></script>
<script type="text/javascript">
            $('#noPay').tap(function () {
                J.customConfirm('<div class="font-s16">提示</div>',
                        '<div class="mb10">您确定暂不支付手术服务费?</div><div>（稍后可在"订单-待确认"里完成）</div>',
                        '<a data="cancel" class="w50">取消</a>',
                        '<a data="ok" class="color-green w50">确定</a>', function () {
                            location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=' + '<?php echo $status; ?>';
                        }, function () {
                    J.hideMask();
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