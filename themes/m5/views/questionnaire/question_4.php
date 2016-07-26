<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/qiniu/css/qiniu.base.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/qiniu.base.min.js?ts=' . time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/js/zeroBooking.min.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$this->setPageTitle('疾病信息');
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlQiniuAjaxToken = $this->createUrl('qiniu/ajaxBookingToken');
$urlUploadFile = $this->createUrl("/api/questionnairefile");
$urlQuestionnaire = $this->createUrl('/api/questionnaire');
$source = Yii::app()->request->getQuery('app', 0);
if ($source == 0) {
    $urlQuestion = $this->createUrl('questionnaire/view', array('id' => ''));
} else {
    $urlQuestion = $this->createUrl('questionnaire/view', array('app' => 1, 'id' => ''));
}
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    #jingle_popup {
        background-color: #ffffff;
        top: 30%!important;
        margin-top: 0px!important;
    }
</style>
<?php
if ($source == 0) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">疾病信息</h1>
    </header>
    <?php
}
?>
<article id="questionnairefour_article" class="active android_article logo_article" data-scroll="true" data-action-url="<?php echo $urlQuestionnaire; ?>" data-return-url="<?php echo $urlQuestion; ?>">
    <div id="outline" class="pad20 bg-white">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解以下信息：
        </div>
        <div class="w100 mt30 font-s16">
            <div>4/5：请将您近期检查报告拍照上传</div>
            <div class="mt5"><span class="color-red">图片需清晰可见</span><span>（最多9张）</span><span class="border-grayD learn-example">查看示例</span></div>
            <input type="hidden" id="domain" value="http://mr.file.mingyizhudao.com">
            <input type="hidden" id="uptoken_url" value="<?php echo $urlQiniuAjaxToken; ?>">
            <div id="fileAction" class="mt20" data-action="<?php echo $urlUploadFile; ?>">
                <div class="body mt10">
                    <div>
                        <div id="container">
                            <a class="btn btn-default btn-lg" id="pickfiles" href="#">
                                <span>
                                    <img src="http://static.mingyizhudao.com/146770314701592" class="w90p">
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
        <div class="pt20">
            <a id="skip" href="javascript:;" class="skipBtn">跳过</a>
        </div>
    </div>
    <div id="logoImg" class="text-center hide pb20">
        <img src="http://static.mingyizhudao.com/146761944631242" class="w125p">
    </div>
</article>
<div id="jingle_toast" class="toast"><a href="#"></a></div>
<div id="loading_popup_mask" style="opacity: 0.1;"></div>
<div id="loading_popup" class="loading">
    <i class="icon spinner"></i>
    <p>图片上传中...</p>
    <div id="tag_close_popup" data-target="closePopup" class="icon cancel-circle"></div>
</div>
<script>
    $(document).ready(function () {
        var articleHeight = $('article').height();
        var height = $('#outline').height();
        if (articleHeight - height - 98 > 0) {
            $('article').addClass('logoBackground');
        } else {
            $('#logoImg').removeClass('hide');
        }

        $('.learn-example').click(function () {
            var innerHtml = '<div class="pad10" data-target="closePopup">' +
                    '<div class="font-s16">示例：</div>' +
                    '<div>B超、X光片、CT片、MRL、检验报告、病理报告等。</div>' +
                    '<div class="grid pt10 text-center">' +
                    '<div class="col-1 w50">' +
                    '<img src="http://static.mingyizhudao.com/146786157891659" class="w123p">' +
                    '</div>' +
                    '<div class="col-1 w50">' +
                    '<img src="http://static.mingyizhudao.com/146786157926638" class="w123p">' +
                    '</div>' +
                    '</div>' +
                    '<img src="">' +
                    '</div>';
            J.popup({
                html: innerHtml,
                pos: 'center'
            });
        });
    });
</script>