<?php
$this->setPageTitle('科室详情');
$urlBookCreate = $this->createUrl("booking/create", array('hp_dept_id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//点击预约按钮
$SITE_9 = PatientStatLog::SITE_9;
?>

<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 id="deptInf" class="title" data-dept="<?php echo $data->id; ?>"><?php echo $data->name; ?></h1>
    <nav class="right">
        <a onclick="javascript:location.reload()">
            <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
        </a>
    </nav>
</header>
<footer id="hosDept_footer">
    <button id="btnSubmit" type="button" class="button btn-yellow font-s16 state-pedding">预约科室</button>
</footer>
<article id="hosDept_article" class="active" data-scroll="true">
    <div class="">
        <div class="bg-white">
            <div class="grid pad10">
                <div class="col-1 color-yellow4">
                    预约流程
                </div>
                <div id="showStep" class="col-0 pl5 pr5">
                    <img src="http://static.mingyizhudao.com/14683115446038" class="w11p">
                </div>
                <div id="hideStep" class="col-0 pl5 pr5 hide">
                    <img src="http://static.mingyizhudao.com/146831524023035" class="w11p">
                </div>
            </div>
            <div id="step" class="bt-gray hide">
                <div class="pt20 pb20 color-yellow4 font-s15">
                    <div class="font-w800 text-center">
                        精选出国内专业领域最强的医院科室
                    </div>
                    <div class="font-w800 text-center">
                        让名医助手来寻找最合适您情况的主刀医生
                    </div>
                </div>
                <div class="pl40 pr40">
                    <img src="http://static.mingyizhudao.com/14683144127117" class="w100">
                </div>
                <div class="grid text-center">
                    <div class="col-1">
                        预约科室
                    </div>
                    <div class="col-1">
                        提交病例资料
                    </div>
                    <div class="col-1">
                        名医助手回访确认
                    </div>
                </div>
                <div class="pl40 pr40">
                    <img src="http://static.mingyizhudao.com/146831442141948" class="w100">
                </div>
                <div class="grid text-center pb20">
                    <div class="col-1">
                        匹配最合适的医生
                    </div>
                    <div class="col-1">
                        安排面诊<span class="font-s12">(如有需要)</span>
                    </div>
                    <div class="col-1">
                        安排手术
                    </div>
                </div>
            </div>
        </div>
        <div class="mt10 text-justify bg-white">
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
                        echo '暂无明确信息';
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
                        echo '暂无明确信息';
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
                        echo '暂无明确信息';
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
                        echo '暂无明确信息';
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
                        echo '暂无明确信息';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('#showStep').click(function () {
            $(this).addClass('hide');
            $('#hideStep').removeClass('hide');
            $('#step').removeClass('hide');
        });
      
        $('#hideStep').click(function(){
            $(this).addClass('hide');
            $('#showStep').removeClass('hide');
            $('#step').addClass('hide');
        });

        $('#btnSubmit').tap(function () {
            var deptId = $('#deptInf').attr('data-dept');
            location.href = '<?php echo $urlBookCreate; ?>/' + deptId;
        });
    });
</script>