<?php
$pageUrl = Yii::app()->request->getQuery('pageUrl', '');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
?>
<header class="bg-green">
    <nav class="left">
        <a href="" data-target="back">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
    </nav>
    <h1 class="title"></h1>
    <nav class="right">
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png"  class="w24p">
        </a>
    </nav>
</header>
<article class="active" data-scroll="true">
    <div>
        <iframe src="<?php echo $pageUrl; ?>" class="w100"></iframe>
    </div>
</article>
<script>
    $(document).ready(function () {
        var height = $('article').height();
        $('iframe').attr('height', height);
    });
</script>