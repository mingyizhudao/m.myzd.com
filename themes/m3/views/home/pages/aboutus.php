<?php
$this->setPageID('pAboutus');
$this->setPageTitle('关于我们');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$showExpTeamBtn = Yii::app()->request->getQuery("showBtn", 1);

?>
<div id="<?php echo $this->getPageID(); ?>" class="home-page" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-nav-rel="#f-nav-home">    
    <div data-role="content" id="aboutus">
        <div>
            名医主刀为国内最大的移动医疗手术平台，旨在为有手术需求的患者提供专业、高效、安全的手术医疗服务。平台汇聚了国内外顶级名医资源和床位资源，并利用互联网技术实现医患精准匹配，医疗资源优化配置，帮助患者解决尽快入院手术，“好看病，看好病”的切实需求。
        </div>
    </div>
</div>
