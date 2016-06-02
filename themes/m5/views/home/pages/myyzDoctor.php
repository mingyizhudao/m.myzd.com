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
    <h1 class="title">名医义诊</h1>
</header>
<nav id="myyzDoctor_nav" class="header-secondary bg-white">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w50 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept="1">外科</span><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146364721030297">
        </div>
        <div id="citySelect" class="col-1 w50 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city="73">上海</span><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146364721030297">
        </div>
    </div>
</nav>
<article id="myyzDoctor_article" class="active" data-scroll="true" data-api="<?php echo $urlApiDiagnosisdoctors; ?>" data-doctorView="<?php echo $urlDoctorView; ?>">
    <div class="pt20">
    </div>
</article>
<script>
    $(document).ready(function () {
        J.showMask();
        $.ajax({
            url: '<?php echo $urlApiDiagnosisdoctors; ?>' + '&citys=73&disease_category=1',
            success: function (data) {
                //console.log(data);
                readyPage(data);
            },
            error: function (data) {
                J.hideMask();
                console.log(data);
            }
        });
    });
</script>