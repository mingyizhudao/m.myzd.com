<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/qiniu.base.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/qiniu.base.min.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/zeroBooking.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$this->setPageTitle('疾病信息');
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$urlUploadFile = $this->createUrl("/api/questionnairefile");
$urlQuestion = $this->createUrl('questionnaire/view', array('id' => '5'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    .android_article .btn-default{
        background-color: #fff!important;
    }
    .android_article .btn{
        padding: 0px;
    }
    #container a{
        width: inherit;
        min-width: inherit;
    }
    .btn-file{
        background-color: #06C1AE;
        width: 100%;
        display: block;
        margin: 5px auto;
    }

    #questionnairefour_article .footer-logo{position:absolute;bottom:0;width:100%;left:0;}

    .w123p{width: 123px;}
</style>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">疾病信息</h1>
    <nav class="right" style="top:2px!important;">
        <div class="font-s16">
            <a href="<?php echo $this->createUrl('questionnaire/view', array('id' => '5')); ?>">跳过</a>
        </div>
    </nav>
</header>
<article id="questionnairefour_article" class="active android_article" data-scroll="true" data-action-url="<?php echo $urlQuestion; ?>">
    <div class="pad20">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解一下信息：
        </div>
        <div class="w100 mt30 font-s16">
            <div>4/5：请您上传患者的相关病例资料</div>
            <div class="mt5"><span class="color-red">图片清晰可见</span><span>（最多9张）</span><span class="border-grayD learn-example">查看示例</span></div>
            <input type="hidden" id="domain" value="http://mr.file.mingyizhudao.com">
            <input type="hidden" id="uptoken_url" value="<?php echo $urlQiniuAjaxToken; ?>">
            <div id="fileAction" class="mt20" data-action="<?php echo $urlUploadFile; ?>">
                <div class="body mt10">
                    <div>
                        <div id="container">
                            <a class="btn btn-default btn-lg" id="pickfiles" href="#">
                                <span>
                                    <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146770314701592" class="w90p">
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 mt10">
                        <table class="table table-striped table-hover text-left" style="display:none">
                            <tbody id="fsUploadProgress">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt20">
            <button id="btnSubmit" class="btn-file">
                下一步
            </button>
        </div>
        <div class="footer-logo">
            <div class="text-center pb20"><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146761944631242" class="w50"/></div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('.learn-example').click(function () {
            var innerHtml = '<div style="text-align: center;font-size: 20px;font-weight: 600;margin-top: 10px;color:#E74C3C ">' +
                    '<div>示例：</div>' +
                    '<div>B超、X光片、CT片、MRL、检验报告、病理报告等。</div>' +
                    '<div class="grid">' +
                    '<div class="col-1 w50">' +
                    '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146786157891659" class="w123p">' +
                    '</div>' +
                    '<div class="col-1 w50">' +
                    '<img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146786157926638" class="w123p">' +
                    '</div>' +
                    '</div>' +
                    '<img src="">' +
                    '</div>';
            J.popup({
                html: innerHtml,
                pos: 'center'
            })
        });
    });
</script>