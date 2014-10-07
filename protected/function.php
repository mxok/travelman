<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-4
 * Time: 上午10:30
 */
function p($var) {
    header("Content-type:text/html; charset=utf-8");
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die;
}
function getCurrentCity() {
    $ip = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json");
    $remoteInfo = json_decode($ip);
    return $remoteInfo ->city;
}

/**
 * 
 *
 * 
 * json   回调的是这个函数
 */
   function unescapedUnicode($match) {
        
        return mb_convert_encoding(pack('H*', $match[1]) , 'UTF-8', 'UCS-2BE');
    }