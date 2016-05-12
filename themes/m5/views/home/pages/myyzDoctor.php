<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/myyzDoctor.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/myyzDoctor.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$urlApiDiagnosisdoctors = $this->createAbsoluteUrl('/api/diagnosisdoctors', array('api' => 9));
$urlDoctorView = $this->createUrl('doctor/view', array('id' => ''));
$urlRootPath = $this->createAbsoluteUrl('/themes/');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header id="myyzDoctor_header" class="bg-green" data-path="<?php echo $urlRootPath; ?>">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">
        <span id="selectDept">
            <span id="deptTitle" class="" data-dept="1">外科</span>
            <span class=""><img class="w10p" src="<?php echo $urlResImage; ?>triangleWhite.png"></span>
        </span>
    </h1>
    <nav id="selectCity" class="right">
        <div class="grid mt17">
            <div class="font-s16 col-0" id="cityTitle" data-city="73">
                上海
            </div>
            <div class="col-0 cityImg"></div>
        </div>
    </nav>
</header>
<article id="myyzDoctor_article" class="active" data-scroll="true" data-api="<?php echo $urlApiDiagnosisdoctors; ?>" data-doctorView="<?php echo $urlDoctorView; ?>">
    <div>
    </div>
</article>
<script>
    $(document).ready(function () {
        J.showMask();
        $.ajax({
            url: '<?php echo $urlApiDiagnosisdoctors; ?>' + '&citys=73&disease_category=1',
            success: function (data) {
                console.log(data);
                readyPage(data);
            },
            error: function (data) {
                J.hideMask();
                console.log(data);
            }
        });
    });
</script>