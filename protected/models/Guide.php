<?php
/**
 * Created by jianxing.xu@manyouren.com
 * User: Administrator
 * Date: 14-6-10
 * Time: 下午2:05
 */

class Guide extends CActiveRecord {
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{guide}}';
    }
    public function behaviors() {
        
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
                'updateAttribute' => null
            )
        );
    }
    protected function beforeSave() {
        if(parent::beforeSave()){
          $this->spotNum++;
        }
        return  true;
    }
    /**
     *新的的话就要新建一个guide，旧的的话就是要将photo直接保存即可
     */
    public function savePhoto(Photo & $photo) {
        if ($this->isNewRecord) {
            $this->title = Scenic::model()->findByPk($photo->scenicId);
            $this->userId = Yii::app()->user->userId;
            $this->save();
            $photo->guideId = $this->guideId;
            $photo->save();
        } else {
            if ($photo->save()) {
          
                $this->save();
            };
        }
    }


    
}
