<?php

/**
 * Created by PhpStorm.
 * plan: Administrator
 * Date: 14-6-6
 * Time: 下午4:29
 */
class Plan extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {

        return parent::model($className);
    }

    public function tableName()
    {

        return '{{plan}}';
    }

    /**
     * 如果要设置场景，那么每个规则都应该设置场景，否则就会出现验证出错
     *
     */
    public function rules()
    {

        return array(
            array(
                'destination,startDate,endDate,images,city,startCity',
                'required',
                'on' => 'publish',
                'message' => Yii::t('PlanModule.plan', '{attribute} should  not  be black')
            ),
            array(
                'together,purpose,type,flight,vehicle,postscript',
                'safe'
            ),
            array(
                'planId',
                'required',
                'on' => 'detail',
                'message' => Yii::t('PlanModule.plan','{attribute} should  not  be black')
            ),
            array(
                'userId',
                'required',
                'on' => 'list',
                'message' => Yii::t('PlanModule.plan','{attribute} should  not  be black')
            ),
        );
    }

    public function attributeLabels()
    {
        return array(
            'planId' => Yii::t('PlanModule.plan', 'planId'),
            'destination' => Yii::t('PlanModule.plan', 'destination'),
            'startDate' => Yii::t('PlanModule.plan', 'startDate'),
            'endDate' => Yii::t('PlanModule.plan', 'endDate'),
            'together' => Yii::t('PlanModule.plan', 'together'),
            'purpose' =>  Yii::t('PlanModule.plan', 'purpose'),
            'type' =>     Yii::t('PlanModule.plan', 'type'),
            'flight' => Yii::t('PlanModule.plan', 'flight'),
            'vehicle' => Yii::t('PlanModule.plan', 'vehicle'),
            'startCity' => Yii::t('PlanModule.plan', 'startCity'),
            'postscript' => Yii::t('PlanModule.plan', 'postscript')
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO,   'User',   'userId'),
            'state'=>array(self::BELONGS_TO,   'UserState',   'userId'),
        );
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
            ),
            'NearScopeBehavior' => array(
                'class' => 'ext.behavior.NearScopeBehavior',
                'latitude' => Yii::app()->user->latitude,
                'longitude' => Yii::app()->user->longitude,

            )
        );
    }
    public function scopes()
    {

        return array(
            'unexpired' => array(
                'condition' => 'DATEDIFF(endDate,' . '\'' .date('Y-m-d') . '\''.')>=0',
                'order' => 'planId DESC'
            ),
        );
    }

    /**
     *      如果景点未知。那么城市就未知。
     *      但是城市未知，显示在客户端就很别扭
     *
     *
     */
    protected function beforeSave()
    {

        if (parent::beforeSave()) {
            $this->userId = Yii::app()->user->userId;

        }
        return true;
    }
    private function search(CFormModel & $condition)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('destination', $condition->location, true);
        $criteria->compare('gender', $condition->gender, false);
        if ($condition->residence == '0' || $condition->residence == '1') {
            switch ($condition->residence) {
                case '0':
                   $criteria->compare('residence',Yii::app()->user->currentCity,true);
                    break;

               case '1':
                   $criteria->compare('residence','<>'.Yii::app()->user->currentCity,true);
                   break;

                default:
                    break;
            }
        }

        return $criteria;
    }






    /**
     *
     * 改进：使用延迟绑定，将这个函数写在父类里面
     *返回某个用户所发布的所有计划列表
     *
     * @return CActiveDataProvider $dataProvider  返回CActiveDataProvider对象
     */
    public function getDataProvider(CFormModel & $condition)
    {
        $dataProvider = new CActiveDataProvider(Plan::model()->unexpired()->near()->with(array('user','state')), array(
                'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $dataProvider->setCriteria($this->search($condition));
        return $dataProvider;
    }

    public function getList($planId)
    {
        $dataProvider = new CActiveDataProvider(Plan::model(), array(
            'criteria' => array(
                'condition' => 'planId=' . $planId,
                'order' => 'planId DESC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        return $dataProvider;
    }



}
