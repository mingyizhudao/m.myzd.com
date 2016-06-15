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
    <h1 class="title"><?php echo mb_strimwidth($data->hpDeptHospital->name, 0, 39, '...') ?></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<nav id="hosDept_nav" class="header-secondary">
    <div class="pb3 bg-white w100 grid">
        <div id="deptInf" class="col-0 font-s16 color-green pt5 vertical-center" data-dept="<?php echo $data->id; ?>"><?php echo $data->name; ?></div>
        <div class="col-1 pt10 text-right mr15">
            <button id="btnSubmit" type="button" class="button bg-yellow">预约</button>
        </div>
    </div>
</nav>
<article id="hosDept_article" class="active" data-scroll="true">
    <div class="bgDiv">
        <div class="pt15 pb10">
            <img class="w100" src="<?php echo $urlResImage; ?>deptStep.png">
        </div>
        <div class="mt10 text-justify">
            科室介绍：
            <?php
            if (empty($data->description)) {
                echo '暂无';
            } else {
                echo $data->description;
            }
            ?>
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