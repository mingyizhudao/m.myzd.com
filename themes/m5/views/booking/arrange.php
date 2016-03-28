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
        <div class="grid pl10 pr10 mt20 color-green font-s18">
            <div class="col-0">
                <img src="<?php echo $urlResImage; ?>payOrderImg.png" class="w20p mr10">
            </div>
            <div class="col-1 pt3">
                当前状态:安排专家中...
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
            <?php
            $orderInfos = $data->results->orderInfo;
            if (!empty($orderInfos)) {
                for ($i = 0; $i < count($orderInfos); $i++) {
                    if ($orderInfos[$i]->order_type == 'deposit') {
                        $orderInfo = $orderInfos[$i];
                    }
                }
            }
            ?>
            <div>
                <span>已付手术预约金:<?php echo $orderInfo->final_amount;   ?>元</span>
                <span><?php echo $orderInfo->date_closed;   ?></span>
            </div>
        </div>
        <input id="ref_no" type="hidden" name="order[ref_no]" value="<?php echo $results->refNo; ?>" />
    </div>
</article>