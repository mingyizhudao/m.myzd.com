<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '名医主刀',
    'defaultController' => 'mobile/home',
    // preloading 'log' component
    'preload' => array('log'),
    // application default language.
    'language' => 'zh_cn',
    //'language'=>'en_us',
    // config to be defined at runtime.
    'behaviors' => array('ApplicationConfigBehavior'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.models.sms.*',
        //   'application.imodels.*', //@DELETE
        'application.apiservices.*',
        'application.apiservices.v7.*',
        'application.models.base.*',
        'application.models.core.*',
        'application.models.region.*',
        'application.models.site.*',
        'application.models.user.*',
        'application.models.auth.*',
        'application.models.email.*',
        //    'application.models.faculty.*', //@DELETE
        'application.models.doctor.*',
        'application.models.expertteam.*',
        //    'application.models.medicalrecord.*', //@DELETE
        'application.models.hospital.*',
        'application.models.disease.*',
        'application.models.event.*',
        'application.models.booking.*',
        'application.models.payment.*',
        'application.models.app.*',
        'application.models.patient.*',
        'application.models.sales.*',
        'application.models.adminbooking.*',
        'application.models.comment.*',
        'application.models.messagequeue.*',
        'application.models.weixin.*',
        'application.models.app.*',
        'application.models.questionnaire.*',
        //    'application.sdk.alipaydirect.*',
        'ext.mail.YiiMailMessage',
        'application.extensions.EValidators.*',
        'application.extensions.YiiMongoDbSuite.*',
        'application.modules.translate.TranslateModule',
        'application.extensions.yiidebugtb.*',
    ),
    'modules' => array(
        'fileupload',
        //   'mobiledoctor',
        'mobile',
        'weixinpub',
        'translate', //manages translation message.
        'vendor',
        //   'admin', //admin module.
        /** user module * */
        /*   'user' => array(
          'tableUsers' => 'tbl_users',
          'tableProfiles' => 'tbl_profiles',
          'tableProfileFields' => 'tbl_profiles_fields',
          ),
         * 
         */
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
//            'servers' => array(
//                array(
//                    'host' => '120.26.107.48',
//                    'port' => 11211,
//                    'weight' => 60,
//                ),
//            ),
        ),
        //Translation messages stored in db table.
        /*
          'messages' => array(
          'class' => 'CDbMessageSource',
          'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
          'sourceMessageTable' => 'translate_source_message',
          'translatedMessageTable' => 'translate_message',
          'language' => 'zh_cn',
          ),
         */
        //Manages translation messages.
        /*
          'translate' => array(//if you name your component something else change TranslateModule
          'class' => 'translate.components.MPTranslate',
          //any avaliable options here
          'acceptedLanguages' => array(
          'zh_cn' => '中文',
          'en' => 'English',
          ),
          ),
         */
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
        ),
        'mail' => array(
            'class' => 'ext.mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.ym.163.com',
                'username' => 'noreply@mingyihz.com',
                'password' => '91466636',
                'port' => '994',
                'encryption' => 'ssl',
            // 'encryption' => 'tls',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'EWebUser',
            'loginUrl' => array('/user/login'),
        ),
        // User module
        /*
          'authManager' => array(
          'class' => 'CDbAuthManager',
          'connectionID' => 'db',
          'defaultRoles' => array('Authenticated', 'Guest'),
          ),
         * 
         */
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'caseSensitive' => false,
            'showScriptName' => false,
            'rules' => array(
                // api url.
                //array('api/payment', 'pattern'=>'api/<action:\w+>', 'verb'=>'POST'),
                //array('api/', 'pattern'=>'api/payment/doPay', 'verb'=>'POST'),
                // array('api/returnPay', 'pattern'=>'api/<type:\w+>', 'verb'=>'GET'),                
                array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                // mobiledoctor                
                //    array('apimd/list', 'pattern' => 'apimd/<model:\w+>', 'verb' => 'GET'),
                //    array('apimd/view', 'pattern' => 'apimd/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                //    array('apimd/update', 'pattern' => 'apimd/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                //    array('apimd/delete', 'pattern' => 'apimd/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                //    array('apimd/create', 'pattern' => 'apimd/<model:\w+>', 'verb' => 'POST'),
                //'http://api.mingyizhudao.com/<action:(contactus)>' => 'mobile/app/<action>',
                //    'http://api.mingyizhudao.com/<action:\w+>' => 'mobile/<action>',
                //    'http://api.mingyizhudao.com' => 'mobile',
                //'<action:(contactus)>' => 'site/<action>',
                // mobile module url rewrite.
                //    'http://m.mingyizhudao.com/<action:(contactus)>' => 'mobile/app/enquiry',
                //    'http://m.mingyizhudao.com/<controller:\w+>' => 'mobile/<controller>',
                //    'http://m.mingyizhudao.com' => 'mobile',
                //@TEMP url for doctor app. - 2015-09-27 - QP
                //    'http://mingyizhudao.com/mobiledoctor/home' => '/mobile/app/index',
                //    '<action:(contactus|enquiry)>' => 'site/<action>',
                //Temp, to be removed
                //   'overseas/elizabeth' => 'overseas/view',
                //   'hospital/tiantanpuhua' => 'hospital/view',
                //    'event/view/<page:\w+>' => 'event/view',
                //    '<view:(aboutus|faq|terms|media|rules|joinus|news|bigevents|zhitongche)>' => 'site/page',
                //    '<controller:(huizhen|marketing)>/<id:\w+>' => '<controller>/view',
                '<controller:\w+>/<action:index>' => '<controller>/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // myzd-test.        
//        'db' => array(
//            'connectionString' => 'mysql:host=qpmyzdstaging91466636.mysql.rds.aliyuncs.com;dbname=myzd-test',
//            'emulatePrepare' => true,
//            'username' => 'supertestuser',
//            'password' => 'Qp91466636',
//            'charset' => 'utf8',
//            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
//        ),
        // myzd-test.        
        'db' => array(
            'connectionString' => 'mysql:host=121.40.127.64;dbname=myzd-test',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'myzd_@!@#123456',
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        //本地数据库        
//        'db' => array(
//            'connectionString' => 'mysql:host=localhost;dbname=myzd',
//            'emulatePrepare' => true,
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
//        ),
        'db2' => array(
            'connectionString' => 'mysql:host=qpmyzdstaging91466636.mysql.rds.aliyuncs.com;dbname=myzd-test2',
            'class' => 'CDbConnection',
            'emulatePrepare' => true,
            'username' => 'myzdtest2user',
            'password' => 'myzdtest29146',
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600    // 开启表结构缓存（schema caching）提高性能
        ),
        'mongodb' => array(
            'class' => 'EMongoDB', //主文件
            'connectionString' => 'mongodb://120.26.107.48:27017', //服务器地址
            'dbName' => 'test', //数据库名称
            'fsyncFlag' => true, //mongodb的确保所有写入到数据库的安全存储到磁盘
            'safeFlag' => true, //mongodb的等待检索的所有写操作的状态，并检查
            'useCursor' => false, //设置为true，将启用游标
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'mobile/home/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'logTableName' => 'core_log',
                    'levels' => 'info,error'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'application.log',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'trace.log',
                    'levels' => 'trace',
                ),
                array(// configuration for the toolbar (yiidebugtb extension)
                    'class' => 'XWebDebugRouter',
                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
                    'levels' => 'error, warning, trace, profile, info',
                    'allowedIPs' => array('127.0.0.1', '::1', '192.168.1.54', '192\.168\.1[0-5]\.[0-9]{3}'),
                ),
            /*
              array(
              // log db command in firebug.
              'class' => 'CWebLogRoute',
              'categories' => 'system.db.CDbCommand',
              'showInFireBug' => true,
              'ignoreAjaxInFireBug' => false,
              ),
             * 
             */
            ),
        ),
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'core_session',
            'timeout' => 3600 * 24 * 30, // 30 days.
        ),
        'clientScript' => array(
            'class' => 'CClientScript',
            'coreScriptPosition' => CClientScript::POS_HEAD,
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'admin' => 'superbeta',
        'adminPassword' => '9be4e9c1e40a1952d3ad23cdb9343cedce6814d8e2b031d9d775ba58a02108b0',
        'adminEmail' => 'fainqin@foxmail.com',
        //'contactEmail' => 'contactus@mingyihz.com',
        'contactEmail' => 'fainqin@foxmail.com',
        'csadminEmail' => 'csadmin@mingyizhudao.com',
        // 'registerBaiduScript' => true,
        'medicalRecordFilePath' => 'upload/mr',
        'bookingFilePath' => 'upload/booking',
        "doctorFilePath" => "upload/doctor/cert",
        "patientMRFilePath" => "upload/patient/mr",
    // 'doctorAvatar' => 'upload/doctor/avatar',
    //    'baseUrl' => 'http://mingyizhudao.com',
    //    'baseUrlMobile' => 'http://m.mingyizhudao.com',
    //    'baseUrlApi' => 'http://api.mingyizhudao.com',
    ),
    'theme' => 'm4',
);
