<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/myyzDoctor.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$urlApiDiagnosisdoctors = $this->createAbsoluteUrl('/api/diagnosisdoctors', array('api' => 9));
$urlDoctorView = $this->createUrl('doctor/view', array('id' => ''));
$urlRootPath = $this->createAbsoluteUrl('/themes/');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<style>
    #myyzDoctor_header #cityTitle{
        line-height: 1em;
    }
    #myyzDoctor_header .cityImg{
        background: url('<?php echo $urlResImage; ?>/cityLogo.png') no-repeat;
        background-size: 15px 8px;
        width:15px;
        background-position-y: 5px;
    }

    #myyzDoctor_article .imgDiv {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 1px solid #cccccc;
        overflow: hidden;
    }
    #myyzDoctor_article ul.list>li {
        border-bottom: 1px solid #efefef;
    }
</style>
<header id="myyzDoctor_header" class="bg-green" data-path="<?php echo $urlRootPath; ?>">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">
        <span id="selectDept">
            <span id="deptTitle" class="" data-dept="">选择科室</span>
            <span class=""><img class="w10p" src="<?php echo $urlResImage; ?>triangleWhite.png"></span>
        </span>
    </h1>
    <nav id="selectCity" class="right">
        <div class="grid mt17">
            <div class="font-s16 col-0" id="cityTitle" data-city="">
                上海
            </div>
            <div class="col-0 cityImg"></div>
        </div>
    </nav>
</header>
<article id="myyzDoctor_article" class="active" data-scroll="true" data-api="<?php echo $urlApiDiagnosisdoctors; ?>">
    <div>
    </div>
</article>
<script>
    $(document).ready(function () {
        console.log('<?php echo $urlRootPath; ?>');
        $.ajax({
            url: '<?php echo $urlApiDiagnosisdoctors; ?>' + '&city=1&disease_category=1',
            success: function (data) {
                //console.log(data);
                readyPage(data);
            }
        });

        function readyPage(data) {
            var doctors = data.results.page[0];
            var pageSize = Math.ceil(doctors.length / 3);
            var innerHtml = '<div class="pad10">';
            for (var i = 0; i < pageSize; i++) {
                innerHtml += '<div class="grid text-center pb10">';
                for (var j = 0; j < 3; j++) {
                    var num = i * 3 + j;
                    if (num < doctors.length) {
                        var hpDeptName = doctors[num].hpDeptName;
                        var hpName = doctors[num].hpName;
                        if (hpDeptName == null || hpDeptName == '') {
                            hpDeptName = '';
                        }
                        if (hpName == null || hpName == '') {
                            hpName = '';
                        }
                        innerHtml += '<div class="col-1 w33 border-gray br5 ml3 mr3">' +
                                '<a href="<?php echo $urlDoctorView; ?>/' + doctors[num].id + '/is_commonweal/1">' +
                                '<div class="pb10 color-black">' +
                                '<div class="grid pt10">' +
                                '<div class="col-1"></div>' +
                                '<div class="col-0 imgDiv">' +
                                '<img src="' + doctors[num].imageUrl + '">' +
                                '</div>' +
                                '<div class="col-1"></div>' +
                                '</div>' +
                                '<div>' + doctors[num].name + '</div>' +
                                '<div class="font-s12">' + hpDeptName + '</div>' +
                                '<div class="font-s12">' + hpName + '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                    } else {
                        innerHtml += '<div class="col-1 w33 ml3 mr3"></div>';
                    }
                }
                innerHtml += '</div>';
            }
            innerHtml += '</div>';
            $('#myyzDoctor_article').html(innerHtml);
        }
    });
</script>