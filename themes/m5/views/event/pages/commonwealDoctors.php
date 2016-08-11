<?php
$this->setPageTitle('公益名医');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlCommonwealDoctors = $this->createAbsoluteUrl('/api/commonwealdoctors');
$urlDoctorView = $this->createUrl('doctor/view', array('id' => ''));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>

<?php if ($showHeader == 1) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">公益名医</h1>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574" class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article id="commonwealDoctors_article" class="active" data-scroll="true">
    <div id="doctorList" class="pad10">

    </div>
</article>
<script>
    $(document).ready(function () {
        J.showMask();
        $.ajax({
            url: '<?php echo $urlCommonwealDoctors; ?>',
            success: function (data) {
                //console.log(data);
                readyPage(data);
            },
            error: function () {
                J.hideMask();
            }
        });

        function readyPage(data) {
            var innerHtml = '';
            var doctors = data.results.page[1];
            var number = 0;
            var rowNum = Math.ceil(doctors.length / 3);
            for (var i = 0; i < rowNum; i++) {
                for (var j = 0; j < 3; j++) {
                    if (number < doctors.length) {
                        var hp_dept_desc = (doctors[number] == '' || doctors[number].desc == null) ? '暂无信息' : doctors[number].desc;
                        hp_dept_desc = hp_dept_desc.length > 45 ? hp_dept_desc.substr(0, 45) + '...' : hp_dept_desc;
                        innerHtml += '<div class="bg-white mt10 br5">' +
                                '<a href="<?php echo $urlDoctorView; ?>/' + doctors[number].id + '" class="color-black10">' +
                                '<div class="pb10">' +
                                '<div class="grid pl15 pr15 pb10 pt10">' +
                                '<div class="col-1 w25">' +
                                '<div class="w60p h60p br50" style="overflow:hidden;">' +
                                '<img class="imgDoc" src="' + doctors[number].imageUrl + '">' +
                                '</div>' +
                                '</div>' +
                                '<div class="ml10 col-1 w75">' +
                                '<div class="grid">' +
                                '<div class="col-0 font-s16">' + doctors[number].name +
                                '</div>' +
                                '</div>';
                        if (doctors[number].hpDeptName == null) {
                            innerHtml += '<div class="color-black6">' + doctors[number].mTitle + '</div>';
                        } else {
                            innerHtml += '<div class="color-black6">' + doctors[number].hpDeptName + '<span class="ml5">' + doctors[number].mTitle + '</span></div>';
                        }
                        innerHtml += '<div class="color-black6">' + doctors[number].hpName + '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="ml5 mr5 pad10 bg-gray2 text-justify">' +
                                '擅长：' + hp_dept_desc +
                                '</div>';
                        innerHtml += '</div></a></div>';
                        number += 1;
                    } else {
                        innerHtml += '<div class="col-1 w33 ml3 mr3"></div>';
                    }
                }
            }
            $('#doctorList').html(innerHtml);
            J.hideMask();
        }
    });
</script>