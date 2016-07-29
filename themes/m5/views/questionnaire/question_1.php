<?php
$this->setPageTitle('疾病信息');
$urlQuestionnaire = $this->createUrl('/api/questionnaire');
$urlApplogstat = $this->createUrl('/api/applogstat');
$source = Yii::app()->request->getQuery('app', 0);
if ($source == 0) {
    $urlQuestion = $this->createUrl('questionnaire/view', array('id' => ''));
} else {
    $urlQuestion = $this->createUrl('questionnaire/view', array('app' => 1, 'id' => ''));
}
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php
if ($source == 0) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">疾病信息</h1>
    </header>
    <?php
}
?>
<article id="questionnaireone_article" class="active logo_article" data-scroll="true">
    <div id="outline" class="pad20 bg-white">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解以下信息：
        </div>
        <div id="questionnaireone-form">
            <div class="w100 mt30 font-s16">
                <div>1/5：请问有什么可以帮您？</div>
                <div class="border-gray border-r3 mt20">
                    <label for="answer1">
                        <div class="pad10 border-bottom">
                            <input id="answer1" type="radio" name="questionnaire[answer]" value="1"/>
                            想找个能帮我做手术的专家
                        </div>
                    </label>
                    <label for="answer2">
                        <div class="pad10 border-bottom">
                            <input id="answer2" type="radio" name="questionnaire[answer]" value="2"/>
                            不知是否要手术，想找专家咨询
                        </div>
                    </label>
                    <label for="answer3">
                        <div class="pad10 border-bottom">
                            <input id="answer3" type="radio" name="questionnaire[answer]" value="3"/>
                            不需要手术，只想咨询一下
                        </div>
                    </label>
                </div>
                <div class="questionnaire-error"></div>
            </div>
            <div>
                <button id="QuestionnaireoneSubmit" class="btn btn-abs font-s16 bg-green mt40">
                    下一步
                </button>
            </div>
        </div>
    </div>
    <div id="logoImg" class="text-center hide pb20">
        <img src="http://static.mingyizhudao.com/146761944631242" class="w125p">
    </div>
</article>
<script>
    $(document).ready(function () {
        var articleHeight = $('article').height();
        var height = $('#outline').height();
        if (articleHeight - height - 58 > 0) {
            $('article').addClass('logoBackground');
        } else {
            $('#logoImg').removeClass('hide');
        }

        var btnSubmit = $("#QuestionnaireoneSubmit");
        var requestUrl = '<?php echo $urlQuestionnaire; ?>';
        var answer = '';
        $("input[name='questionnaire[answer]']").click(function () {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlApplogstat; ?>',
                data: {'applogstat[question]': 1, 'applogstat[answer]': $(this).val()},
                success: function () {

                }
            });
            $('.questionnaire-error').html('');
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
                $('.questionnaire-error').html('<div class="error">请您先选择</div>');
            } else {
                $('.questionnaire-error').hide();
                disabledBtn(btnSubmit);
                $.ajax({
                    type: 'post',
                    url: requestUrl,
                    data: {"questionnaire[questionnaireNumber]": 1, "questionnaire[answer]": answer},
                    success: function (data) {
                        if (data.status == 'ok') {
                            J.hideMask();
                            location.href = '<?php echo $urlQuestion; ?>/2';
                        } else {
                            if (data.errorMsg == 'faile answer') {
                                J.hideMask();
                                location.href = '<?php echo $urlQuestion; ?>/1';
                            }
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        enableBtn(btnSubmit);
                        console.log(XmlHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });
    });
</script>