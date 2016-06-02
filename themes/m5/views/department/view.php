<?php
$urlBookCreate = $this->createUrl("booking/create", array('hp_dept_id' => ''));
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
    <h1 id="deptInf" class="title" data-dept="<?php echo $data->id; ?>"><?php echo $data->name; ?></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<footer id="hosDept_footer">
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16 state-pedding">预约</button>
</footer>
<article id="hosDept_article" class="active" data-scroll="true">
    <div class="">
        <div class="bg-white">
            <div class="color-yellow4 bb-gray pad10">
                预约流程
            </div>
            <div class="pt15 pb10">
                <img class="w100" src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146302502647494">
            </div>
        </div>
        <div class="mt15 text-justify bg-white">
            <div class="color-blue8 bb-gray pad10">
                科室介绍
            </div>
            <div class="pl20 pr20 pt5 pb20">
                <?php
                if (empty($data->description)) {
                    echo '暂无';
                } else {
                    echo $data->description;
                }
                ?>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('#btnSubmit').tap(function () {
            var deptId = $('#deptInf').attr('data-dept');
            location.href = '<?php echo $urlBookCreate; ?>/' + deptId;
        });
    });
</script>