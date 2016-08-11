<?php
/*
 * $model DoctorForm.
 */
$this->setPageTitle('预约单详情');
$urlPatientBooking = $this->createUrl('booking/patientBooking', array('id' => ''));
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$showStatus = Yii::app()->request->getQuery('showStatus', 0);
$payUrl = $this->createUrl('/payment/doPingxxPay');
$refUrl = $this->createAbsoluteUrl('order/view');
$urlBookingPayView = $this->createAbsoluteUrl('booking/payView');
$urlApiUpdate = $this->createAbsoluteUrl('/api');
$BK_STATUS_NEW = StatCode::BK_STATUS_NEW;
$BK_STATUS_PROCESSING = StatCode::BK_STATUS_PROCESSING;
$BK_STATUS_CONFIRMED_DOCTOR = StatCode::BK_STATUS_CONFIRMED_DOCTOR;
$BK_STATUS_CANCELLED = StatCode::BK_STATUS_CANCELLED;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
$results = $data->results;
$orderInfo = $results->orderInfo;
?>

<style>
    .popup-title{color: #333333;}
</style>
<header id="payOrder_header" class="bg-green">
    <nav class="left">
        <?php
        if ($results->bkStatusCode == $BK_STATUS_NEW) {
            $deposit = '';
            for ($i = 0; $i < count($orderInfo); $i++) {
                if ($orderInfo[$i]->order_type == 'deposit') {
                    $deposit = $orderInfo[$i];
                }
            }
            if (($deposit != '') && ($deposit->is_paid == 0)) {
                ?>
                <a id="noPayDeposit">
                    <div class="pl5">
                        <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                    </div>
                </a>
                <?php
            } else {
                ?>
                <a class="backBtn">
                    <div class="pl5">
                        <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                    </div>
                </a>
                <?php
            }
        } else if (($results->bkStatusCode == $BK_STATUS_CONFIRMED_DOCTOR) && ($results->serviceAmount != $results->serviceTotalAmount)) {
            ?>
            <a id="noPayService">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
            <?php
        } else {
            ?>
            <a class="backBtn">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
            <?php
        }
        ?>
    </nav>
    <h1 class="title">预约单详情</h1>
    <?php
    if (($results->bkStatusCode == 1) || ($results->bkStatusCode == 2)) {
        ?>
        <nav class="right">
            <a id="cancelOrder">
                取消订单
            </a>
        </nav>
        <?php
    } else {
        ?>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
            </a>
        </nav>
        <?php
    }
    ?>
</header>
<?php
if ($results->bkStatusCode == $BK_STATUS_NEW) {
    $deposit = '';
    for ($i = 0; $i < count($orderInfo); $i++) {
        if ($orderInfo[$i]->order_type == 'deposit') {
            $deposit = $orderInfo[$i];
        }
    }
    if (($deposit != '') && ($deposit->is_paid == 0)) {
        ?>
        <footer class="bg-white grid">
            <div class="col-1 w60 middle grid"><?php echo $deposit->final_amount; ?>元</div>
            <div id="payDeposit" data-refNo="<?php echo $deposit->ref_no; ?>" class="col-1 w40 bg-yellow5 color-white middle grid">支付订单</div>
        </footer>
        <?php
    }
    ?>
    <?php
} else if (($results->bkStatusCode == $BK_STATUS_PROCESSING) || ($results->bkStatusCode == $BK_STATUS_CANCELLED)) {
    echo '';
} else if (($results->bkStatusCode == $BK_STATUS_CONFIRMED_DOCTOR) && ($results->serviceAmount != $results->serviceTotalAmount)) {
    ?>
    <footer class="bg-white grid">
        <div class="col-1 w60 middle grid">还需支付<?php echo $results->serviceTotalAmount - $results->serviceAmount; ?>元</div>
        <div id="payService" data-bookingId="<?php echo $results->id; ?>" class="col-1 w40 bg-yellow5 color-white middle grid">继续支付</div>
    </footer>
    <?php
}
?>
<article id='payOrder_article' class="active" data-scroll="true">
    <div>
        <ul class="list">
            <li class="font-s16">
                当前状态：
                <span class="color-yellow5">
                    <?php
                    if ($results->bkStatusCode == $BK_STATUS_NEW) {
                        echo '待支付手术预约金';
                    } else {
                        echo $results->bkStatus;
                    }
                    ?>
                </span>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊专家</div>
                <div class="col-1 pl10 text-right"><?php echo $results->expertName == '' ? $results->doctorName : $results->expertName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊医院</div>
                <div class="col-1 pl10 text-right"><?php echo $results->hospitalName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">就诊科室</div>
                <div class="col-1 pl10 text-right"><?php echo $results->hpDeptName; ?></div>
            </li>
            <li class="grid">
                <div class="col-0 color-black6">疾病名称</div>
                <div class="col-1 pl10 text-right"><?php echo $results->diseaseName; ?></div>
            </li>
            <li>
                <div class="color-black6">疾病描述</div>
                <div class="w100"><?php echo $results->diseaseDetail; ?></div>
            </li>
            <li>
                <a href="<?php echo $urlPatientBooking; ?>/<?php echo $results->id; ?>/showStatus/<?php echo $showStatus; ?>" class="color-black6">
                    <div class="text-center">
                        <span class="viewOrders">查看订单详情</span>
                    </div>
                </a>
            </li>
        </ul>
        <div class="font-s12 letter-s1 bg-white mt10 color-gray4">
            <div class="pad10">订单编号:<?php echo $results->refNo; ?></div>
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
</article>
<script>
    $(document).ready(function () {
        $('#cancelOrder').click(function () {
            J.customConfirm('',
                    '<div class="mb10">确定取消该订单?</div>',
                    '<a id="colosePopup" class="w50">取消</a>',
                    '<a id="cancel" class="w50">确定</a>', function () {
                    }, function () {
            });
            $('#colosePopup').click(function () {
                J.closePopup();
            });
            $('#cancel').click(function () {
                J.closePopup();
                J.showMask();
                $.ajax({
                    type: 'put',
                    url: '<?php echo $urlApiUpdate; ?>/booking/' + '<?php echo $results->id; ?>',
                    success: function (data) {
                        J.hideMask();
                        if (data.status == 'ok') {
                            J.showToast('取消成功', '', '');
                            setTimeout(function () {
                                location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=<?php echo $showStatus; ?>';
                            }, 1500);
                        } else {
                            J.showToast(data.errors, '', '1500');
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        console.log(XmlHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    },
                });
            });
        });
        $('#noPayDeposit').tap(function () {
            J.customConfirm('',
                    '<div class="mb10">您确定暂不支付手术预约金?</div><div>（稍后可在"订单-待支付"里完成）</div>',
                    '<a id="colosePopup" class="w50">取消</a>',
                    '<a id="returnPatientBookingList" class="w50">确定</a>', function () {
                    }, function () {
            });
            $('#colosePopup').click(function () {
                J.closePopup();
            });
            $('#returnPatientBookingList').click(function () {
                location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=<?php echo $showStatus; ?>';
            });
        });
        $('#noPayService').click(function () {
            J.customConfirm('',
                    '<div class="mb10">您确定暂不支付手术咨询费?</div><div>（稍后可在"订单-待确认"里完成）</div>',
                    '<a id="colosePopup" class="w50">取消</a>',
                    '<a id="returnPatientBookingList" class="w50">确定</a>', function () {
                        location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=<?php echo $showStatus; ?>';
                    }, function () {
            });
            $('#colosePopup').click(function () {
                J.closePopup();
            });
            $('#returnPatientBookingList').click(function () {
                location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=<?php echo $showStatus; ?>';
            });
        });
        $('.backBtn').click(function () {
            location.href = '<?php echo $urlPatientBookingList; ?>' + '?status=<?php echo $showStatus; ?>';
        });
        $('#payDeposit').click(function () {
            var refNo = $(this).attr('data-refNo');
            location.href = '<?php echo $refUrl; ?>/refNo/' + refNo;
        });
        $('#payService').click(function () {
            location.href = '<?php echo $urlBookingPayView; ?>/id/' + '<?php echo $results->id; ?>';
        });
    });
</script>