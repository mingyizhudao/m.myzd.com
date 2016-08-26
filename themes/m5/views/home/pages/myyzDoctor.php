<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/myyzDoctor.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/m/myyzDoctor.min.1.2.js', CClientScript::POS_END);
?>
<?php
$this->setPageTitle('名医义诊,免费术前方案评估_名医主刀网移动版');
$this->setPageKeywords('名医义诊,免费术前方案评估');
$this->setPageDescription('名医义诊,免费术前方案评估,现约现看！');
$urlApiDiagnosisdoctors = $this->createAbsoluteUrl('/api/diagnosisdoctors', array('api' => 9));
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlDoctorView = $this->createUrl('doctor/view');
$urlRootPath = $this->createAbsoluteUrl('/themes/');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php
$navTop = '';
$articleTop = '';
if ($showHeader == 0) {
    $navTop = 'top0p';
    $articleTop = 'top30p';
}
?>

<style>
    .top0p{top: 0px!important;}
    .top30p{top: 30px!important;}
</style>
<header id="myyzDoctor_header" class="bg-green" data-path="<?php echo $urlRootPath; ?>">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">免费术前方案评估</h1>
</header>
<nav id="myyzDoctor_nav" class="header-secondary bg-white <?php echo $navTop; ?>">
    <div class="grid w100 color-black font-s16 color-black6">
        <div id="deptSelect" class="col-1 w50 br-gray bb-gray grid middle grayImg">
            <span id="deptTitle" data-dept="1">外科</span><img src="http://static.mingyizhudao.com/146364721030297">
        </div>
        <div id="citySelect" class="col-1 w50 bb-gray grid middle grayImg">
            <span id="cityTitle" data-city="73">上海</span><img src="http://static.mingyizhudao.com/146364721030297">
        </div>
    </div>
</nav>
<article id="myyzDoctor_article" class="active <?php echo $articleTop; ?>" data-scroll="true" data-api="<?php echo $urlApiDiagnosisdoctors; ?>" data-doctorView="<?php echo $urlDoctorView; ?>/id">
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