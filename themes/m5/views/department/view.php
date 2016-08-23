<?php
$this->setPageTitle('【 '.$data->hpDeptHospital->short_name.'】【'.$data->name.'】手术预约,床位预约,专家预约,哪个医生好_名医主刀网移动版');
$this->setPageKeywords('【 '.$data->hpDeptHospital->short_name.'】【'.$data->name.'】专家预约');
$this->setPageDescription('名医主刀网为您提供国内医院预约手术,医院排行榜,医院大全,医院哪家好等权威信息;助您在第一时间找到好医院,以最快的时间预约医院并安排手术,网上预约手术就看名医主刀网。');
$urlBookCreate = $this->createUrl("booking/create", array('hp_dept_id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
//modify by wanglei 
$urlStat = $this->createAbsoluteUrl('/api/stat');
//点击预约按钮
$SITE_9 = PatientStatLog::SITE_9;
?>
<style>
    h1,h2,h3{font-family: 'Microsoft YaHei', 微软雅黑, 'Microsoft Yahei', 黑体, 宋体, Arial, Simsun, Helvetica, sans-serif !important;}
</style>
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
            <div class="grid pad10 pb5">
                <h3 class="col-1 color-yellow4 font-s14 mt-1 pt3"style="font-family: 'Microsoft YaHei';">
                    预约流程
                </h3>
                <div id="showStep" class="col-0 pl5 pr5 mt-3 ">
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
        <div class="mt-10 text-justify bg-white">
            <h2 class="color-blue8 bb-gray pad10 font-s14 ">
                科室介绍
            </h2>
            <div class="pad10 mt-4">
                <h3 class="titleBg font-s14 mt-1 pb5 pt5">
                    学科地位
                </h3>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->position)) {
                        echo $data->position;
                    } else {
                        echo '暂无明确信息';
                    }
                    ?>
                </div>
                <h3 class="titleBg font-s14 pb5 pt5 mt-1">
                    学科规模
                </h3>
                <div class="pt10 pb10 ">
                    <?php
                    if (isset($data->scale)) {
                        echo $data->scale;
                    } else {
                        echo '暂无明确信息';
                    }
                    ?>
                </div>
                <h3 class="titleBg font-s14 pb5 pt5 mt-1">
                    学科专长
                </h3>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->specialty)) {
                        echo $data->specialty;
                    } else {
                        echo '暂无明确信息';
                    }
                    ?>
                </div>
                <h3 class="titleBg font-s14 pb5 pt5 mt-1">
                    学科力量
                </h3>
                <div class="pt10 pb10">
                    <?php
                    if (isset($data->strength)) {
                        echo $data->strength;
                    } else {
                        echo '暂无明确信息';
                    }
                    ?>
                </div>
                <h3 class="titleBg font-s14 pb5 pt5 mt-1">
                    学科荣誉
                </h3>
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