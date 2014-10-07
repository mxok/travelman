<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-10
 * Time: 下午2:05
 */

class   Photo extends CActiveRecord{



    public static  function  model($className=__CLASS__){



        return parent::model($className);
    }



    public  function  tableName(){

        return '{{photo_like}}';
    }
 public   function behaviors(){


              return array(
            'CTimestampBehavior' => array(
            'class' => 'zii.behaviors.CTimestampBehavior',
            'createAttribute' => 'createTime'
            
        )
    );

public function  attributeLabels(){

    return array(
        'location'=>'拍照时候的位置',
        'content'=>'想要说的话',
        'score'=>'评分',
        'guideId'=>'攻略的ID号');

}
//如果是多重文件上传，如何验证文件不能为空呢？
public  function   rules(){
    return  array(
       array('photoId,userId','required','message'=>'带*的必填'),

        );
}



  //有relation
    public  function  relations(){
        return array(
            'user'=>array(self::BELONGS_TO,'User','userId'),
            'commentNum' => array(self::STAT, 'Comment', 'photoId'),
            'likeNum'=>array(self::STAT, 'Like', 'photoId'),
        );
    }

   
    }

   //如何高效实现点赞？



}