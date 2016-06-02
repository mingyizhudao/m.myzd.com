<?php
$refUrl = $this->createAbsoluteUrl('order/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">支付</h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article id="payView_article" class="active" data-scroll="true">
    <div>
        <?php //var_dump($data); ?>
        <ul class="list">
            <?php
            $payAlready = 0;
            $waitPay = 0;
            $payAmount = 0;
            for ($i = 0; $i < count($data); $i++) {
                $order = $data[$i];
                if ($order->order_type == 'service') {
                    $payAmount+=$order->final_amount;
                    ?>
                    <li>
                        <div class="grid">
                            <div class="col-1 w60 pl20 vertical-center">
                                支付<span class="color-yellow5"><?php echo $order->final_amount; ?></span>元
                            </div>
                            <?php
                            if ($order->is_paid == 0) {
                                $waitPay+=$order->final_amount;
                                ?>
                                <div class="col-1 w50p br5 bg-yellow5 color-white text-center pt7 pb5 pay" data-refNo="<?php echo $order->ref_no; ?>">
                                    支付
                                </div>
                                <?php
                            } else {
                                $payAlready+=$order->final_amount;
                                ?>
                                <div class="col-1 w50p br5 bg-gray4 color-white text-center pt7 pb5">
                                    已支付
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <div class="text-center">
            <div class="mt20">
                共需支付<span class="color-yellow5"><?php echo $payAmount; ?></span>元
            </div>
            <div class="mt20">
                已支付<span class="color-yellow5"><?php echo $payAlready; ?></span>元还需<span class="color-yellow5"><?php echo $waitPay; ?></span>元
            </div>
        </div>
    </div>
</article>
<script>
    $('.pay').click(function () {
        var refNo = $(this).attr('data-refNo');
        location.href = '<?php echo $refUrl; ?>/refNo/' + refNo;
    });
</script>