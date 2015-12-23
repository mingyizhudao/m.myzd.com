<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pPatientBookingList');
$this->setPageTitle('我的预约');
$urlCreatePatient = $this->createUrl('patient/create', array('addBackBtn' => 1));
?>

<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-back-btn-text="返回"  data-nav-rel="#f-nav-account">
    <style>
        .bookinglist .bookinginfo{border: 1px solid #888;border-left: 2px solid #19aea5;padding: 10px 10px 20px;letter-spacing: 3px;margin-bottom: 20px;}
    </style>
    <div data-role="content">
        <div class="bookinglist">
            <?php
            $results = $data->results;
            $bookings = $results;
            if ($bookings) {
                for ($i = 0; $i < count($bookings); $i++) {
                    $booking = $bookings[$i];
                    ?>
                    <a href="<?php echo $this->createUrl('booking/patientBooking', array('id' => $booking->id, 'addBackBtn' => 1)); ?>">
                        <div class="bookinginfo">
                            <div>
                                <span>预约单号：</span>
                                <span><?php echo $booking->refNo; ?></span>
                            </div>
                            <div class="mt10">
                                <span>就诊医院：</span>
                                <span><?php echo $booking->hpName==''?'未填写':$booking->hpName; ?></span>
                            </div>
                            <div class="mt10">
                                <span>就诊医生：</span>
                                <span><?php echo $booking->expertName==''?'未填写':$booking->expertName; ?></span>
                            </div>
                            <div class="mt10">
                                <span>就诊科室：</span>
                                <span><?php echo $booking->hpDeptName==''?'未填写':$booking->hpDeptName; ?></span>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                ?>
                <h4 class="text-center">暂无预约信息</h4>
                <?php
            }
            ?>
        </div>
    </div>  	
</div>
