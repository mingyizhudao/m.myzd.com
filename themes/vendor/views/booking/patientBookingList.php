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
        } else if ($showStatus == 8) {
            echo '已完成';
        } else {
            echo '已取消';
        }
        ?>
        <img src="http://static.mingyizhudao.com/146976027712626" class="w10p">
    </h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>

<article id="orderList_article" class="active bg-gray3"  data-scroll="true">
    <div class="ml10 mr10 ">
        <?php
        $results = $data->results;
        if (count($results) > 0) {
            for ($i = 0; $i < count($results); $i++) {
                ?>
                <?php //var_dump($results[$i]); ?>
                <div class="orderDiv">
                    <a href="<?php echo $urlBookingDetails; ?>?id=<?php echo $results[$i]->id; ?>&status=<?php echo $results[$i]->bkStatus; ?>" data-target="link">
                        <div class="grid color-green pt5">
                            <div class="col-1 pl5 font-s16">
                                订单号:<?php echo $results[$i]->refNo; ?>
                            </div >
                            <div class="col-0 pr5 font-s16">
                                <?php echo $results[$i]->bkStatusText; ?>
                            </div>
                        </div>
                        <div class="order_list grid">
                            <div class="col-0">
                                预约医生:
                            </div>
                            <div class="col-1">
                                <?php echo $results[$i]->expertName == '' ? '未填写' : $results[$i]->expertName; ?>
                            </div>
                        </div>
                        <div class="order_list grid">
                            <div class="col-0">
                                预约医院:
                            </div>
                            <div class="col-1">
                                <?php echo $results[$i]->hpName == '' ? '未填写' : $results[$i]->hpName; ?>
                            </div>
                        </div>
                        <div class="order_list grid pb20">
                            <div class="col-0">
                                就诊人:
                            </div>
                            <div class="col-1">
                                <?php echo $results[$i]->contact_name; ?>
                            </div>
                        </div>
                    </a>
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
        $('#selectStatus').tap(function () {
            var statusHtml = '<header id="orderList_header" class="bg-green" >'
                    + '<nav class="left">'
                    + '<a href="<?php echo $urlUserView; ?>">'
                    + '<div class="pl5">'
                    + '<img src="http://static.mingyizhudao.com/146975795218858" class="w11p">'
                    + '</div>'
                    + '</a>'
                    + '</nav>'
                    + '<h1 class="title" data-target="closePopup">'
                    + $('.title').html()
                    + '</h1>'
                    + '<nav class="right">'
                    + '<a onclick="javascript:history.go(0)">'
                    + '<img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">'
                    + '</a>'
                    + '</nav>'
                    + '</header>'
                    + '<article id="orderList_article" class="active" data-scroll="true" style="height:300px;">'
                    + '<ul class="list">'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=0">全部</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=1">待支付</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=2">安排中</a></li>'
                    + '<li><a href="<?php echo $urlPatientBookingList; ?>?status=3">待确认</a></li>'
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