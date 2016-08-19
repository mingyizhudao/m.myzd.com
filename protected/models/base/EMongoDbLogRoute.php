<?php
/**
 * Auther aoyagikouhei
 *
 * 2011/08/01 ver 1.2
 * Add fsync, safe, timeout options
 *
 * 2011/07/09 ver 1.1
 * Add capped collection : Thank you joblo
 *
 * 2011/06/23 ver 1.0
 * First release
 *
 * Install
 * Extract the release file under protected/extensions
 * 
 * In config/main.php:
  'log'=>array(
      'class'=>'CLogRouter',
      'routes'=>array(
        array(
          'class'=>'ext.EMongoDbLogRoute',
          'levels'=>'trace, info, error, warning',
        ),
      ),
    ),
 *
 * Options
 * connectionString        : host:port                      : defalut localhost:27017
 * dbName                  : database name                  : default test
 * collectionName          : collaction name                : default yiilog
 * message                 : message column name            : default message
 * level                   : level column name              : default level
 * category                : category column name           : default category
 * timestamp               : timestamp column name          : default timestamp
 * timestampType           : float or date                  : default float
 * collectionSize          : capped collection size         : default 10000
 * collectionMax           : capped collection max          : default 100
 * installCappedCollection : capped collection install flag : default false
 * fsync                   : fsync flag                     : defalut false
 * safe                    : safe flag                      : defalut false
 * timeout                 : timeout miliseconds            : defalut null i.e. MongoCursor::$timeout
 *
 *
 *
 * Capped colection
 * 1. set installCappedCollection true in main.php.
 * 2. run application and loged
 * 3. remove installCappedCollection in main.php.
 */
class EMongoDbLogRoute extends CLogRoute
{

  public function init()
  {
    parent::init();
   
  }

  /**
   * Saves log messages into mongodb.
   * @param array list of log messages
   */
  protected function processLogs($logs)
  {
    foreach($logs as $log) {
        $coreAccess = new CoreLogMongo();
        $coreAccess->storesave($log[0],$log[1],$log[2]);
      
    }
  }

}
