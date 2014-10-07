<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-16
 * Time: 下午4:57
 */
class PhotoComment extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {

        return parent::model($className);
    }

    public function tableName()
    {

        return '{{photo_comment}}';
    }

    public function rules()
    {

        return array(
            array('photoId,content', 'required', 'message' => '{attribute}不能为空'),
            array('replyId', 'safe')
        );
    }

    public function attributeLabels()
    {

        return array();
    }

    public function relations()
    {

        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId')
        );
    }

    public function behaviors()
    {

        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
            )
        );
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->userId = Yii::app()->user->userId;
        }
        return true;
    }

}
