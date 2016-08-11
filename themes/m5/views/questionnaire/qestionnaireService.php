<?php
$this->setPageTitle('服务条款');
$source = Yii::app()->request->getQuery('app', 0);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>

<?php
if ($source == 0) {
    ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <h1 class="title">服务条款</h1>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574" class="w24p">
            </a>
        </nav>
    </header>
    <?php
}
?>
<article class="active" data-scroll="true">
    <div class="pl15 pr15 text-justify">
        <div class="pt10 color-black6">
            欢迎您申请“0元面诊”服务，请在申请前仔细阅读本条款，如果您对本条款有任何异议，您可以选择不使用名医主刀，您使用名医主刀，则意味着您将自愿遵守以下原则，并接受名医主刀的统一服务与管理。
        </div>
        <div class="pt10 color-black6">
            一、名医主刀网站“0元面诊”服务是专家在正常门诊挂号之外，延长门诊时间或利用个人休息时间，给予患者的额外面对面术前咨询，是医生的个人行为，与医院无关。
        </div>
        <div class="pt10 color-black6">
            二、“0元面诊”服务仅针对非首诊患者。首诊患者请您先前往附近有资质医院进行初诊，有诊断结果后首诊医生建议手术者方可免费申请“0元面诊”。
        </div>
        <div class="pt10 color-black6">
            三、申请“0元面诊”的患者，有义务按照要求填写预约申请单（包括患者的基本资料、疾病资料等信息），所有信息必须真实、准确、有效、完整，名医主刀将对您的各项信息承担最严格的保密义务。名医主刀的管理员有权利根据患者的具体情况决定是否给予预约。预约专家的姓名可由患者指定，预约成功后，该指定不可撤销；如果患者不能指定专家姓名，患者授权名医主刀代为推荐，预约成功后，该推荐亦不可撤销。
        </div>
        <div class="pt10 color-black6">
            四、预约成功以名医主刀网站的客服电话通知为准，同时会发送预约成功短信。因短信通道故障导致的发送不成功和延迟发送，名医主刀网站不负责任。
        </div>
        <div class="pt10 color-black6">
            五、为杜绝号贩子，就诊时务必带上“0元面诊”申请成功的提示短信（转发无效）、患者本人的身份证，否则由于患者真实性问题导致的术前面诊不成功，后果由患者自负。
        </div>
        <div class="pt10 color-black6">
            六、鉴于临床工作的特殊性，医生遇到抢救、急诊等特殊事件时，可能无法在原定预约日面诊患者。名医主刀网站将在获悉后第一时间通知您，就诊时间以名医主刀重新通知的时间为准，由此产生的以下问题名医主刀、医生、医院不予负责： 
        </div>
        <div class="color-black6 text-indent-2">
            交通、餐饮、住宿等费用
        </div>
        <div class="color-black6 text-indent-2">
            患者延误术前咨询导致的病情延误
        </div>
        <div class="color-black6 text-indent-2">
            以及其他由于术前咨询延误导致的问题
        </div>
        <div class="pt10 color-black6">
            在前述情况下，您如果要求更换专家，名医主刀可以不另行收取预约金为您重新预约别的专家，但以一次为限。
        </div>
        <div class="pt10 color-black6">
            七、申请“0元面诊”的患者，应当先予支付50元的预约保证金。预约会诊完成后，名医主刀会如数退还50元保证金。但如果患者爽约，平台将直接扣除您的预约保证金50元，并将可能影响您以后使用本平台的其他服务。
        </div>
        <div class="pt10 color-black6">
            八、名医主刀提供的“0元面诊”是免费服务。免费服务不包括医院的挂号费、检查费、治疗费以及您咨询相关服务的通话费等费用。
        </div>
        <div class="pt25 font-s16">
            服务须知
        </div>
        <div class="pt10 color-black6">
            1、“0元面诊”是医生利用自己的额外时间为患者做面对面咨询，就诊患者有可能是排在正常门诊之后就诊，如无法接受，请勿使用“0元面诊”服务。
        </div>
        <div class="pt10 color-black6 pb50">
            2、专家均有停诊风险，我们保证在接到停诊通知后及时与您联系取消该预约。但是在专家没有通知停诊时间的情况下，您仍然存在术前咨询无法按约就诊的风险，此类风险发生概率不高，但仍然存在，请您知悉。若不能接受此风险，请勿申请！
        </div>
    </div>
</article>