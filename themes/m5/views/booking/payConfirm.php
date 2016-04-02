<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('支付订单');
$urlPatientBooking = $this->createUrl('booking/patientBooking', array('id' => ''));
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$status = Yii::app()->request->getQuery('status', 0);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$results = $data->results;
?>
<style>
    .popup-title{color: #333333;}
</style>
<?php
$orderInfos = $data->results->orderInfo;
$isPay = false;
$payCost = 0; //需要支付
$alreadyPayCost = 0; //已经支付
if (!empty($orderInfos)) {
    for ($i = 0; $i < count($orderInfos); $i++) {
        if ($orderInfos[$i]->order_type == 'deposit') {
            $orderInfo = $orderInfos[$i];
        } else if ($orderInfos[$i]->order_type == 'service') {
            //$serviceInfo = $orderInfos[$i];
            if ($orderInfos[$i]->is_paid == 0) {
                $payCost+=$orderInfos[$i]->final_amount;
                $isPay = true;
            } else {
                $alreadyPayCost+=$orderInfos[$i]->final_amount;
            }
        }
    }
}
?>
<header class="bg-green">
    <nav class="left">
        <?php
        if ($isPay) {
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
    <div class="col-1 w60 middle grid">¥<?php echo $payCost; ?>元</div>
    <?php
    if ($isPay) {
        echo '<div id="pay" class="col-1 w40 bg-yellow5 color-white middle grid">支付订单</div>';
    } else {
        echo '<div class="col-1 w40 bg-gray4 color-white middle grid">已支付</div>';
    }
    ?>
</footer>
<article id='payOrder_article' class="active" data-scroll="true">
    <div>
        <ul class="list">
            <li class="font-s16">
                当前状态：<span class="color-yellow5">待支付平台咨询费</span>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊专家</div>
                <div class="col-1 text-right"><?php echo $results->expertName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊医院</div>
                <div class="col-1 text-right"><?php echo $results->hospitalName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊科室</div>
                <div class="col-1 text-right"><?php echo $results->hpDeptName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">疾病名称</div>
                <div class="col-1 text-right"><?php echo $results->diseaseName; ?></div>
            </li>
            <li>
                <div class="color-black6">疾病描述</div>
                <div class="w100"><?php echo $results->diseaseDetail; ?></div>
            </li>
            <li>
                <a href="<?php echo $urlPatientBooking; ?>/<?php echo $results->id; ?>" class="color-black6">
                    <div class="text-center">查看订单详情</div>
                </a>
            </li>
        </ul>
        <div class="font-s12 letter-s1 mt10 bg-white color-gray4">
            <div class="pad10">订单编号:<?php echo $results->refNo; ?></div>
            <?php
            if ($orderInfo->is_paid == 1) {
                ?>
                <div class="pad10 bt-gray grid">
                    <div class="col-0">
                        已付手术预约金:<?php echo $orderInfo->final_amount; ?>元
                    </div>
                    <div class="col-1 pl20">
                        <div>
                            <?php echo mb_strimwidth($orderInfo->date_closed, 0, 10, ''); ?>
                        </div>
                        <div>
                            <?php echo mb_strimwidth($orderInfo->date_closed, 11, 19, ''); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if ($alreadyPayCost != 0) {
                ?>
                <div class="pad10 bt-gray">
                    已付手术服务费:<?php echo $alreadyPayCost; ?>元
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('#noPay').tap(function () {
            J.customConfirm('',
                    '<div class="mb10">您确定暂不支付手术服务费?</div><div>（稍后可在"订单-待确认"里完成）</div>',
                    '<a data="cancel" class="w50">取消</a>',
                    '<a data="ok" class="w50">确定</a>', function () {
                        location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=' + '<?php echo $status; ?>';
                    }, function () {
                J.hideMask();
            });
        });
        $('#pay').click(function () {
            location.href = '<?php echo $this->createUrl('home/page', array('view' => 'pay')); ?>';
        });
    });
</script>