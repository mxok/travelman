<?php

class   SCWS  {

    public  $dict = 'C:\xampp\htdocs\ManYouRen\2\protected\vendors\scws\dict.xdb';	// Ĭ�ϲ��� xdb (���������κ�����)
    public  $mydata  = NULL;	// ��������
    public  $version = 2;		// ���ð汾
    public  $autodis = false;	// �Ƿ�ʶ������
    public  $ignore  = false;	// �Ƿ���Ա��
    public  $debug   = false;	// �Ƿ�Ϊ����ģʽ
    public   $stats     = false;	// �Ƿ�鿴ͳ�ƽ��
    public   $result=array();

        public  function  parse($mydata){
$this->dict=Yii::getPathOfAlias('application.vendors.scws').DIRECTORY_SEPARATOR.'dict.xdb';

$a=mb_convert_encoding($mydata, 'GBK','UTF-8');
$object = 'PSCWS' . $this->version;
require (strtolower($object) . '.class.php');
$cws = new $object($this->dict);
$cws->set_ignore_mark($this->ignore);
$cws->set_autodis($this->autodis);
$cws->set_debug($this->debug);

$cws->set_statistics($this->stats);
$ar=$cws->segment($a);
 foreach ($ar as $tmp)
    {
        if ($tmp == "\n")
        {
                                                  
            continue;
        }
                                               
          array_push($this->result,mb_convert_encoding($tmp, 'UTF-8','GBK')) ;
        
    }
   // flush();
        }
       
}

              

?>
