<?php

// change the following paths if necessary
 date_default_timezone_set('Asia/shanghai'); 
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
defined('YII_DEBUG') or define('YII_DEBUG',true);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
define('YII_ENABLE_EXCEPTION_HANDLER',false);
define('YII_ENABLE_ERROR_HANDLER',false);
require_once($yii);
require('./protected/config/const.php');
require('./protected/function.php');
Yii::createWebApplication($config)->run();



