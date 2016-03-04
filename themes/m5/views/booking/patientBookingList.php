<?php
/**
 * $data.
 */
$this->setPageTitle('预约单');

$urlApiAppNav1 = $this->createAbsoluteUrl('/api/list', array('model' => 'appnav1'));

$urlPatientBooking = $this->createUrl('booking/patientBooking');
$this->show_footer = false;
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlUserView = $this->createUrl('user/view');
?>
<header class="bg-green" >
    <nav class="left">
        <a href="<?php echo $urlUserView; ?>">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>

<article id="orderList_article" class="active"  data-scroll="true">
    <ul class="list">
        <?php
        $results = $data->results;
        if (count($results) > 0) {
            for ($i = 0; $i < count($results); $i++) {
                ?>
                <li>
                    <a href="<?php echo $urlPatientBooking; ?>?id=<?php echo $results[$i]->id; ?>" data-target="link">
                        <div class="color-black font-s18 pl5">订单号:<?php echo $results[$i]->refNo; ?></div >
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
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</article>