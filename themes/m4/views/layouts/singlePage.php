<!DOCTYPE html> 
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <title><?php echo $this->pageTitle;?></title>
        <!--        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no" />-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="format-detection" content="telephone=no"/>
        <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons/favicon.ico" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/Jingle.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mymain.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mobile.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/zepto.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/main.js"></script>
    </head>
    <body>
        <?php
        if ($this->showHeader()) {

            $this->renderPartial('//layouts/header');
        }
        ?>
        <!-- /header -->

        <?php
        echo $content;
        ?>  
        <!-- /content -->
        <?php
        if ($this->showFooter()) {
            $this->renderPartial('//layouts/footer');
        }
        ?>
        <!-- /footer -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/iscroll.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/template.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/Jingle.custom.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/zepto.touch2mouse.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/lib/app.js"></script>
    </body>
</html>