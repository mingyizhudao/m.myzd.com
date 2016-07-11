<?php
$this->setPageTitle('意向专家');
$source = Yii::app()->request->getQuery('source', 0);
$doctorView = $this->createUrl('doctor/view', array('source' => '1', 'id' => ''));
$urlQuestionnaireBookingView = $this->createUrl('questionnaire/questionnaireBookingView', array('source' => 1));
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$this->show_footer = false;
?>
<header class="bg-green search">
    <div class="grid w100">
        <div class="col-1 pl10">
            <i class="icon_search"></i>
            <input class="icon_input" type="text" placeholder="请输入你意向的专家">
            <a class="icon_clear hide"></a>
        </div>
        <a id="searchBtn" href="" class="col-0 pl5 pr5" data-target="back">
            取消
        </a>
    </div>
</header>
<article id="questionnaireSearch_article" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        var searchValue = $("input").val();
        if (searchValue != '') {
            ajaxPage(searchValue);
        }

        $('.icon_clear').click(function () {
            $('input').val('');
            $(this).addClass('hide');
        });
        document.addEventListener('input', function (e) {
            e.preventDefault();
            var searchValue = $("input").val();
            if (searchValue == '') {
                $('#search_article').html('');
                $('.icon_clear').addClass('hide');
                return;
            } else if (searchValue.match(/[a-zA-Z]/g) != null) {
                $('.icon_clear').removeClass('hide');
            } else {
                $('.icon_clear').removeClass('hide');
                ajaxPage(searchValue);
            }
        });
        function ajaxPage(searchValue) {
            $.ajax({
                url: '<?php echo $urlSearch; ?>' + searchValue,
                success: function (data) {
                    readyPage(data, searchValue);
                }
            });
        }
        function readyPage(data, searchValue) {
            var innerHtml = '<div>';
            var doctors = data.results.doctors;
            if (doctors != undefined) {
                for (var i = 0; i < doctors.length; i++) {
                    var doctor = doctors[i];
                    innerHtml += '<div class="bg-white mb10">' +
                            '<a href="<?php echo $doctorView; ?>/' + doctor.id + '" data-target="link">' +
                            '<div class="grid pl15 pr15">' +
                            '<div class="col-1 w25 pt10">' +
                            '<div class="w60p h60p br50" style="overflow:hidden;">' +
                            '<img class="imgDoc" src="' + doctor.imageUrl + '">' +
                            '</div>' +
                            '</div>' +
                            '<div class="ml10 col-1 w75">' +
                            '<div class="grid">' +
                            '<div class="col-0 pt10 color-black2">' +
                            '<span class="font-s16">' + doctor.name + '</span>' +
                            '<span class="ml5">' + doctor.aTitle + '</span>' +
                            '</div>' +
                            '</div>' +
                            '<div class="color-black6">' + doctor.hpDeptName +
                            '<span class="ml5">' + doctor.mTitle + '</span>' +
                            '</div>' +
                            '<div class="color-black6">' + doctor.hpName + '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="pl15 pr15 pt5 pb10 color-black">' +
                            '<span class="font-w800">擅长:</span>' + doctor.desc +
                            '</div>' +
                            '</a>' +
                            '</div>';
                }
            }
            innerHtml += '<div class="pad10">' +
                    '<a href="<?php echo $urlQuestionnaireBookingView; ?>" class="noDoctor">' +
                    '还没您想要的专家？直接填写>' +
                    '</a>' +
                    '</div>' +
                    '</div>';
            $('article').html(innerHtml);
        }
    });
</script>