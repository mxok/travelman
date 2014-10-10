<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-6
 * Time: 下午4:29
 */

class User extends CActiveRecord {
    public $age;
    public $distance;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{user}}';
    }
    public function relations() {
        
        return array(
            'state' => array( self::HAS_ONE,'UserState', 'userId'));
        }

//直接使用Behaviors方法这里报错的原因是Behaviors在User创建后即被初始化。Yii::app()->user->latitude此时都还不存在！



    protected   function   beforeFind(){

   parent::beforeFind();
        if(isset(Yii::app()->user->latitude,Yii::app()->user->longitude)){

            $this->attachBehaviors( array(
                'NearScopeBehavior' => array(
                    'class' => 'ext.behavior.NearScopeBehavior',
                    'latitude'=>Yii::app()->user->latitude,
                    'longitude'=>Yii::app()->user->longitude,
                    'enableDistance'=>true
                )
            ));
            $this->near();//CTimeBehavior实现了自动调用。人家用的是事件。我们没有用事件，只能是手工调用了


        }

    return  true;

    }




    }
    