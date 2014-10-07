<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-10
 * Time: 下午2:05
 */

class Photo extends CActiveRecord {
    public $scenicId;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{photo}}';
    }
    public function behaviors() {
        
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime'
            )
        );
    }
    public function attributeLabels() {
        
        return array(
            'location' => '拍照时候的位置',
            'content' => '想要说的话',
            'score' => '评分',
            'city' => '拍照时候的城市',
        );
    }
    //如果是多重文件上传，如何验证文件不能为空呢？
    public function rules() {
        
        return array(
            array(
                'location,content,score,city',
                'required','on'=>'publish','message' => '{attribute}必填'
            ),
            array('photoId','required','on'=>'detail','message'=>'{attribute}必填'),
            array('userId','required','on'=>'list','message'=>'{attribute}必填'),
        ) ;
    }
    public function relations() {
        
        return array(
            'user' => array(
                self::BELONGS_TO,
                'User',
                'userId'
            ) ,
            'commentNum' => array(
                self::STAT,
                'Comment',
                'photoId'
            ) ,
            'likeNum' => array(
                self::STAT,
                'Like',
                'photoId'
            ) ,
        );
    }
    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->userId = Yii::app()->user->userId;
        }
        
        return true;
    }
    protected function afterDelete() {
    }
}
