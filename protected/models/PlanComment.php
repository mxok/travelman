<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-16
 * Time: 下午4:57
 */

class PlanComment    extends  CActiveRecord {

    public static  function  model($className=__CLASS__){



        return parent::model($className);
    }



    public  function  tableName(){

        return '{{plan_comment}}';
    }
    
    public  function  rules(){

        return array(
            array('planId,content','required','message'=>'{attribute}不能为空'),
            array('replyId','safe')
        );
    }
    public   function   attributeLabels(){



        return array(
              'content'=>'要评论的内容',
              'planId'=>'计划的ID号',
              'replyId'=>'回复的评论的ID号，如果不是回复别人的评论,则留空(不提交这个字段)'




            );
    }
     public  function  relations(){
        return array(
            'user'=>array(self::BELONGS_TO,'User','userId')
        );
        
    }
   public function behaviors(){
        return  array(
                'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
                'timestampExpression'=>'time()'
            ));
        
    }


    protected function  beforeSave(){
           if(parent::beforeSave()){
        $this->userId=Yii::app()->user->userId;

           }

   return  true;

    }
} 