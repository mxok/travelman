<?php
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '漫游人',
    'theme'=>'basic',
    'defaultController' => 'index',
    'timeZone' => 'PRC',
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => realpath(dirname(__FILE__) . '/../extensions/bootstrap'), // change this if necessary
    ),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendors.*',
        'bootstrap.helpers.*',
        'bootstrap.behaviors.*',
    ),
       'modules' => array(
       'user',
       'plan',
       'manyouquan',
       'backend',
       'guide',
       'temp',
       'push',
       'jianren',
        'gii'=>array(
        'class'=>'system.gii.GiiModule',
        'password'=>'147852963',
        'ipFilters'=>array('127.0.0.1','::1'),
        'generatorPaths' => array('bootstrap.gii'),
        ),
        
    ) ,
    'components' => array(    
	   'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',   
        ),
	
        'geohash' => array(
            'class' => 'MGeohash'
        ) ,
        'session' => array(
            'timeout' => 3600*24*30,
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
        ) ,
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl'=>array('/user/default/login'),
        ) ,
        'temp'=>array(
           'class'=>'CWebUser'
            ),
        'thumb' => array(
            'class' => 'ext.CThumb.CThumb',
        ) ,
         'relation' => array(
            'class' => 'RelationComponent',
        ) ,
         'userManager'=>array(
            'class'=>'application.modules.user.components.UserManager'),
         'authenticationManager'=>array(
            'class'=>'application.modules.user.components.AuthenticationManager'),
         'json'=>array(

            'class'=>'application.components.CJsonHelper',

            ),

        //隐藏index.php需要rewrite。
        'urlManager'=>array(
        'urlFormat'=>'path',
        'rules'=>array(
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        ),
        ),
        
        // 'db' => array(
        //     'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        // ) ,
        // uncomment the following to use a MySQL database
        'db' =>require(dirname(__FILE__).DIRECTORY_SEPARATOR.'database.php'),
       
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ) ,
        'log'=>array(
        	'class'=>'CLogRouter',
        	'routes'=>array(
        		array(
        			'class'=>'CFileLogRoute',
        			'levels'=>'error, warning',
        		),
        		// uncomment the following to show log messages on web pages
        		 array(
        			'class'=>'CWebLogRoute',
                       'levels'=>'trace',
                           //级别为trace
                        'categories'=>'system.db.*'
        		),
        	),
        ),
        
      ) ,
    'params'=>require(dirname(__FILE__).DIRECTORY_SEPARATOR.'param.php'),
);
