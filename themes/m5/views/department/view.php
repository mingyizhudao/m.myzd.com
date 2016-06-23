<?php
$this->setPageTitle('科室详情');
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
        <a onclick="javascript:location.reload()">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<footer id="hosDept_footer">
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16 state-pedding">预约医院</button>
</footer>
<article id="hosDept_article" class="active" data-scroll="true">
    <div class="">
        <div class="text-justify bg-white">
            <div class="color-blue8 bb-gray pad10">
                科室介绍
            </div>
            <div class="pad10">
                <div class="titleBg">
                    学科地位
                </div>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->position)) {
                        echo $data->position;
                    } else {
                        echo '暂无明确信息，正在搜集中。';
                    }
                    ?>
                </div>
                <div class="titleBg">
                    学科规模
                </div>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->scale)) {
                        echo $data->scale;
                    } else {
                        echo '暂无明确信息，正在搜集中。';
                    }
                    ?>
                </div>
                <div class="titleBg">
                    学科专长
                </div>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->specialty)) {
                        echo $data->specialty;
                    } else {
                        echo '暂无明确信息，正在搜集中。';
                    }
                    ?>
                </div>
                <div class="titleBg">
                    学科力量
                </div>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->strength)) {
                        echo $data->strength;
                    } else {
                        echo '暂无明确信息，正在搜集中。';
                    }
                    ?>
                </div>
                <div class="titleBg">
                    学科荣誉
                </div>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->honor)) {
                        for ($i = 0; $i < count($data->honor); $i++) {
                            echo '<div>•' . $data->honor[$i] . '</div>';
                        }
                    } else {
                        echo '暂无明确信息，正在搜集中。';
                    }
                    ?>
                </div>
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