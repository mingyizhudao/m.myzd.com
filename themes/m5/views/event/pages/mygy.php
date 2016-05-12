<?php
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlCommonwealDoctors = $this->createAbsoluteUrl('/api/commonwealdoctors');
$urlDoctorView = $this->createUrl('doctor/view', array('id' => ''));
if ($showHeader == 1) {
    $commonwealDoctors = $this->createUrl('event/view', array('page' => 'commonwealDoctors'));
} else {
    $commonwealDoctors = $this->createUrl('event/view', array('page' => 'commonwealDoctors', 'header' => 0));
}
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
        <h1 class="title">名医公益联盟</h1>
        <nav class="right">
            <a onclick="javascript:history.go(0)">
                <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article id="mygy_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277708205890" class="w100">
        </div>
        <div class="pl15 pr15 pt10 pb10 bg-orange2">
            <div class="mt10 bg-white">
                <div class="grid pt20">
                    <div class="col-1 w15"></div>
                    <div class="col-1 w70 bt-black"></div>
                    <div class="col-1 w15"></div>
                </div>
                <div class="grid mt-12">
                    <div class="col-1"></div>
                    <div class="col-0 pl5 pr5 bg-white font-w800">公益联盟</div>
                    <div class="col-1"></div>
                </div>
                <div class="pt10 pl10 pr10 text-justify">
                    名医公益联盟是由名医主动倡导发起，并联合公益组织、医生共建的一种可持续公益模式，希望能够汇聚社会的爱心力量，让更多贫困的患者也能找到名医进行手术。
                </div>
                <div class="pad10">
                    <div class="grid text-center font-s12">
                        <div class="col-1 w50 pr5">
                            <div>
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277754110348" class="w30p">
                            </div>
                            <div class="stepBg mt5 grid middle">
                                选择名医并预约或拨打400-6277-120
                            </div>
                            <div class="mt5">
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277856716089" class="w30p">
                            </div>
                            <div class="stepBg mt5 grid middle">
                                安排手术
                            </div>
                        </div>
                        <div class="col-1 w50 pl5">
                            <div>
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277856666480" class="w30p">
                            </div>
                            <div class="stepBg mt5 grid middle">
                                名医助手评估病情
                            </div>
                            <div class="mt5">
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277856722498" class="w30p">
                            </div>
                            <div class="stepBg mt5 grid middle">
                                确定资助方案
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="doctorList" class="mt10">

            </div>
            <div class="mt10 bg-white">
                <div class="grid pt20">
                    <div class="col-1 w15"></div>
                    <div class="col-1 w70 bt-black"></div>
                    <div class="col-1 w15"></div>
                </div>
                <div class="grid mt-12">
                    <div class="col-1"></div>
                    <div class="col-0 pl5 pr5 bg-white font-w800">联盟公益组织</div>
                    <div class="col-1"></div>
                </div>
                <div class="pb10">
                    <div class="grid text-center mt10">
                        <div class="col-1 w33">
                            <div>
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277909997642" class="w43p">
                            </div>
                            <div>
                                嫣然天使基金
                            </div>
                        </div>
                        <div class="col-1 w33">
                            <div class="pt20">
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277912865164" class="w81p">
                            </div>
                            <div>
                                暖阳基金
                            </div>
                        </div>
                        <div class="col-1 w33">
                            <div class="pt3">
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277923655718" class="w56p">
                            </div>
                            <div>
                                大病救助基金
                            </div>
                        </div>
                    </div>
                    <div class="grid text-center mt10">
                        <div class="col-1 w50">
                            <div class="pt1">
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277926034258" class="w30p">
                            </div>
                            <div>
                                中国少年儿童基金会
                            </div>
                        </div>
                        <div class="col-1 w50">
                            <div>
                                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146277928189097" class="w25p">
                            </div>
                            <div>
                                关注女性健康基金会
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo $urlCommonwealDoctors; ?>',
            success: function (data) {
                console.log(data);
                readyPage(data);
            }
        });

        function readyPage(data) {
            var innerHtml = '';
            var doctors = data.results.page[0];
            console.log(doctors);
            var number = 0;
            for (var i = 0; i < 3; i++) {
                for (var j = 0; j < 3; j++) {
                    var hp_dept_desc = (doctors[number] == '' || doctors[number].desc == null) ? '暂无信息' : doctors[number].desc;
                    hp_dept_desc = hp_dept_desc.length > 45 ? hp_dept_desc.substr(0, 45) + '...' : hp_dept_desc;
                    innerHtml += '<div class="bg-white mt10 br5">';
                    if (number == 0) {
                        innerHtml += '<div class="grid pt20">' +
                                '<div class="col-1 w15"></div>' +
                                '<div class="col-1 w70 bt-black"></div>' +
                                '<div class="col-1 w15"></div>' +
                                '</div>' +
                                '<div class="grid mt-12">' +
                                '<div class="col-1"></div>' +
                                '<div class="col-0 pl5 pr5 bg-white font-w800">名医君</div>' +
                                '<div class="col-1"></div>' +
                                '</div>';
                    }
                    innerHtml += '<a href="<?php echo $urlDoctorView; ?>/' + doctors[number].id + '" class="color-black10">' +
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
                    if (number == 8) {
                        innerHtml += '<div class="pt5"><a href="<?php echo $commonwealDoctors; ?>" class="button btn-yellow font-s16">查看更多专家</a></div>';
                    }
                    innerHtml += '</div></a></div>';
                    number += 1;
                }
            }
            $('#doctorList').html(innerHtml);
        }
    });
</script>