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
            <img src="<?php echo $urlResImage; ?>zhuanti/mygy/title.png" class="w100">
        </div>
        <div class="pl15 pr15 pt10 pb10 bg-blue7">
            <div class="bg-white">
                <div class="grid pt20">
                    <div class="col-1 w15"></div>
                    <div class="col-1 w70 bt-black"></div>
                    <div class="col-1 w15"></div>
                </div>
                <div class="grid mt-12">
                    <div class="col-1"></div>
                    <div class="col-0 pl5 pr5 bg-white font-w800">服务流程</div>
                    <div class="col-1"></div>
                </div>
                <div class="font-s12 pl10 pr10">
                    <div class="grid">
                        <div class="col-1 w50 grid">
                            <div class="col-0 text-center">
                                <div>选择名医并预约</div>
                                <div>或拨打400-6277-120</div>
                                <div class="color-red6">第一步</div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="col-1 w50 pt17 grid">
                            <div class="col-0 text-center">
                                <div>确定资助方案</div>
                                <div class="color-blue10">第三步</div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-1 w10"></div>
                        <div class="col-1 w80">
                            <img src="<?php echo $urlResImage; ?>zhuanti/mygy/step.png">
                        </div>
                        <div class="col-1 w10"></div>
                    </div>
                    <div class="grid pb10">
                        <div class="col-1 w60 grid">
                            <div class="col-1"></div>
                            <div class="col-0 text-center">
                                <div class="color-green9">第二步</div>
                                <div>名医助手评估病情</div>
                            </div>
                        </div>
                        <div class="col-1 w40 text-center">
                            <div class="color-orange3">第四步</div>
                            <div>安排手术</div>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="ml10 mr10 pb10">
                    <div>
                        名医公益是什么？
                    </div>
                    <div class="font-s12 text-justify">
                        <div>
                            名医公益联盟是名医主刀倡导发起，并联合公益组织、医生共建的一种可持续公益模式，旨在让更多患者有机会接受更好的治疗。
                        </div>
                        <div>
                            作为国内最大的移动医疗手术平台，名医主刀每天都能接触到大量需要手术的患者。在沟通中，我们注意到其中不少患者家境贫寒，难以全部承担平台服务费用。
                        </div>
                        <div>
                            名医主刀虽然是新生企业，但“仁爱”一直是我们的初心，我们希望通过名医公益联盟，汇聚社会的爱心力量，让更多贫困的患者也能找到名医进行手术。
                        </div>
                        <div>
                            名医公益联盟中，既有饱含仁爱之心的名医，也有有着丰富救助经验的公益组织。通过对资源的整合和优化配置，让患者好看病、看好病。
                        </div>
                        <div>
                            做手术找名医主刀，做手术遇到困难找名医公益联盟。
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt10 bg-white">
                <div class="grid pt20">
                    <div class="col-1 w15"></div>
                    <div class="col-1 w70 bt-black"></div>
                    <div class="col-1 w15"></div>
                </div>
                <div class="grid mt-12">
                    <div class="col-1"></div>
                    <div class="col-0 pl5 pr5 bg-white font-w800">名医君</div>
                    <div class="col-1"></div>
                </div>
                <div id="doctorList" class="mt10">

                </div>
                <div class="pb10 grid">
                    <div class="col-1"></div>
                    <div class="col-0">
                        <a href="<?php echo $commonwealDoctors; ?>">
                            <div class=" pl20 pr20 pt2 br10 bg-yellow color-white">
                                更多名医
                            </div>
                        </a>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="mt10 bg-white">
                <div class="grid pt20">
                    <div class="col-1 w15"></div>
                    <div class="col-1 w70 bt-black"></div>
                    <div class="col-1 w15"></div>
                </div>
                <div class="grid mt-12">
                    <div class="col-1"></div>
                    <div class="col-0 pl5 pr5 bg-white font-w800">公益大使</div>
                    <div class="col-1"></div>
                </div>
                <div class="pad10">
                    <div class="border-gray pad5 mt15">
                        <div class="grid">
                            <div class="col-0 mr5">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/langyongchun.png" class="w110p">
                            </div>
                            <div class="col-1">
                                <div class="pt5">
                                    郎永淳先生
                                </div>
                                <div class="mt10">
                                    “爱永纯”健康中国基金发起人，原中国中央电视台新闻播音员、主持人，名医公益联盟启动仪式的主持人
                                </div>
                            </div>
                        </div>
                        <div class="mt10">
                            <span class="color-yellow2">寄语：</span>站上舞台是公益活动的主持人，回归生活，希望能够继续主持公益。
                        </div>
                    </div>
                    <div class="border-gray pad5 mt15">
                        <div class="grid">
                            <div class="col-0 mr5">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/wangyan.png" class="w110p">
                            </div>
                            <div class="col-1">
                                <div class="pt5">
                                    王艳女士
                                </div>
                                <div class="mt10">
                                    <div>
                                        中国内地女演员
                                    </div>
                                    <div>
                                        曾获“中国品牌女性公益奖”
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt10">
                            <span class="color-yellow2">寄语：</span>以一己之力帮助更多的手术患者，让公益的力量肩负起生命的希望。
                        </div>
                    </div>
                    <div class="border-gray pad5 mt15">
                        <div class="grid">
                            <div class="col-0 mr5">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/qianjing.png" class="w110p">
                            </div>
                            <div class="col-1">
                                <div class="pt5">
                                    钱婧女士
                                </div>
                                <div class="mt10">
                                    主持人、便道，暖阳基金发起人，大型原创健康公益节目《超级诊疗室》总制片人，名医公益联盟启动仪式主持人
                                </div>
                            </div>
                        </div>
                        <div class="mt10">
                            <span class="color-yellow2">寄语：</span>解决大病手术患者的问题，除了表达爱心外，首先我们要行动起来。
                        </div>
                    </div>
                    <div class="border-gray pad5 mt15">
                        <div class="grid">
                            <div class="col-0 mr5">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/qiaozhen.png" class="w110p">
                            </div>
                            <div class="col-1">
                                <div class="pt5">
                                    乔榛先生
                                </div>
                                <div class="mt10">
                                    中国著名配音演员、导演
                                </div>
                            </div>
                        </div>
                        <div class="mt10">
                            <span class="color-yellow2">寄语：</span>我也曾是和病魔斗争过的病人。可以感同身受到其中的痛苦。希望名医公益联盟的发起，能够聚集成强大的能量，帮助到更多的手术患者。
                        </div>
                    </div>
                </div>
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
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/yanrantianshi.png" class="w43p">
                            </div>
                            <div>
                                嫣然天使基金
                            </div>
                        </div>
                        <div class="col-1 w33">
                            <div class="pt20">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/nuanyang.png" class="w81p">
                            </div>
                            <div>
                                暖阳基金
                            </div>
                        </div>
                        <div class="col-1 w33">
                            <div class="pt3">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/chunhui.png" class="w56p">
                            </div>
                            <div>
                                大病救助基金
                            </div>
                        </div>
                    </div>
                    <div class="grid text-center mt10">
                        <div class="col-1 w50">
                            <div class="pt1">
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/childrenFund.png" class="w30p">
                            </div>
                            <div>
                                中国少年儿童基金会
                            </div>
                        </div>
                        <div class="col-1 w50">
                            <div>
                                <img src="<?php echo $urlResImage; ?>zhuanti/mygy/womanHelth.png" class="w25p">
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
                //console.log(data);
                readyPage(data);
            }
        });

        function readyPage(data) {
            var innerHtml = '';
            var doctors = data.results.page[0];
            //console.log(doctors);
            var number = 0;
            for (var i = 0; i < 2; i++) {
                innerHtml += '<div class="grid text-center pl10 pr10 pb10">';
                for (var j = 0; j < 3; j++) {
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
                }
                innerHtml += '</div>';
            }
            $('#doctorList').html(innerHtml);
        }
    });
</script>