<?php

class RegistrationForm extends CFormModel{
    public $username;
    public $password;
    public $email;
    public $birthday;
    public $residence;
    public $gender;
    public $avatar0;
    /**
     * @var $type      客户端字段类型,0表示android,1表示ios
     *
     */
    public $type;
    public function rules() {
        return array(
            array('username,email,password,gender,birthday,type,residence','required','message' =>Yii::t('UserModule.user', '{attribute} should  not  be black')) ,
            array('email','email','message' =>Yii::t('UserModule.user', 'email invaild')) ,
            array('email','authenticate'),
            array('gender','in', 'range' => array(0,1)) ,
        );
    }
    public function attributeLabels() {        
        return array(
            'username' =>Yii::t('UserModule.user','username'),
            'email' =>Yii::t('UserModule.user','email'),
            'password' =>Yii::t('UserModule.user', 'password'),
            'gender' =>Yii::t('UserModule.user', 'gender'),
            'residence' =>Yii::t('UserModule.user', 'residence'),
            'birthday' =>Yii::t('UserModule.user', 'birthday'),
            'avatar' => Yii::t('UserModule.user', 'avatar'),
        );
    }
    public function authenticate($attribute, $params) {
        $model= User::model()->find('email=:email', array(':email' => $this->email));
        if ($model) {
            $this->addError('email',Yii::t('UserModule.user', 'email already has  been  registered'));
             Yii::app()->getController()->send(ERROR_EMAIL_HAS,Yii::t('UserModule.user', 'email already has  been  registered'));           
        }
    }
   
}
