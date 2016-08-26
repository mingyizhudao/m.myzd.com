<?php
$this->setPageTitle('意向专家');
$source = Yii::app()->request->getQuery('source', 0);
$sourceApp = Yii::app()->request->getQuery('app', 0);
if ($sourceApp == 0) {
    $doctorView = $this->createUrl('doctor/view', array('source' => '1'));
    $urlQuestionnaireBookingView = $this->createUrl('questionnaire/questionnaireBookingView', array('source' => 1));
} else {
    $doctorView = $this->createUrl('doctor/view', array('app' => 1, 'source' => '1'));
    $urlQuestionnaireBookingView = $this->createUrl('questionnaire/questionnaireBookingView', array('app' => 1, 'source' => 1));
}
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$urlApplogstat = $this->createUrl('/api/applogstat');
$this->show_footer = false;
$urlStat = $this->createAbsoluteUrl('/api/stat');
//modify by wanglei   有结果进行统计
$SITE_7  = PatientStatLog::SITE_7;
?>
<style>
    .right10p{right:10px!important;}
</style>
<header class="<?php echo $sourceApp == 0 ? 'bg-green' : 'bg-gray4 bb-none'; ?> search">
    <div class="grid w100">
        <div class="col-1 pl10">
            <i class="icon_search"></i>
            <input class="icon_input" type="text" placeholder="请输入你意向的专家">
            <a class="icon_clear hide <?php echo $sourceApp == 0 ? '' : 'right10p'; ?>"></a>
        </div>
        <?php
        if ($sourceApp == 0) {
            ?>
            <a href="" class="col-0 pl5 pr5" data-target="back">
                取消
            </a>
            <?php
        } else {
            ?>
            <div class="col-0 pl10">
            </div>
            <?php
        }
        ?>
    </div>
</header>
<article id="questionnaireSearch_article" class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
        //0元面诊添加页面访问次数访问
        $.ajax({
            type: 'post',
            url: '<?php echo $urlApplogstat; ?>',
            data: {'applogstat[source]': 2},
            success: function () {

            }
        });
        var firstpage=0;
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
                firstpage=0;
                ajaxPage(searchValue);
            }
        });
         function searchdataStat(){
            $.ajax({
                type: 'post',
                url: '<?php echo $urlStat; ?>',
                data: {'stat[site]': '<?php echo $SITE_7; ?>', 'stat[key_word]':'搜索结果页展示'},
                success: function (data) {

                }
            });
        }
        function ajaxPage(searchValue) {
            $.ajax({
                url: '<?php echo $urlSearch; ?>' + searchValue,
                success: function (data) {
                    if(data.results && firstpage==0){
                        searchdataStat();
                        firstpage=1;
                    }
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
                    var desc = (doctor.desc == '' || doctor.desc == null) ? '暂无信息' : doctor.desc;
                    innerHtml += '<div class="bg-white mb10">' +
                            '<a href="<?php echo $doctorView; ?>/id/' + doctor.id + '" data-target="link">' +
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
                            '</div>';
                    /*科室为空，则不显示*/
                    if (doctor.hpDeptName == "" || doctor.hpDeptName == null) {
                        if (doctor.mTitle == "" || doctor.mTitle == null) {
                            innerHtml += '';
                        } else {
                            innerHtml += '<div class="color-black6">' + doctor.mTitle + '</div>';
                        }
                    } else {
                        if (doctor.mTitle == "" || doctor.mTitle == null) {
                            innerHtml += '<div class="color-black6">' + doctor.hpDeptName + '</div>';
                        } else {
                            innerHtml += '<div class="color-black6">' + doctor.hpDeptName + '<span class="ml5">' + doctor.mTitle + '</span></div>';
                        }
                    }
                    innerHtml += '<div class="color-black6">' + doctor.hpName + '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="pl15 pr15 pt5 pb10 color-black">' +
                            '<span class="font-w800">擅长:</span>' + desc +
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