<?php
$this->setPageTitle('支付成功');
// $bookingDetails = $this->createUrl('booking/bookingDetails');
$urlUserView = $this->createUrl('user/view');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//点击支付按钮
$SITE_14 = PatientStatLog::SITE_14;
?>

<style>
    #success_article{
        background-color: #F1F1F1;
    }
</style>
<header class="bg-green">
    <h1 class="title">支付成功</h1>
    <nav class="right">
        <a href=" <?php echo $urlUserView ?>">确认</a>
    </nav>
</header>
<article id="success_article" class="active" data-scroll="true">
    <div>
        <div class="text-center pt50">
            <img src="http://static.mingyizhudao.com/146285229270718" class="w79p">
        </div>
        <div class="font-s16 text-center color-orange pt20 pb20">
            <?php
            if ($model->order_type == 'deposit') {
                echo '手术预约金支付成功！';
            } else {
                echo '您已成功预约' . $model->final_doctor_name . '专家！';
            }
            ?>
        </div>
        <div class="pt20 bt-gray pl10 pr10 color-gray">
            <?php
            if ($model->order_type == 'deposit') {
                echo '名医助手已开始为您联系专家，并会在8小时内与您回访确认，请保持手机畅通，谢谢！';
            } else {
                echo '名医助手会协助安排您尽快手术，感谢您对名医主刀的信任，祝愿您早日康复！';
            }
            ?>
        </div>
        <div class="font-s12 text-center pt61 color-green">
            <div>
                如有疑问欢迎拨打客服热线400-6277-120
            </div>
            <div>
                工作时间为每天9:30-18:00
            </div>
        </div>
    </div>
</article>
<script type="text/javascript">
    $(document).ready(function () {
        //品友
        pyRegisterCvt('OrderNo=[<?php echo $model->ref_no; ?>]&Money=[<?php echo $model->total_amount / 100; ?>]');
        function payStat(keyword, number) {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': number, 'stat[key_word]': keyword},
                success: function (data) {

                }
            });
        }
        payStat('支付成功', '<?php echo $SITE_14 ?>');
    });
</script>