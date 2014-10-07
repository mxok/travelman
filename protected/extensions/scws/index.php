<?php  

               require('scws.php');
                 $a=new SCWS();
                 $a->parse('南北的美女看过来');
                 echo  mb_detect_encoding('你好中国');
?>