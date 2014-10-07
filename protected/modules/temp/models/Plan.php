<?php

class Plan extends CActiveRecord {
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{plan}}';
    }
    public function attributeLabels() {
        
        return array(
            'planId' => '计划的ID',
            'destination' => '目的地',
            'startDate' => '开始日期',
            'endDate' => '结束日期',
            'together' => '和谁一起去',
            'purpose' => '找人/建议',
            'type' => '游玩类型',
            'flightNumber' => '航班号/列车号',
            'vehicle' => '交通工具',
            'postscript' => '补充'
        );
    }
    public function relations() {
        
        return array(
            'user' => array(
                self::BELONGS_TO,
                'User',
                'userId'
            ) ,
        );
    }
    public function scopes() {
        
        return array(
            'unexpired' => array(
                'condition' => 'DATEDIFF(endDate,' . '\'' . date('Y-m-d') . '\'' . ')>=0',
                'order' => 'planId DESC'
            ) ,
        );
    }
    private function addCondition(CFormModel & $condition) {
        $criteria = new CDbCriteria();
        if (!empty($condition->gender)) {
            $criteria->addCondition('gender=' . $condition->gender);
        }
        if (!empty($condition->location)) {
            //這里应该分词搜索的
           $criteria->addCondition('destination  like  \'%'.$condition->location.'%\'  OR  '.'  city  like  \'%'.$condition->location.'%\'');
        }
        if (!empty($condition->residence)) {
            
            switch ($condition->residence) {
                case 0:
                    $criteria->addCondition('residence=' . '\'' . $condition->currentCity . '\'');
                    break;

                case 1:
                    $criteria->addCondition('residence!=' . '\'' . $condition->currentCity . '\'');
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
     * @return CActiveDataProvider $dataProvider  返回CActiveDataProvider对象
     * 使用attach的好处是随时绑定，不一定在初始化的时候绑定
     */
    public function getDataProvider(CFormModel & $condition) {
        $this->attachBehaviors(array(
            'NearScopeBehavior' => array(
                'class' => 'ext.behavior.NearScopeBehavior',
                'latitude' => $condition->latitude,
                'longitude' => $condition->longitude,
            )
        ));
        $dataProvider = new CActiveDataProvider(Plan::model()->unexpired()->near()->with('user') , array(
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        $dataProvider->setCriteria($this->addCondition($condition));        
        return $dataProvider;
    }
}
