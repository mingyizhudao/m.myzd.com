<?php
$this->setPageTitle('同病不同命');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlDoctorView = $this->createUrl('doctor/view', array('id' => '1296'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php if ($showHeader == 1) { ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <div class="title">同病不同命</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="life_article" class="active story_article" data-scroll="true">
    <div class="color-black">
        <div>
            <img src="http://static.mingyizhudao.com/14695844036236" class="w100">
        </div>
        <div class="pl10 pr10">
            <div class="colorRed font-w800 font-s18 pt20">
                同病不同命
            </div>
            <div class="font-s12 pt10 color-gray8">
                名医主刀<span class="ml7">2016-07-26</span>
            </div>
            <div class="font-s12 mt10 grayBg text-justify text-indent-2">
                美国哈佛大学公共卫生学院根据中国现有的数据和情况曾作出报告，在未来的30年，中国因肺癌致死的人数将高达1800万，这意味着每分钟会有1人死于肺癌。但其实，肺癌是最可预防的癌症之一，但是不同的治疗时间和治疗手段却对病人的结果有着截然不同的影响。
            </div>
            <div class="text-justify text-indent-2 pt10 font-w800">
                患者陈先生今年54岁，在当地医院被检查出患左肺鳞状细胞癌，正当一家人一筹莫展，不知道该怎么办时，陈先生的一个老乡，听说了他的情况，就来到陈先生家中，讲述了自己的经历。
            </div>
            <div class="text-justify text-indent-2 pt10">
                原来，老乡半年之前也被检查出肺癌，自己来到上海找上海胸科医院胸外科主任医师赵珩教授做手术，足足在上海等待了1个多月的时间，耗掉的精力和金钱更是数不清，虽然手术进行的很顺利，术后康复的也很好，可这等床位的遭遇却让他心生胆怯。
            </div>
            <div class="pt10">
                <img src="http://static.mingyizhudao.com/146958446791882" class="w100">
            </div>
            <div class="text-justify text-indent-2 pt10">
                陈先生从老乡口中得知赵珩专家手术做的很好，一心想找赵主任做手术，可是难在求医无门，不知如何才能找到赵主任为他亲自主刀手术。一次在安庆市立医院做检查的偶然机会，让陈先生豁然开朗了。陈先生在医院使用公共WiFi的时候，跳转到了名医主刀官网，看到上面有很多签约专家，通过平台能更方便的完成手术。于是他找来热衷互联网的侄子，让他帮忙在网上提交了病历资料，果不其然，很顺利的就预约上了赵珩教授。
            </div>
            <div class="pt10">
                <img src="http://static.mingyizhudao.com/146958448930114" class="w100">
            </div>
            <div class="text-justify text-indent-2 pt10">
                6月15日，陈先生夫妻二人起身从安徽前往上海，与他联系的名医主刀客服花花当天便带陈先生来到上海胸科医院面诊赵主任，在不占用公共资源的情况下，利用赵主任休息的时间，为陈先生进行了细致的诊断。赵主任说，现在癌细胞还没有开始转移，但是情况仍然不容乐观，需要立刻手术，于是当天下午安排陈先生进行了一系列的检查，并确定了4天后的手术排期，陈先生没想到，能比老乡看病的过程顺利这么多，原先对平台还抱有的一点担忧便烟消云散了，“少受这份折腾，让我多花点钱我也愿意”陈先生说。
            </div>
            <div class="pt10">
                <img src="http://static.mingyizhudao.com/146958451509569" class="w100">
            </div>
            <div class="text-justify text-indent-2 pt10 colorGreen">
                <span class="font-w800">一样的病，一样的医生，陈先生的治病过程却与老乡大相径庭。</span>互联网时代的到来，让大部分人解决了“好看病”的问题，可是真正需要解决的“看好病”确仍旧是个“老大难”，名医主刀致力于为每一位有手术需求的患者解决看病、手术难题，让天下没有难做的手术。同时，名医主刀还推出公益医疗项目，让经济困难患者也能享受同等的名医资源。
            </div>
        </div>
        <div class="lineGreen mt40"></div>
        <div class="grid mt-12">
            <div class="col-1"></div>
            <div class="col-0 colorGreen font-s16 bg-white pl10 pr10 font-w800 borderGreen">
                推荐医生
            </div>
            <div class="col-1"></div>
        </div>
        <div class="pt10 pl10 pr10 pb50">
            <a href="<?php echo $urlDoctorView; ?>" class="color-black">
                <div id="doctorView" class="bg-gray">
                    <div class="grid pt10">
                        <div class="col-1"></div>
                        <div class="col-0">
                            <div class="col-0 br50 w60p h60p overflow-hidden">
                                <img src="http://dr.static.mingyizhudao.com/63D352896C0853B037B8E423A850388C">
                            </div>
                        </div>
                        <div class="col-0 pl10">
                            <div class="pt10">
                                <sapn class="font-w800 colorGreen">赵珩</sapn><span class="pl10">主任医师</span>
                            </div>
                            <div>
                                <span>外科</span><span class="pl10">上海市胸科医院</span>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="pad10 font-s13 text-justify">
                        <span class="font-w800">擅长领域：</span>气管疾病的诊治，胸壁缺损的手术重建，胸腔镜在胸部疾病中的应用，食管癌的早期诊断和根治性手术治疗，心肺功能较差的肺、食管疾病患者手术治疗。
                    </div>
                </div>
            </a>
        </div>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('#doctorView').click(function () {
            $(this).removeClass('bg-gray');
            $(this).addClass('bg-gray2');
        });
    });
</script>