<!DOCTYPE html> 
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no" />
        <meta charset="utf-8" />
        <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons/favicon.ico?v=2" />
        <?php
        //Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/css/bootstrap.min.css');
        //    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/font-awesome.min.css");
        Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.custom.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/mobile.css" . "?v=" . time());
        //    Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCoreScript('jquery.min.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jQuery-Mobile-Subpage-Widget-master/jquery.mobile.subpage.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js', CClientScript::POS_HEAD);
        //   Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/jquery.bxslider/jquery.bxslider.css");
        //     Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.bxslider/jquery.bxslider.min.js', CClientScript::POS_HEAD);
        //    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/dist/jquery.validate.js', CClientScript::POS_END);
        //    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/webuploader/js/jquery.form.js', CClientScript::POS_END);
        //    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/validator.js', CClientScript::POS_HEAD);
        ?>
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

    </body>
</html>