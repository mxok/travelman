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
    public $criteria;
    public function __construct() {
        $this->userId = Yii::app()->user->userId;
        $this->criteria=new CDbCriteria();
    }
    public function getFriends() {
        $friends = array_intersect($this->getFans() , $this->getFollows());
        array_push($friends, Yii::app()->user->userId);
        
        return $friends;
    }
    public function getFans() {

        $this->criteria->addCondition('subUserId='.$this->userId);
        $this->criteria->addCondition('type=1');
        return $this->getArray($this->criteria);
    }
    public function getFollows() {

        $this->criteria->addCondition('priUserId=' . $this->userId);
        $this->criteria->addCondition('type=1');
        return $this->getArray($this->criteria);
    }

    /**
     *      这个是得到某人的黑名单
     * * @param $userId
     * @return array
     */
    public function getBlacks($userId) {
        $this->criteria->addCondition('priUserId='.$userId);
        $this->criteria->addCondition('type=0');
        return $this->getArray($this->criteria);
    }
    private function getArray(CDbCriteria $criteria) {
        $result = Relation::model()->findAll($criteria);
        $users = array();
        
        foreach ($result as $value) {
            array_push($users, $value->subUserId);
        }
        
        return array_values($users);
    }
}
