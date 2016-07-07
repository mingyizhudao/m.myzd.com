<?php
$this->setPageTitle('疾病信息');
$urlQuestionnaire = $this->createUrl('/api/questionnaire');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    textarea.questionnairethreetextarea{margin-bottom:0px;border-radius:0px;border:none;border-bottom:1px solid #e4e4e4;}
    article{
        background: url('http://7xsq2z.com2.z0.glb.qiniucdn.com/146761944631242') no-repeat;
        background-size: 125px 37px;
        background-position-x: 50%;
        background-position-y: 97%;
    }
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
<article id="questionnairethree_article" class="active" data-scroll="true">
    <div class="pad20">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解一下信息：
        </div>
        <div class="w100 mt30 font-s16">
            <div>3/5：医生诊断您是什么病？</div>
            <div class="border-gray border-r3 mt20">
                <div class="pad10 border-bottom"><input type="radio" name="questionnaire[answer]" value="1"/> 已确诊</div>
                <div><textarea readonly="readonly" class="questionnairethreetextarea form-control" name='questionnaire[answer]' type='text' placeholder="请输入疾病诊断信息"></textarea></div>
                <div class="pad10"><input type="radio" name="questionnaire[answer]" value="2" /> 尚未确诊</div>
            </div>
            <div class="questionnaire-error"></div>
        </div>
        <div>
            <button id="QuestionnairethreeSubmit" class="btn btn-abs font-s16 bg-green mt40">
                下一步
            </button>
        </div>
        <div class="footer-logo">
            <div class="text-center pb20"><img src="" class="w50"/></div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        var btnSubmit = $("#QuestionnairethreeSubmit");
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
            if ($(this).val() == 1) {
                $('.questionnairethreetextarea').removeAttr('readonly');
            } else {
                $('.questionnairethreetextarea').attr('readonly','readonly');
                $('.questionnairethreetextarea').val('');
            }
        });
        btnSubmit.click(function () {
            if (answer == '') {
                $('.questionnaire-error').html('<div>请您先选择</div>');
            } else {
                $('.questionnaire-error').hide();
                if (answer == 1) {
                    answer += '#' + $('.questionnairethreetextarea').val();
                }
                $.ajax({
                    type: 'post',
                    url: requestUrl,
                    data: {"questionnaire[questionnaireNumber]": 3, "questionnaire[answer]": answer},
                    success: function (data) {
                        if (data.status == 'ok') {
                            window.location.href = '<?php echo $this->createUrl('questionnaire/view', array('id' => '4')); ?>';
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