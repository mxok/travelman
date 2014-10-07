<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-14
 * Time: 下午3:46
 * 值得改进的地方，使用魔术方法
 */
class UserState extends CActiveRecord {

    public static function model($className = __CLASS__) {

        return parent::model($className);
    }

    public function tableName() {
        return '{{user_state}}';
    }

    public function attributeLabels() {
        return array(
            'latitude' => '纬度',
            'longitude' => '经度',
            'currentCity' => '用户当前所在的城市',
            'status'=>'用户当前的状态，用于捡人用'
        );
    }

    public  function  rules(){
   return  array(

     array('latitude,longitude,currentCity','safe'),
     array('status','required','on'=>'status','message'=>'带*的必填')


    );
    }
    private function getStatus($name) {

        $userStatus= $this->findByPk(Yii::app()->user->userId);
        
 
        if ($userStatus) {
            return $userStatus->$name;
        } else {
              //应该将异常报给上一级。统一处理
              throw  new  CException('根据属性获取用户状态异常');
        }
    }
//这样做每次都会记录一个刷新时间。而不是当分享有更新的时候
    public function behaviors() {
        return array_merge(parent::behaviors(),array(
                              'CTimestampBehavior' => array(
                              'class' => 'zii.behaviors.CTimestampBehavior',
                              'createAttribute' => 'refreshTime',
                              'updateAttribute'=>'refreshTime'
            )
            )
        );
    }

    
    //user的信息还没有传进去。还要保存到user一份
    public   function  setAttributes(array $data){
          
          $attributes=$this->attributeNames();
             $length=count($attributes);
             
            for ($i=0;$i<$length;$i++) {
                $key=$attributes[$i];
              if(isset($data[$key])&&!empty($data[$key])){
                $this->$key=$data[$key];
              }
            }


    }


    public   function   __call($name,$argument){
              
            $attribute=strtolower(substr($name, 3,1)).substr($name, 4);

        if(strpos($name, 'set')!==FALSE){
        
         $this->updateByPk(Yii::app()->user->userId,array($attribute=>$argument[0]));

        }
       if(strpos($name, 'get')!==FALSE){

        if (isset(Yii::app()->user->$attribute)&&!empty(Yii::app()->user->$attribute)) {
        
            return Yii::app()->user->$attribute;
        } else {
          
          return  $this->getStatus($attribute);
            
        }
       }

    }

    //经纬度变化，那么Geohash的值也要跟着变化

    protected   function    beforeSave(){
        if(parent::beforeSave()){
        $comUserLocation = new ComUserLocation();
        $this->geohash = $comUserLocation->getGeohashCode($this->latitude, $this->longitude);
        }


  return true;
    }
}
