<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('订单详情');
$urlPatientBooking = $this->createUrl('booking/patientBooking', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$bookingComment = $data->results->bookingComment;
$results = $data->results;
?>
<style>
    .bt-gray5{
        border-top: 1px solid #ececec;
    }
    .bb-gray5{
        border-bottom: 1px solid #ececec;
    }

    #evaluate_article.bg{
        background-color: #EAEFF1;
    }
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">订单详情</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article id='evaluate_article' class="active bg" data-scroll="true">
    <div class=''>
        <div class="bg-white pl10 pr10">
            <div class="pt20 color-green font-s18">
                感谢您的评价:祝您早日康复!
            </div>
            <div class='mt10'>
                主刀医生:刘跃武
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    治疗效果:
                </div>
                <div class='col-1'>
                    <?php
                    $effect = $bookingComment->effect;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($effect >= $i) {
                            ?>
                            <span class='pl10'><img src='<?php echo $urlResImage; ?>starFill.png' class='w20p'></span>
                            <?php
                        } else {
                            ?>
                            <span class='pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class='grid mt10'>
                <div class='col-0 pt3'>
                    医生态度:
                </div>
                <div class='col-1'>
                    <?php
                    $doctorAttitude = $bookingComment->doctor_attitude;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($doctorAttitude >= $i) {
                            ?>
                            <span class='pl10'><img src='<?php echo $urlResImage; ?>starFill.png' class='w20p'></span>
                            <?php
                        } else {
                            ?>
                            <span class='pl10'><img src='<?php echo $urlResImage; ?>star.png' class='w20p'></span>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="pt10 pb10 mt10 bt-gray5 bb-gray5">
                <?php echo $bookingComment->comment_text; ?>
            </div>
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
            <div class="mt10 font-s12 letter-s1">
                <div>订单编号:<?php echo $data->results->refNo; ?></div>
                <div class="grid">
                    <div class="col-0">
                        已付手术预约金:<?php echo $orderInfo->final_amount; ?>元
                    </div>
                    <div class="col-1 text-right">
                        <?php echo $orderInfo->date_closed; ?>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-0">
                        已付平台服务费:<?php echo $serviceInfo->final_amount; ?>元
                    </div>
                    <div class="col-1 text-right">
                        <?php echo $serviceInfo->date_closed; ?>
                    </div>
                </div>
                <div class="text-right pt10 pb10">
                    <a href="<?php echo $urlPatientBooking; ?>/<?php echo $bookingComment->bk_id; ?>" class="color-green">
                        查看详情>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>