<!DOCTYPE html> 
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <title><?php echo $this->pageTitle; ?></title>
        <!--        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no" />-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="format-detection" content="telephone=no"/>
        <?php
        Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/vendor/base.min.1.0.css');
        Yii::app()->clientScript->registerCssFile('http://static.mingyizhudao.com/vendor/custom.min.1.2.css');
        Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/zepto.min.1.0.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/base.min.js?ts=' . time(), CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/main.min.1.0.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/baiduStatistics.min.1.0.js', CClientScript::POS_END);
        ?>
    </head>
    <body>
        <div id="section_container">
            <section class="active" data-init="true">
                <?php
                if ($this->showHeader()) {

                    $this->renderPartial('//layouts/header');
                }
                ?>
                <!-- /header -->
                <?php
                if ($this->showFooter()) {
                    //$this->renderPartial('//layouts/footer');
                }
                ?>
                <!-- /footer -->
                <?php
                echo $content;
                ?>  
                <!-- /content -->

            </section>
        </div>
        <!-- /footer -->
        <script type="text/javascript" src="http://dl.ntalker.com/js/xn6/ntkfstat.js?siteid=kf_9138"></script>
    </body>
</html>