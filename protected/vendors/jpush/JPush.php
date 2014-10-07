<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-16
 * Time: 下午10:24
 */
Yii::import('application.vendors.*');
require_once('jpush/JPushClient.php');
define ("PUSH_SINGLE", 3);
define ("PUSH_ALL", 4);

class JPush
{
    private $client;
    private $masterSecret = 'fddc18e5d07ff0ff6452a07f';
    private $appKey = '930fc19c27de0dac8a1a331e';
  






    public   function  __construct($platform){
        $this->client = new JPushClient($this->appKey, $this->masterSecret,0,$platform);



    }
    public function  sendAll($title, $content, $extras)
    {
        $sendno = time();
        $params = array(
            "receiver_type" => PUSH_ALL,
            "sendno" => $sendno,
            "send_description" => "",
            "override_msg_id" => ""
        );
        $messageResult = $this->client->sendCustomMessage($title, $content, $params, $extras);
        if ($messageResult->getCode() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $extras
     * @return bool
     */
    public function sendSingle($extras)
    {
    	
        $sendno = time();
        $params = array(
            "receiver_type" => PUSH_SINGLE,
            "receiver_value" => $extras['receiver'],
            "sendno" => $sendno,
            "send_description" => "",
            "override_msg_id" => ""
        );
		
		
	
        $msgResult = $this->client->sendCustomMessage('xx', 'xx', $params, $extras);
        if (!$msgResult->getCode()) {

            return true;
        } else {

            p($msgResult->getMessage());
            return false;
        }
    }



}


