<?php
$this->setPageID('pMobile');
$this->setPageTitle('关于预约');
$showHeader = Yii::app()->request->getQuery('header', 1);
// $urlUserIndex = $this->createUrl('user/index', array('pages' => ''));
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
        <h1 class="title">关于预约</h1>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
            </a>
        </nav>
    </header>
<?php }
?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 text-justify">
        <div class="pt25 font-s16">
            1.我为家人预约，预约时填写我本人的姓名和手机号还是家人的？
        </div>
        <div class="pt10 color-black6">
            本人或家人都可以，名医助手联系后需提供患者本人基本疾病信息。
        </div>
        <div class="pt25 font-s16">
            2.预约时需要提供的资料有哪些？
        </div>
        <div class="pt10 color-black6">
            （1）基础资料：姓名、性别、年龄、疾病诊断、就诊医院、治疗状况等
        </div>
        <div class="pt10 color-black6">
            （2）相关检查资料：核磁（MRI）、CT、病理、B超及相关诊断检验报告等；
        </div>
        <div class="pt25 font-s16">
            3.名医主刀能根据我的疾病推荐权威专家吗？
        </div>
        <div class="pt10 color-black6">
            权威医院每个科室细分领域比较多，需要了解患者的具体病情、提供详细的疾病资料名医助手才能帮您匹配最合适的专家，可以点击网站右上角快速预约进行申请。
        </div>
        <div class="pt25 font-s16">
            4.没有做过检查没有确诊的情况下怎样预约手术呢？
        </div>
        <div class="pt10 color-black6">
            名医主刀是国内最大的移动医疗手术平台，针对有手术需求，或希望尽快确诊是否需要手术的患者。未就诊的患者建议先去正规医院做疾病诊断，明确病情后，若需要手术可通过网站预约手术。
        </div>
        <div class="pt25 font-s16">
            5.交付平台预约金后，如果没有在48小时内收到平台回复怎么办？
        </div>
        <div class="pt10 color-black6">
            名医助手收到预约单后，会在第一时间联系患者，确认就诊意向和提交的疾病诊断资料，确定病历无误后开始联系专家，将会在48小时内给予医生的初步反馈。如果未能在48小时内给予回复，您可以申请退款。
        </div>
        <div class="pt25 font-s16">
            6.手术可以指定主刀医生吗？
        </div>
        <div class="pt10 color-black6">
            名医助手会为每一个患者安排最合适的医生，患者无需指定手术医生。如果有指定需求，可以在预约单里填写或者助手电话回访时提出。
        </div>
        <div class="pt25 font-s16">
            7.是否一定可以预约到指定主刀医生？
        </div>
        <div class="pt10 color-black6">
            名医助手会优先满足患者的指定需求，但因为医生时间安排等特殊性，不保证一定可以预约成功。在这种情况下，名医主刀会根据患者疾病情况匹配三甲医院副主任级别以上的名医主刀手术。
        </div>
        <div class="pt25 font-s16">
            8.手术保证治疗效果吗？
        </div>
        <div class="pt10 color-black6">
            因医疗行为的特殊性，患者病情差异巨大，任何人（包括医生、名医主刀）都不能绝对性地对治疗方案、疗效、医疗意外、住院天数做出承诺。
        </div>
        <div class="pt25 font-s16">
            9.患者通过名医主刀是否能比别人更快入院？
        </div>
        <div class="pt10 color-black6">
            三甲医院的床位由医院统一管理，名医主刀无法干涉医院秩序；名医主刀可以为患者安排合作医院的空闲床位，比如一些二甲医院，他们的手术设备和医疗环境与三甲医院相当；我们会找到有空病床的医院，再预约专家有空的时间前去手术。
        </div>
        <div class="pt25 font-s16">
            10.付费后多长时间可以确定门诊时间?
        </div>
        <div class="pt10 color-black6">
            一般付费后18小时内给予患者初次反馈；医生时间相对不固定，如遇特殊情况如出差等情况，可能会有延时的问题。
        </div>
        <div class="pt25 font-s16">
            11.一定能帮我们找到权威专家吗？
        </div>
        <div class="pt10 color-black6">
            名医主刀是国内最大的移动医疗手术平台，针对有手术需求的患者。为了保证权威性，平台只收录副主任以上级别的专家，帮患者匹配的肯定是最适合患者病情的权威专家。专家的信息您都可以上网搜索查询。
        </div>
        <div class="pt25 font-s16">
            12.名医主刀的主要为患者提供的服务有哪些？
        </div>
        <div class="pt10 color-black6 pb30">
            名医主刀是国内最大的移动医疗手术平台，针对有手术需求，或希望尽快确诊是否需要手术的患者。主要是将一些二甲医院的空闲床位整合，邀请医生利用休息时间去为患者做手术，实现资源、效率最大化。
        </div>
    </div>
</article>