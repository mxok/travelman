<?php

class   SCWS  {

    public  $dict = 'dict/dict.xdb';	// Ĭ�ϲ��� xdb (���������κ�����)
    public  $mydata  = NULL;	// ��������
    public  $version = 2;		// ���ð汾
    public  $autodis = false;	// �Ƿ�ʶ������
    public  $ignore  = false;	// �Ƿ���Ա��
    public  $debug   = false;	// �Ƿ�Ϊ����ģʽ
    public   $stats     = false;	// �Ƿ�鿴ͳ�ƽ��


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

              
// �ִʽ��֮�ص����� (param: �ֺõĴ���ɵ�����)
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
