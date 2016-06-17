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
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article id="mygy_article" class="active" data-scroll="true">
    <div class="pageBg">
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356505242989" class="w100">
        </div>
        <div class="pl10 pr10 color-black11 text-justify">
            <div class="font-s18 color-brown2 bl2-brown pl10 font-w800">
                名医公益联盟是什么？
            </div>
            <div class="pt10">
                名医公益联盟是名医主刀倡导发起，并联合公益组织、医生共建的一种可持续公益模式，旨在让更多患者有机会接受更好的治疗。
            </div>
            <div>
                作为国内最大的移动医疗手术平台，名医主刀每天都能接触到大量需要手术的患者，其中不少患者家境贫寒难以全部承担手术服务费用。名医主刀一直将“仁爱”视为核心文化，希望通过名医公益联盟，汇聚社会爱心力量，帮助贫困患者解决“好看病，看好病”的切实需求。
            </div>
            <div class="font-s18 color-brown2 bl2-brown pl10 font-w800 mt10">
                如何预约公益联盟？
            </div>
            <div class="pt10">
                您可以直接在线点击或拨打客服热线预约以下医生，名医助手会在1个工作日回访确认，并指导填写申请表格。 通过审核的申请者可以免支付专家会诊费。如有家庭条件特别困难的患者，可以申请“名医公益援助金”。通过审核的申请者可以获得5000-10000元的援助金。如患者本人因病暂无能力自行申请，需指定委托人填写。
            </div>
            <div class="font-s18 color-brown2 bl2-brown pl10 font-w800 mt10">
                捐赠手术的名医？
            </div>
            <div id="doctorList">

            </div>
            <div class="font-s18 color-brown2 bl2-brown pl10 font-w800 mt10">
                公益合作？
            </div>
            <div class="grid mt10">
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274732063" class="w90p">
                    </div>
                    <div class="pad5">柏惠维康</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274744742" class="w90p">
                    </div>
                    <div class="pad5">复兴基金会</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/14635627474103" class="w90p">
                    </div>
                    <div class="pad5">上海德济医院</div>
                </div>
            </div>
            <div class="grid">
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274736592" class="w90p">
                    </div>
                    <div class="pad5">春晖博爱</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274748782" class="w90p">
                    </div>
                    <div class="pad5">和睦家医疗</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274776219" class="w90p">
                    </div>
                    <div class="pad5">嫣然天使基金</div>
                </div>
            </div>
            <div class="grid pb50">
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/14635627471871" class="w90p">
                    </div>
                    <div class="pad5">爱永纯</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274771177" class="w90p">
                    </div>
                    <div class="pad5">暖阳基金</div>
                </div>
                <div class="col-1 w33 text-center">
                    <div>
                        <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146356274781396" class="w90p">
                    </div>
                    <div class="pad5">中国儿童少年基金会</div>
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
                readyPage(data);
            }
        });

        function readyPage(data) {
            var innerHtml = '';
            var doctors = data.results.page[0];
            var number = 0;
            for (var i = 0; i < 3; i++) {
                for (var j = 0; j < 3; j++) {
                    var hp_dept_desc = (doctors[number] == '' || doctors[number].desc == null) ? '暂无信息' : doctors[number].desc;
                    hp_dept_desc = hp_dept_desc.length > 45 ? hp_dept_desc.substr(0, 45) + '...' : hp_dept_desc;
                    innerHtml += '<div class="bg-white mt10 border-grayD2">' +
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
                            '<div class="ml10 mr10 pad10 bg-gray2 text-justify">' +
                            '擅长：' + hp_dept_desc +
                            '</div>';
                    if (number == 8) {
                        innerHtml += '<div class="mt10"><a href="<?php echo $commonwealDoctors; ?>" class="moreDoctor">查看更多专家</a></div>';
                    }
                    innerHtml += '</div></a></div>';
                    number += 1;
                }
            }
            $('#doctorList').html(innerHtml);
        }
    });
</script>