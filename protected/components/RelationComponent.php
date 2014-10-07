<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-10
 * Time: 下午10:01
 * 假设使用成员变量，这些条件是不是会叠加在一起？
 */

class RelationComponent {
    public $userId;
    public function __construct() {
        $this->userId = Yii::app()->user->userId;
    }
    public function getFriends() {
        $friends = array_intersect($this->getFans() , $this->getFollows());
        array_push($friends, Yii::app()->user->userId);
        
        return $friends;
    }
    public function getFans() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('priUserId=' . $this->userId);
        $criteria->addCondition('relationType=1');
        $criteria->addNotInCondition('subUserId', $this->getBlacks());
        
        return $this->getArray($criteria);
    }
    public function getFollows() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('subUserId=' . $this->userId);
        $criteria->addCondition('relationType=1');
        $criteria->addNotInCondition('subUserId', $this->getBlacks());
        
        return $this->getArray($criteria);
    }
    public function getBlacks() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('subUserId=' . $this->userId);
        $criteria->addCondition('relationType=0');
        
        return $this->getArray($criteria);
    }
    private function getArray(CDbCriteria $criteria) {
        $result = Relation::model()->findAll($criteria);
        $primaryKeys = array();
        
        foreach ($result as $value) {
            array_push($primaryKeys, $value->primaryKey);
        }
        
        return $primaryKeys;
    }
}
