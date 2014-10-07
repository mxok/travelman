<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-17
 * Time: 上午11:33
 */
Yii::import('application.vendors.jpush.*');
require_once ('jpush.php');
class Message extends CFormModel {
    public $sender;
    public $username;
    public $avatar;
    public $receiver;
    public $text;
    public $file;
    public $plan;
    public $length;//语音时长
    public function attributeLabels() {
        return array(
            'sender' =>Yii::t('PushModule.message','sender'),
            'receiver' => Yii::t('PushModule.message','receiver'),
            'text' => Yii::t('PushModule.message','text'),
            'file' => Yii::t('PushModule.message','file'),
            'plan' => Yii::t('PushModule.message','plan'),
            'length'=>Yii::t('PushModule.message','length')
        );
    }
    public function rules() {
        
        return array(
            array(
                'receiver',
                'required',
                'message' =>Yii::t('UserModule.user','{attribute} should  not be black')
            ) ,
            array(
                'text,plan,file,length','safe'
            )
        );
    }
    public function chat($platform) {
        $this->username=Yii::app()->user->username;
        $this->avatar=Yii::app()->user->avatar0;
        $this->sender = Yii::app()->user->userId;
        $jPush = new JPush($platform);
        if ($jPush->sendSingle($this->attributes)) {
            $this->send(0, Yii::t('UserModule.user','success'));
        } else {
            $this->send(1, Yii::t('UserModule.user','fail'));
        }
    }
}
