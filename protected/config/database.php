<?php

return
    array(
        'connectionString' => 'mysql:host=211.154.6.229;port=3307;dbname=travelman',
        'emulatePrepare' => true,
        'username' => 'travelman',
        'password' => 'travelman',
        'charset' => 'utf8',
        'tablePrefix' => 'travel_',
        'nullConversion'=>PDO::NULL_TO_STRING
    ) ;
// array(
//    'connectionString' => 'mysql:host=localhost;port=3306;dbname=manyouren',
//    'emulatePrepare' => true,
//    'username' => 'root',
//    'password' => '',
//    'charset' => 'utf8',
//    'tablePrefix' => 'travel_',
//    'nullConversion'=>PDO::NULL_TO_STRING
// );




//  array(
//              'connectionString' => 'mysql:host=manyouren.mysql.rds.aliyuncs.com;port=3306;dbname=masterdb',
//              'emulatePrepare' => true,
//              'username' => 'manyouren',
//              'password' => 'manyouren',
//              'charset' => 'utf8',
//              'tablePrefix' => 'travel_',
//              'nullConversion'=>PDO::NULL_TO_STRING
//          ) ;
?>