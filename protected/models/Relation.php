<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-19
 * Time: 上午10:53
 * 注意：黑名单没有清楚原来的数据
 */
class Relation extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {

        return parent::model($className);
    }

    public function tableName()
    {

        return '{{user_relation}}';
    }

    public function behaviors()
    {

        return array_merge(array('class' => 'ext.behaviors.JsonBehavior'));
    }

    public function rules()
    {
        return array(
            array(
                'subUserId,type', 'required','message' => '{attribute}不能为空'
            ),
            array(
                'subUserId',
                'authenticate'
            ),
        );
    }

    public function authenticate($attribute,$params)
    {
        $relationComponent = new RelationComponent();
        $blacks = $relationComponent->getBlacks($this->subUserId);

        if (in_array(Yii::app()->user->userId,$blacks, false)) {
            $this->addError('subUserId', '操作失败，对方已将你添加到黑名单。要注意errorcode不是1');
            Yii::app()->getController()->send(ERROR_BLACK,'操作失败，对方已将你添加到黑名单');
        }
    }

    /**
     * 返回某个关系的列表。应该按照用户名的大小写来排序，但是这里暂时成了按照注册日期来排序的!
     * @param  $type  填写四个:friends,follows,fans,blacks
     * @return CActiveDataProvider  返回CActiveDataProvider对象
     */
    public function getList($type)
    {
        $relationComponent = new RelationComponent();
        $function = 'get' . $type;
        $list = $relationComponent->$function();
        $criteria = new CDbCriteria();


                 $criteria->addInCondition('t.userId', $list);
        $criteria->order = 't.userId desc';
        $dataProvider = new CActiveDataProvider(User::model(), array(
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $dataProvider->setCriteria($criteria);

        return $dataProvider;
    }

    public function addRelation()
    {
   try{

      return $this->save();

   }
     catch(Exception $e){


         Yii::app()->getController()->send(ERROR_FATAL,'You have been added, please do not add a duplicate');
     }
    }
protected function beforeDelete(){



    parent::beforeDelete();

    $this->priUserId = Yii::app()->user->userId;

 return  true;
}













    protected function  beforeSave()
    {
        if (parent::beforeSave()) {
            $this->priUserId = Yii::app()->user->userId;
            $this->createTime = time();
            if ($this->type == '0') {
                $a = $this->attributes;
                $a['type'] = 1;
                unset($a['createTime']);
                $model = $this->findByPk($a);
                if (null != $model) {
                    $model->delete();
                }
                $a['priUserId'] = $a['subUserId'];
                $a['subUserId'] = Yii::app()->user->userId;
                $model = $this->findByPk($a);
                if (null != $model) {
                    $model->delete();
                }


            }
        }
        return true;

    }


}
