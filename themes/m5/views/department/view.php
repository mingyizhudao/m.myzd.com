<?php
$urlBookCreate = $this->createUrl("booking/create", array('hp_dept_id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="#" data-icon="previous" data-target="back"></a>
    </nav>
    <h1 class="title"><?php echo $data->hpDeptHospital->name; ?></h1>
</header>
<footer>
    <button id="btnSubmit" type="button" class="button btn-yellow">预约</button>
</footer>
<article id="hosDept_article" class="active" data-scroll="true">
    <div class="bgDiv">
        <div class="pb3 bb-green">
            <div id="deptInf" class="font-s16 color-green" data-dept="<?php echo $data->id; ?>"><?php echo $data->name; ?></div>
        </div>
        <div class="mt10">
            科室介绍：
            <?php if (empty($data->description)) {
                echo '暂无';
            } else {
                echo $data->description;
            } ?>
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