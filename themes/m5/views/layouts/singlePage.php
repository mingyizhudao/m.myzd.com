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
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/Jingle.min.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/app.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/mobile.css?ts=' . time());
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/mymain.css?ts=' . time());
        ?>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/main.js"></script>
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
                    $this->renderPartial('//layouts/footer');
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
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/iscroll.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/template.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/Jingle.custom.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/zepto.touch2mouse.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/app.js"></script>
    </body>
</html>