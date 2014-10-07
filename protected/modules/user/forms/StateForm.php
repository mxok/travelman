<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class StateForm extends CFormModel
{
	
    public $latitude;
    public $longitude;
    public $currentCity;
    public  $status;

	public function rules()
	{
		return array(
			array('latitude,longitude,currentCity', 'required','message'=>Yii::t('UserModule.user','{attribute} should  not be black')),
			array('status','safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'latitude'=>Yii::t('UserModule.user','latitude'),
			'longitude'=>Yii::t('UserModule.user','longitude'),
		    'currentCity'=>Yii::t('UserModule.user','currentCity'),

		);
	}














}
