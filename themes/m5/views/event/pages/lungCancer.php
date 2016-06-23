<?php
$this->setPageTitle('肺癌知多少');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<?php if ($showHeader == 1) { ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
                </div>
            </a>
        </nav>
        <div class="title">肺癌知多少</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="lungCancer_article" class="active" data-scroll="true">
    <div>
        <div>
            <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146347843515058" class="w100">
        </div>
        <div class="pl8 pr8 text-justify">
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">"其实，肺癌是最可预防的癌症之一"</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span><span class="color-orange4 font-w800">早发现、早治疗</span>对于肺癌患者十分重要。<span class="color-orange4 font-w800">手术</span>是目前肺癌<span class="color-orange4 font-w800">最主要</span>的治疗方式，同时多学科的合作，预防术后并发症也不能忽视。术后良好的恢复、积极的心态才能达到最佳治疗效果。所以不仅仅要重视手术，更要重视多角度的综合治疗。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">发现了肺癌该怎么办，需要立刻手术吗？</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>对于已经确诊为肺癌的患者而言，并不是都能进行手术治疗的。首先，需要查看肺癌有无转移，当确定没有远处转移时，还需要评估患者是否能够耐受手术。当患者心肺功能较差时，可能不能耐受手术，这部分患者就不能进行手术治疗。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">首次治疗对患者很重要吗？为什么？</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span><span class="color-orange4 font-w800">首次治疗</span>对患者的确很重要。当癌症诊断后，如何治疗是非常复杂的。患者及其家属首先需要与自己的首诊医生进行充分沟通。此外，如果发现时是早期肺癌，患者不重视，可能会耽误治疗，等到肺癌出现转移时再重视，可能就迟了。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">小细胞肺癌能够手术治疗吗？</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>当患者确诊为小细胞肺癌时，原则上需要<span class="color-orange4 font-w800">先化疗两个疗程</span>，化疗结束后如果患者没有出现远处转移，则适合手术治疗。手术以后，患者需要<span class="color-orange4 font-w800">再进行4～6个疗程</span>的化疗或者放疗。换言之，小细胞肺癌也可以手术，只是术前需要进行两个疗程的化疗，这样进行手术时，效果会比较好。
            </div>
            <div class="pt25 font-s16 color-red7">
                <div>术后可能出现哪些并发症？</div>
                <div>
                    <span class="bb-red">这些并发症对治疗效果影响大吗？</span>
                </div>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>肺部手术主要的并发症是<span class="color-orange4 font-w800">肺部炎症</span>。另外，如果术前患者心功能较差，术后可能会出现心功能紊乱；如果本身患有糖尿病，术后可能出现高血糖，甚至发生酮症酸中毒。但如果术前准备比较充分，这部分患者术后的症状基本可以避免。现在手术前的评估非常仔细，而且术前医生会用药控制患者的血糖，达到正常范围内再手术。因此，术后这部分患者出现并发症的几率非常低，对于手术效果也几乎没有影响。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">如何预防术后肺炎和肺不张的发生？</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>为了预防肺炎，术前会进行3～5天的抗生素治疗；术后第二天就鼓励病人下床活动，预防坠积性肺炎的发生。如果患者术前有吸烟史，术后为了预防肺不张，需要常规进行气管镜吸痰。另外，术后病人要积极进行呼吸康复锻炼，防止肺不张及呼吸系统感染。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">术后饮食有哪些注意事项？</span>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>跟消化道手术相比，肺癌病人手术后的饮食是比较好解决的。最好选用<span class="color-orange4 font-w800">牛奶、瘦肉、动物肝脏、豆制品、鸡蛋、新鲜的蔬菜水果等</span>，适当增加病人的进食量和进食次数。同时要注意<span class="color-orange4 font-w800">忌腥臊油腻食物，忌辛辣和烟、酒等刺激性</span>食物。
            </div>
            <div class="pt25 font-s16 color-red7 grid">
                <div class="col-0 bb-red">
                    <div>很多患者发现肺癌时心情非常低落，</div>
                    <div>这是否影响治疗效果？</div>
                </div>
                <div class="col-1"></div>
            </div>
            <div>
                <span class="font-w800">专家观点：</span><span class="color-orange4 font-w800">影响很大</span>。美国的统计数据发现，很多病人如果心情愉悦，其免疫功能相对会比较高；如果整天想着癌症，心情比较抑郁，其免疫功能就会比较差。而肺癌与人体免疫功能有关，因此，<span class="color-orange4 font-w800">心情愉悦</span>的肺癌患者<span class="color-orange4 font-w800">恢复相对较快</span>，整天闷闷不乐的患者恢复相对较差。
            </div>
            <div class="pt25 font-s16 color-red7">
                <div>为了追求更好的治疗效果，</div>
                <div>
                    <span class="bb-red">对肺癌患者有什么建议？</span>
                </div>
            </div>
            <div>
                <span class="font-w800">专家观点：</span>其实肺癌患者中<span class="color-orange4 font-w800">60%～70%</span>都是通过<span class="color-orange4 font-w800">体检</span>发现的，发现时是早期肺癌，其治疗效果也非常好；剩下<span class="color-orange4 font-w800">30%～40%</span>的患者中，一部分患者没有意识到体检，当出现一些症状，如<span class="color-orange4 font-w800">痰中带血或者痰多、咳嗽不止等</span>才到医院就诊，发现时基本都处于中晚期，治疗效果相对较差。当然，也有一部分患者体检发现肺癌时已经处于中期了，但早发现总是比晚发现要好。因此，建议<span class="color-orange4 font-w800">45岁以上、有吸烟史及肺癌家族史的人，每年</span>进行一次体检。
            </div>
            <div class="pt25 font-s16 color-red7">
                <span class="bb-red">全美第一癌症中心推荐</span>
            </div>
            <div class="color-orange4 font-w800">
                凯瑟琳癌症中心是世界上最大的、历史最悠久的私立癌症中心，也是全美第一的癌症中心。
            </div>
            <div>
                在诊疗和科研领域都拥有顶尖的专家和最专业的团队，其癌症五年生存率全球领先，远超平均预期值。同时，凯瑟琳癌症中心作为<span class="font-w800">名医主刀B轮1.5亿元融资的战略投资方之一</span>，在未来，将为名医主刀提供远程专家支持等医疗服务。
            </div>
            <div>
                <img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146347899337749" class="w100">
            </div>
            <div class="pt15 color-red7 font-w800 text-center font-s16 pb50">
                敬请期待！
            </div>
        </div>
    </div>
</article>