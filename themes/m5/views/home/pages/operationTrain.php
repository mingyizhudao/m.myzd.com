<?php
$urlBookingQuickbook = $this->createAbsoluteUrl('booking/quickbook');
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
    <h1 class="title">手术直通车</h1>
</header>
<footer id="operationTrain_footer">
    <a href="<?php echo $urlBookingQuickbook; ?>" class="font-s18 grid middle">快速预约</a>
</footer>
<article id="operationTrain_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146278046324616" class="w100">
        </div>
        <div class="stepBg pt20 pb30 pl10 pr10 text-justify">
            <div class="grid">
                <div class="col-0">
                    <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243608861097" class="w26p">
                </div>
                <div class="col-1 pt3 pl10">
                    您只需要将病情告诉我们，并上传影像资料（无需想好医院和医生）
                </div>
            </div>
            <div class="grid pt10">
                <div class="col-0">
                    <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243610856165" class="w26p">
                </div>
                <div class="col-1 pt3 pl10">
                    名医助手会向您推荐最适合您病情的主刀专家（均为三甲医院的副主任医师级别以上），免去您找医院、找医生的烦恼，也减少奔波和花费。
                </div>
            </div>
            <div class="grid pt10">
                <div class="col-0">
                    <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146243612717819" class="w26p">
                </div>
                <div class="col-1 pt3 pl10">
                    在得到您和医生的确认后，名医助手将会为您安排医院的闲置床位，大大节约手术等待时间，让您早日康复！
                </div>
            </div>
        </div>
    </div>
</article>