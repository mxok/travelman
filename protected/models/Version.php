<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-20
 * Time: 下午6:12
 */



class  Version extends CActiveRecord
{

    public static function  model($className = __CLASS__)
{
    return parent::model($className);
}






    public function  tableName()
{

    return '{{version}}';
}

   public   function   rules(){
   	
	
	return  array(
	array('versionCode','safe'),
	array('updateContent','safe'),
	
	
	
	

	);
   }






      public     function  attributeLabels(){
          return array(
              'versionCode'=>'输入客户端最新的版本号',
              'updateContent'=>'本次客户端更新的内容'

          );

      }
}