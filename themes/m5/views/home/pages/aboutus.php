<?php
//$this->setPageID('pAboutus');
$this->setPageTitle('关于我们');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green" >
    <nav class="left">
        <a href="#" data-icon="previous" data-target="back"></a>
    </nav>
    <h1 class="title"><?php echo $this->pageTitle; ?></h1>
</header>

<article id="aboutus_article" class="active"  data-scroll="true">
    <div id="aboutus" class="pad1">
        名医主刀为国内最大的移动医疗手术平台，旨在为有手术需求的患者提供专业、高效、安全的手术医疗服务。平台汇聚了国内外顶级名医资源和床位资源，并利用互联网技术实现医患精准匹配，医疗资源优化配置，帮助患者解决尽快入院手术，“好看病，看好病”的切实需求。
    </div>
</article>