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
$orderInfo = $results->orderInfo;
?>
<style>
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
<article id='complete_article' class="active bg" data-scroll="true">
    <div class=''>
        <div>
            <div class='mt20 mb20 text-center font-s16'>
                主刀医生:刘跃武
            </div>
            <div class="pt10 bg-white">
                <div class='grid pl20 pr20'>
                    <div class='col-0 pt3'>
                        治疗效果
                    </div>
                    <div class='col-1 pl20'>
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
                <div class='grid pl20 pr20 pt10 pb10'>
                    <div class='col-0 pt3'>
                        医生态度
                    </div>
                    <div class='col-1 pl20'>
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
                <div class="pad20 bt-gray5">
                    <?php echo $bookingComment->comment_text; ?>
                </div>
            </div>
            <div class="mt10 font-s12 letter-s1 bg-white color-gray4">
                <a href="<?php echo $urlPatientBooking; ?>/<?php echo $bookingComment->bk_id; ?>" class="color-black6">
                    <div class="text-center font-s14 pb10 pl20 pr20 pt10">
                        查看订单详情
                    </div>
                </a>
                <div class="pl20 pt10 pr20 pb10 bt-gray">
                    <div class="pt10">订单编号:<?php echo $data->results->refNo; ?></div>
                    <?php
                    for ($i = 0; $i < count($orderInfo); $i++) {
                        if ($orderInfo[$i]->is_paid == 1) {
                            if ($orderInfo[$i]->order_type == 'deposit') {
                                echo '<div class="bt-gray pad10">已支付手术预约金：' . $orderInfo[$i]->final_amount . '元</div>';
                            } else {
                                echo '<div class="bt-gray pad10">已支付手术咨询费：' . $orderInfo[$i]->final_amount . '元</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>