<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('支付订单');
$urlPatientBooking = $this->createUrl('booking/patientBooking', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$results = $data->results;
?>
<style>
    #payOrder_article .list>li{padding: 10px;}
    #payOrder_article .bbb{box-shadow: 2px 2px 2px #cccccc}
    #payOrder_article .list>li:first-child{border-top: inherit;}
    article#payOrder_article{background-color: #eaeff1;}
    .popup-title{color: #333333;}
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">支付订单</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
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
        <?php
        $alreadyPayCost = 0;
        $orderInfos = $data->results->orderInfo;
        if (!empty($orderInfos)) {
            for ($i = 0; $i < count($orderInfos); $i++) {
                if ($orderInfos[$i]->order_type == 'deposit') {
                    $orderInfo = $orderInfos[$i];
                } else if ($orderInfos[$i]->order_type == 'service') {
                    if ($orderInfos[$i]->is_paid == 1) {
                        $alreadyPayCost+=$orderInfos[$i]->final_amount;
                    }
                }
            }
        }
        ?>
        <div class="font-s12 letter-s1 bg-white mt10 color-gray4">
            <div class="pad10">订单编号:<?php echo $results->refNo; ?></div>
            <?php
            if ($orderInfo->is_paid == 1) {
                ?>
                <div class="grid bt-gray pad10">
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
                <div class="grid bt-gray pad10">
                    已付平台服务费:<?php echo $alreadyPayCost; ?>元
                </div>
                <?php
            }
            ?>
        </div>
        <input id="ref_no" type="hidden" name="order[ref_no]" value="<?php echo $results->refNo; ?>" />
    </div>
</article>