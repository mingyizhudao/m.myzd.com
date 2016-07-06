<?php
$this->setPageTitle('疾病信息');
$urlQuestionnaire = $this->createUrl('/api/questionnaire');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
#questionnairetwo_article .footer-logo{position:absolute;bottom:0;width:100%;left:0;}
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
</header>
<article id="questionnairetwo_article" class="active" data-scroll="true">
    <div class="pad20">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解一下信息：
        </div>
        <div class="w100 mt30 font-s16">
            <div>2/5：有找医生看过吗？</div>
            <div class="border-gray border-r3 mt20">
                <div class="pad10 border-bottom"><input type="radio" name="questionnaire[answer]" value="去过"/> 看过</div>
                <div class="pad10 border-bottom"><input type="radio" name="questionnaire[answer]" value="没去过" /> 没看过</div>
            </div>
            <div class="questionnaire-error"></div>
        </div>
        <div>
            <button id="QuestionnairetwoSubmit" class="btn btn-abs font-s16 bg-green mt40">
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
        var btnSubmit = $("#QuestionnairetwoSubmit");
        var requestUrl = '<?php echo $urlQuestionnaire; ?>';
        var answer = '';
        $("input[name='questionnaire[answer]']").click(function () {
            $("input[name='questionnaire[answer]']").removeClass('active');
            $(this).addClass('active');
            $("input[name='questionnaire[answer]']").each(function () {
                if ($(this).hasClass("active")) {
                    answer = $(this).val();
                }
            });
        });
        btnSubmit.click(function () {
            if (answer == '') {
                $('.questionnaire-error').html('<div>请您先选择</div>');
            } else {
                $('.questionnaire-error').hide();
                $.ajax({
                    type: 'post',
                    url: requestUrl,
                    data: {"questionnaire[questionnaireNumber]": 2, "questionnaire[answer]": answer},
                    success: function (data) {
                        if (data.status == 'ok') {
                            window.location.href='<?php echo $this->createUrl('questionnaire/view',array('id'=>'3'));?>';
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        console.log(XmlHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });
    });
</script>