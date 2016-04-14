<?php
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
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">公益名医</h1>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p">
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
        $.ajax({
            url: '<?php echo $urlCommonwealDoctors; ?>',
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });

        function readyPage(data) {
            var innerHtml = '';
            var doctors = data.results.page[1];
            var number = 0;
            var rowNum = Math.ceil(doctors.length / 3);
            for (var i = 0; i < rowNum; i++) {
                innerHtml += '<div class="grid text-center pb10">';
                for (var j = 0; j < 3; j++) {
                    if (number < doctors.length) {
                        innerHtml += '<div class="col-1 w33 border-gray br5 ml3 mr3">' +
                                '<a href="<?php echo $urlDoctorView; ?>/' + doctors[number].id + '/is_commonweal/1">' +
                                '<div class="pb10 color-black">' +
                                '<div class="grid pt10">' +
                                '<div class="col-1"></div>' +
                                '<div class="col-0 imgDiv">' +
                                '<img src="' + doctors[number].imageUrl + '">' +
                                '</div>' +
                                '<div class="col-1"></div>' +
                                '</div>' +
                                '<div>' + doctors[number].name + '</div>' +
                                '<div class="font-s12">' + doctors[number].hpDeptName + '</div>' +
                                '<div class="font-s12">' + doctors[number].hpName + '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        number += 1;
                    } else {
                        innerHtml += '<div class="col-1 w33 ml3 mr3"></div>';
                    }
                }
                innerHtml += '</div>';
            }
            $('#doctorList').html(innerHtml);
        }
    });
</script>