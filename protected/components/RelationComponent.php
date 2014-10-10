<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-10
 * Time: 下午10:01
 * 假设使用成员变量，在查看好友的时候，这些条件就会叠加在一起。
 *    还有一个问题，就是性能的问题，findALL是查询所有的数据之后，查询用户资料的时候再分页，
 *
 *   与直接使用findAll直接来分页，性能要差很多




 *



 */

class RelationComponent {
    public $userId;
    public $criteria;
    public function __construct() {
        $this->userId = Yii::app()->user->userId;
        $this->criteria=new CDbCriteria();
    }
    public function getFriends() {
        //用的都是一个$this->criteria。条件叠加了，自然查找不出来数据！
        $friends = array_intersect($this->getFans() , $this->getFollows());
        array_push($friends, Yii::app()->user->userId);
        
        return $friends;
    }
    public function getFans() {
        $criteria=new CDbCriteria();
        $criteria->addCondition('subUserId='.$this->userId);
        $criteria->addCondition('type=1');
        $result = Relation::model()->findAll($this->criteria);
        $users = array();
        foreach ($result as $value) {
            array_push($users, $value->priUserId);
        }

        return array_values($users);




    }
    public function getFollows() {
        $criteria=new CDbCriteria();
        $criteria->addCondition('priUserId=' . $this->userId);
        $criteria->addCondition('type=1');
        return $this->getArray($this->criteria);

    }

    /**
     *      这个是得到某人的黑名单
     * * @param $userId
     * @return array
     */
    public function getBlacks($userId) {
        $criteria=new CDbCriteria();
        $criteria->addCondition('priUserId='.$userId);
        $criteria->addCondition('type=0');
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
