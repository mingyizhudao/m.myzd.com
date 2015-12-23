<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pPatientBooking');
$this->setPageTitle('预约详情');
?>
<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-back-btn-text="返回"  data-nav-rel="#f-nav-account">
    <style>
        .bookinglist .info{font-size: 16px;letter-spacing: 3px;margin-bottom: 20px;}
        .bookinglist .info img{max-height: 5em;}
        .bookinglist .info .ui-grid-a .ui-block-a,.bookinglist .info .ui-grid-a .ui-block-b{padding: 0.5em;}
        #imgConfirm{padding-top: 0;}
        .text-right{text-align: right;}
        a{text-decoration: none;}
    </style>
    <div data-role="content">
        <div class="bookinglist">
            <?php
            $results = $data->results;
            $booking = $results;
            if ($booking) {
                ?>
                <div class="info">
                    <div>
                        <span>预约单号：</span>
                        <span><?php echo $booking->refNo; ?></span>
                    </div>
                    <div class="mt10">
                        <span>患者姓名：</span>
                        <span><?php echo $booking->patientName; ?></span>
                    </div>
                    <div class="mt10">
                        <span>联系方式：</span>
                        <span><?php echo $booking->mobile; ?></span>
                    </div>
                    <div class="mt10">
                        <span>就诊医院：</span>
                        <span><?php echo $booking->hospitalName == '' ? '未填写' : $booking->hospitalName; ?></span>
                    </div>
                    <div class="mt10">
                        <span>就诊科室：</span>
                        <span><?php echo $booking->hpDeptName == '' ? '未填写' : $booking->hpDeptName; ?></span>
                    </div>
                    <div class="mt10">
                        <span>就诊专家：</span>
                        <span><?php echo $booking->expertName == '' ? '未填写' : $booking->expertName; ?></span>
                    </div>
                    <div class="mt10">
                        <span>疾病名称：</span>
                        <span><?php echo $booking->diseaseName; ?></span>
                    </div>
                    <div class="mt10">
                        <span>疾病描述：</span>
                        <div class="mt10">&nbsp;<?php echo $booking->diseaseDetail; ?></div>
                    </div>
                    <div class="mt10">
                        <span>影像资料：</span>
                        <div class="ui-grid-a mt10 imglist">
                            <?php
                            $files = $booking->files;
                            $uiblock;
                            if(count($files)>0) {
                                for ($i = 0; $i < count($files); $i++) {
                                    $file = $files[$i];
                                    if ($i % 2 == 0) {
                                        $uiblock = 'ui-block-a';
                                    } else {
                                        $uiblock = 'ui-block-b';
                                    }
                                    echo '<div class="' . $uiblock . '"><img data-src="' . $file->absFileUrl . '" src="' . $file->absThumbnailUrl . '"/></div>';
                                }
                            }else{
                                echo '<div>&nbsp;未上传图片</div>';
                            }
                            ?>
                            <div class=""></div>
                        </div>
                    </div>
                </div>
            <?php } else {
                ?>
                <h4 class="text-center">暂无收到申请</h4>
                <div class="mt30">
                    <a href="<?php echo $urlDoctorView; ?>" data-ajax="false" class="ui-btn">返回首页</a>
                </div>
                <?php
            }
            ?>
        </div>
        <div id="imgConfirm" class="confirmPage">
            <div class="text-center confirmcontent">
                <img src=""/>
            </div>
        </div>
    </div>  
    <script>
        $(document).ready(function () {
            $(".imglist img").click(function () {
                var imgUrl = $(this).attr('data-src');
                $("#imgConfirm .confirmcontent img").attr('src', imgUrl);
                $("#imgConfirm").show();
            });
            $(".confirmPage").click(function () {
                $(this).hide();
            });
        });
    </script>
</div>
