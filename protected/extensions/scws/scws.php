<?php

class   SCWS  {

    public  $dict = 'dict/dict.xdb';	// 默认采用 xdb (不需其它任何依赖)
    public  $mydata  = NULL;	// 待切数据
    public  $version = 2;		// 采用版本
    public  $autodis = false;	// 是否识别名字
    public  $ignore  = false;	// 是否忽略标点
    public  $debug   = false;	// 是否为除错模式
    public   $stats     = false;	// 是否查看统计结果


        public  function  parse($mydata){

$object = 'PSCWS' . $this->version;
require (strtolower($object) . '.class.php');
$cws = new $object($this->dict);
$cws->set_ignore_mark($this->ignore);
$cws->set_autodis($this->autodis);
$cws->set_debug($this->debug);

$cws->set_statistics($this->stats);
$cws->segment($mydata, 'words_cb');

        }
}

              
// 分词结果之回调函数 (param: 分好的词组成的数组)
    function words_cb($ar)
{
	foreach ($ar as $tmp)
	{
		if ($tmp == "\n")
		{
                                                        echo  ' xx ';
			continue;
		}
                                                     
                                                         echo  mb_convert_encoding($tmp, 'UTF-8','GBK').'    ';
		//echo $tmp . ' ';
	}
	flush();
}
?>
