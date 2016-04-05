<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');
$showStatus = Yii::app()->request->getQuery('status', 0);
$urlBookingDetails = $this->createUrl('booking/bookingDetails');
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$this->show_footer = false;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlUserView = $this->createUrl('user/view');
?>
<header id="orderList_header" class="bg-green" >
    <nav class="left">
        <a href="<?php echo $urlUserView; ?>">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 id="selectStatus" class="title">
        <?php
        if ($showStatus == 0) {
            echo '全部';
        } else if ($showStatus == 1) {
            echo '待支付';
        } else if ($showStatus == 2) {
            echo '安排中';
        } else if ($showStatus == 3) {
            echo '待确认';
        } else if ($showStatus == 4) {
            echo '待点评';
        } else if ($showStatus == 8) {
            echo '已完成';
        } else {
            echo '已取消';
        }
        ?>
        <img src="<?php echo $urlResImage; ?>triangleWhite.png" class="w10p">
    </h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>

<article id="orderList_article" class="active bg-gray3"  data-scroll="true">
    <div class="">
        <?php
        $results = $data->results;
        if (count($results) > 0) {
            for ($i = 0; $i < count($results); $i++) {
                $icon = '';
                $padding = '';
                if ($results[$i]->bkStatus == 1) {
                    $icon = 'waitPay';
                    $padding = 'pt5';
                } else if ($results[$i]->bkStatus == 2) {
                    $icon = 'arrangementIn';
                    $padding = 'pt5';
                } else if ($results[$i]->bkStatus == 3) {
                    $icon = 'waitConfirm';
                } else if ($results[$i]->bkStatus == 4) {
                    $icon = 'waitEvaluate';
                } else if ($results[$i]->bkStatus == 8) {
                    $icon = 'alreadyEvaluate';
                } else if ($results[$i]->bkStatus == 9) {
                    $icon = 'alreadyCancel';
                }
                ?>
                <div class="orderDiv <?php echo $icon; ?>">
                    <div class="pl40">
                        <div class="grid bb-gray pt10 pb10">
                            <div class="col-1 color-black6 <?php echo $padding; ?>">
                                订单号：<?php echo $results[$i]->refNo; ?>
                            </div >
                            <div class="col-0 pr10">
                                <?php
                                if (($results[$i]->bkStatus == 1) || ($results[$i]->bkStatus == 2)) {
                                    ?>
                                    <div class="cancelOrder" data-refNo="<?php echo $results[$i]->refNo; ?>">
                                        取消订单
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <a href="<?php echo $urlBookingDetails; ?>?id=<?php echo $results[$i]->id; ?>&status=<?php echo $results[$i]->bkStatus; ?>" data-target="link">
                            <div class="order_list grid pt10">
                                <div class="col-0 color-black6">
                                    就诊医生：
                                </div>
                                <div class="col-1 color-black10">
                                    <?php echo $results[$i]->expertName == '' ? '未填写' : $results[$i]->expertName; ?>
                                </div>
                            </div>
                            <div class="order_list grid pt10">
                                <div class="col-0 color-black6">
                                    就诊医院：
                                </div>
                                <div class="col-1 color-black10">
                                    <?php echo $results[$i]->hpName == '' ? '未填写' : $results[$i]->hpName; ?>
                                </div>
                            </div>
                            <div class="order_list grid pb20 pt10">
                                <div class="col-0 color-black6">
                                    就诊人：
                                </div>
                                <div class="col-1 color-black10">
                                    <?php echo $results[$i]->contact_name; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo'<div class="font-s16 pt10"></div>暂无订单';
        }
        ?>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('.cancelOrder').tap(function () {
            var refNo = $(this).attr('data-refNo');
            alert(refNo);
        });

        $('#selectStatus').tap(function () {
            var statusHtml = '<header id="orderList_header" class="bg-green" >'
                    + '<nav class="left">'
                    + '<a href="<?php echo $urlUserView; ?>">'
                    + '<div class="pl5">'
                    + '<img src="<?php echo $urlResImage; ?>back.png" class="w11p">'
                    + '</div>'
                    + '</a>'
                    + '</nav>'
                    + '<h1 class="title" data-target="closePopup">'
                    + $('.title').html()
                    + '</h1>'
                    + '<nav class="right">'
                    + '<a onclick="javascript:history.go(0)">'
                    + '<img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">'
                    + '</a>'
                    + '</nav>'
                    + '</header>'
                    + '<article id="orderList_article" class="active" data-scroll="true" style="height:300px;">'
                    + '<ul class="list">'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>">全部</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=1">待支付</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=2">安排中</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=3">待确认</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=4">待点评</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=8">已完成</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=9">已取消</a></li>'
                    + '</ul>'
                    + '</article>';
            J.popup({
                html: statusHtml,
                pos: 'top',
                showCloseBtn: false
            });
        });
    });
</script>