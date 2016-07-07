<?php
$this->setPageTitle('意向专家');
$source = Yii::app()->request->getQuery('source', 0);
$doctorView = $this->createUrl('doctor/view', array('source' => '1', 'id' => ''));
$urlQuestionnaireBookingView = $this->createUrl('questionnaire/questionnaireBookingView', array('source' => 1));
$urlSearch = $this->createAbsoluteUrl('/api/search', array('name' => ''));
$this->show_footer = false;
?>
<style>
    .search .icon_search {
        position: absolute;
        left: 15px;
        top: 9px;
        width: 15px;
        height: 25px;
        background: url('http://7xsq2z.com2.z0.glb.qiniucdn.com/146243645256928') no-repeat;
        background-size: 15px 15px;
        background-position: 0 5px;
    }
    .search .icon_input {
        color: #000;
        margin-bottom: 0;
        border-radius: 5px!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
        padding: 0 10px 0 30px!important;
        height: 30px!important;
        border: none!important;
        margin-top: 7px;
    }
    .search .icon_clear {
        position: absolute;
        top: 9px;
        right: 40px;
        padding: 0 10px;
        width: 35px;
        height: 25px;
        background: url('http://7xsq2z.com2.z0.glb.qiniucdn.com/146717942005220') no-repeat;
        background-size: 15px 15px;
        background-position: 10px 5px;
    }
    article{
        background-color: #f1f1f1;
    }
    .noDoctor{
        border: 1px solid #A0A0A0;
        border-radius: 5px;
        font-size: 16px;
        color: #7C7C7C;
        text-align: center;
        padding: 10px 0px;
        display: block;
    }
</style>
<header class="bg-green search">
    <div class="grid w100">
        <div class="col-1 pl10">
            <i class="icon_search"></i>
            <input class="icon_input" type="text" placeholder="请输入你意向的专家">
            <a class="icon_clear hide"></a>
        </div>
        <div id="searchBtn" class="col-0 pl5 pr5">
            取消
        </div>
    </div>
</header>
<article class="active" data-scroll="true">
    <div>

    </div>
</article>
<script>
    $(document).ready(function () {
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
                            '<a href="<?php echo $doctorView; ?>/3097" data-target="link">' +
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