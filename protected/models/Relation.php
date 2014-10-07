<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-19
 * Time: 上午10:53
 * 注意：黑名单没有清楚原来的数据
 */

class Relation extends CActiveRecord {
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{user_relation}}';
    }
    public function behaviors() {
        
        return array_merge(array(
            'class' => 'ext.behaviors.JsonBehavior'
        ) , array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
                'updateAttribute' => null
            )
        ));
    }
    public function rules() {
        
        return array(
            array(
                'subUserId,relationType',
                'required',
                'message' => '{attribute}不能为空'
            ) ,
            array(
                'subUserId',
                'authenticate'
            ) ,
        );
    }
    public function authenticate() {
        $relationComponent = new RelationComponent();
        $blacks = $relationComponent->getBlacks();
        if (in_array($this->subUserId, $blacks, true)) {
            $this->arrError('subUserId', '操作失败，对方已将你添加到黑名单');
        }
    }
    /**
     * 返回某个关系的列表。应该按照用户名的大小写来排序，但是这里暂时成了按照注册日期来排序的!
     * @param  $type  填写四个:friends,follows,fans,blacks
     * @return CActiveDataProvider  返回CActiveDataProvider对象
     */
    public function getList($type) {
    $relationComponent = new RelationComponent();
        $function = 'get' . $type;
        $list = $relationComponent->$function();
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.userId', $list);
        $criteria->order = 't.userId desc';
        $dataProvider = new CActiveDataProvider(User::model() , array(
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        $dataProvider->setCriteria($criteria);
        
        return $dataProvider;
    }
    public function addRelation() {
        $this->priUserId = Yii::app()->user->userId;
        
        return $this->save();
    }
   
}
