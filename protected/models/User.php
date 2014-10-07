<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-6
 * Time: 下午4:29
 */

class User extends CActiveRecord {
    public $age;
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

        //一定要反回true或者false
        
    }
    