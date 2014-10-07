<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $identity;
    public $type;
    public $latitude;
    public $longitude;
    public $currentCity;

	public function rules()
	{
		return array(
			array('username,password,type','required','message'=>Yii::t('UserModule.user','{attribute} should  not be black')),
			array('latitude,longitude,currentCity','safe'),
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>Yii::t('UserModule.user', 'username'),
			'password'=>Yii::t('UserModule.user', 'password'),
			'latitude'=>Yii::t('UserModule.user', 'latitude'),
			'longitude'=>Yii::t('UserModule.user','longitude'),
			'type'=>Yii::t('UserModule.user', 'type'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->identity=new UserIdentity($this->username,$this->password);
			if(!$this->identity->authenticate())
				$this->addError('password',Yii::t('UserModule.user', 'username or  password  incorrect'));
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->identity===null)
		{
			$this->identity=new UserIdentity($this->username,$this->password);
			$this->identity->authenticate();
		}
		if($this->identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=0;
			Yii::app()->user->login($this->identity,$duration);
			return true;
		}
		else
			return false;
	}



}
