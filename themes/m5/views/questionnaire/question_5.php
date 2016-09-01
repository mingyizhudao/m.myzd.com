<?php
$this->setPageTitle('疾病信息');
$urlQuestionnaire = $this->createUrl('/api/questionnaire');
$urlApplogstat = $this->createUrl('/api/applogstat');
$urlDoctorSearch = $this->createUrl('doctor/search');
$source = Yii::app()->request->getQuery('app', 0);
if ($source == 0) {
    $urlQuestionnaireView = $this->createUrl('questionnaire/view', array('id' => 1));
} else {
    $urlQuestionnaireView = $this->createUrl('questionnaire/view', array('app' => 1, 'id' => 1));
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
<article id="questionnairefive_article" class="active logo_article" data-scroll="true">
    <div>
        <div id="outline" class="pad20 bg-white">
            <div class="w100 color-green text18">
                为了更好地给您提供诊疗意见，我们需要了解以下信息：
            </div>
            <div class="w100 mt30 font-s16">
                <div>5/5：医生建议怎么治疗？</div>
                <div class="border-gray border-r3 mt20">
                    <label for="answer1">
                        <div class="pad10 border-bottom">
                            <input id="answer1" type="radio" name="questionnaire[answer]" value="1" data_attr="建议手术"/>
                            建议手术
                        </div>
                    </label>
                    <label for="answer2">
                        <div class="pad10 border-bottom">
                            <input id="answer2" type="radio" name="questionnaire[answer]" value="2" data_attr="建议观察"/>
                            建议观察
                        </div>
                    </label>
                    <label for="answer3">
                        <div class="pad10 border-bottom">
                            <input id="answer3" type="radio" name="questionnaire[answer]" value="3" data_attr="还需检查，必要时手术"/>
                            还需检查，必要时手术
                        </div>
                    </label>
                </div>
                <div class="questionnaire-error"></div>
            </div>
            <div>
                <button id="QuestionnairefiveSubmit" class="btn btn-abs font-s16 bg-green mt40">
                    去选择专家
                </button>
            </div>
        </div>
        <div id="logoImg" class="text-center hide pb20 bg-white">
            <img src="http://static.mingyizhudao.com/146761944631242" class="w125p">
        </div>
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

        var btnSubmit = $("#QuestionnairefiveSubmit");
        var requestUrl = '<?php echo $urlQuestionnaire; ?>';
        var answer = '';
        var answer_note = '';
        $("input[name='questionnaire[answer]']").click(function () {
            $.ajax({
                type: 'post',
                url: '<?php echo $urlApplogstat; ?>',
                data: {'applogstat[question]': 5, 'applogstat[answer]': $(this).val(), 'applogstat[answer_note]': $(this).attr('data_attr')},
                success: function () {

                }
            });
            $('.questionnaire-error').html('');
            $("input[name='questionnaire[answer]']").removeClass('active');
            $(this).addClass('active');
            $("input[name='questionnaire[answer]']").each(function () {
                if ($(this).hasClass("active")) {
                    answer = $(this).val();
                    answer_note = $(this).attr('data_attr');
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
                    data: {"questionnaire[questionnaireNumber]": 5, "questionnaire[answer]": answer, "questionnaire[answer_note]": answer_note},
                    success: function (data) {
                        if (data.status == 'ok') {
                            actionAjaxFinishQuestionnaire();
                        } else {
                            if (data.errorMsg == 'faile answer') {
                                J.hideMask();
                                location.href = '<?php echo $urlQuestionnaireView; ?>';
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
        function actionAjaxFinishQuestionnaire() {
            $.ajax({
                type: 'post',
                url: '<?php echo $this->createUrl('questionnaire/ajaxFinishQuestionnaire'); ?>',
                success: function (data) {
                    if (data.status == 'ok') {
                        J.hideMask();
                        if ('<?php echo $source; ?>' == 0) {
                            location.href = '<?php echo $urlDoctorSearch; ?>?source=1&disease_sub_category=101';
                        } else {
                            location.href = '<?php echo $urlDoctorSearch; ?>?app=1&source=1&disease_sub_category=101';
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
</script>