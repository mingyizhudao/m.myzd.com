<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');
$showStatus = Yii::app()->request->getQuery('status', 0);
$urlBookingDetails = $this->createUrl('booking/bookingDetails');
$urlPatientBookingList = $this->createUrl('booking/patientBookingList');
$urlApiUpdate = $this->createAbsoluteUrl('/api');
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
        } else if ($showStatus == 5) {
            echo '待确认';
        } else if ($showStatus == 6) {
            echo '待评价';
        } else if ($showStatus == 8) {
            echo '已完成';
        } else {
            echo '已取消';
        }
        ?>
        <img src="<?php echo $urlResImage; ?>triangleWhite.png" class="w10p">
    </h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
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
                ?>
                <div class="orderDiv">
                    <a href="<?php echo $urlBookingDetails; ?>?id=<?php echo $results[$i]->id; ?>&status=<?php echo $results[$i]->bkStatus; ?>&showStatus=<?php echo $showStatus; ?>" data-target="link">
                        <div class="grid bb-gray pad10">
                            <div class="col-1 color-black6 pt2">
                                预约单号：<?php echo $results[$i]->refNo; ?>
                            </div >
                            <div class="col-0">
                                <?php
                                if (($results[$i]->bkStatus == 8) || ($results[$i]->bkStatus == 9)) {
                                    echo '<div class="greenIcon">' . $results[$i]->bkStatusText . '</div>';
                                } else {
                                    echo '<div class="yellowIcon">' . $results[$i]->bkStatusText . '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="pad10">
                            <div class="order_list grid">
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
                            <div class="order_list grid pt10">
                                <div class="col-0 color-black6">
                                    患者姓名：
                                </div>
                                <div class="col-1 color-black10">
                                    <?php echo $results[$i]->contact_name; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="text-center">
                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146295490734874" class="w170p pt50">
            </div>
            <div class="font-s30 color-gray9 text-center pt10">暂无订单</div>
            <?php
        }
        ?>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('.cancelOrder').tap(function () {
            var id = $(this).attr('data-id');
            var cancelOrder = $(this);
            J.customConfirm('',
                    '<div class="mb10">确认取消该订单？</div>',
                    '<a id="closePopup" class="w50">取消</a>',
                    '<a id="confirmChange" class="w50">确定</a>',
                    function () {
                    }, function () {
            }
            );
            $('#closePopup').click(function () {
                J.closePopup();
            });
            $('#confirmChange').click(function () {
                $.ajax({
                    type: 'put',
                    url: '<?php echo $urlApiUpdate; ?>/booking/' + id,
                    success: function (data) {
                        J.closePopup();
                        //console.log(data);
                        if (data.status == 'ok') {
                            //history.go(0);
                            var order = cancelOrder.parents('.orderDiv');
                            order.removeClass('waitPay');
                            order.removeClass('arrangementIn');
                            order.addClass('alreadyCancel');
                            var urlOrder = order.find('a').attr('href');
                            //console.log(urlOrder);
                            order.find('a').attr('href', urlOrder.substr(0, urlOrder.length - 1) + '9');
                            cancelOrder.remove();
                        }
                    },
                    error: function (data) {
                        J.closePopup();
                        console.log(data);
                    }
                });
            });
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
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=5">待确认</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=6">待评价</a></li>'
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