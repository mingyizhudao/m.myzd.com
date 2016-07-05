<?php
$this->setPageTitle('名医义诊');
$urlHomeMyyzDoctor = $this->createUrl('home/page', array('view' => 'myyzDoctor'));
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$this->show_footer = false;
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title">疾病信息</h1>
    <nav class="right" style="top:2px!important;">
        <div class="font-s16">
            跳过
        </div>
    </nav>
</header>
<article id="questionnaireone_article" class="active" data-scroll="true">
    <div class="pad20">
        <div class="w100 color-green text18">
            为了更好地给您提供诊疗意见，我们需要了解一下信息：
        </div>
        <div class="w100 mt30 font-s16">
            <div>5/6：请您上传患者的相关病例资料</div>
            <div class="mt5"><span class="color-red">图片清晰可见</span><span>（最多9张）</span><span class="border-grayD learn-example">查看示例</span></div>
            <div class="mt20">
                
            </div>
        </div>
        <div>
            <button id="" class="btn btn-abs font-s16 bg-green mt40">
                下一步
            </button>
        </div>
        <div class="text-center mt90"><img src="http://7xsq2z.com2.z0.glb.qiniucdn.com/146761944631242" class="w50" /></div>
    </div>
</article>