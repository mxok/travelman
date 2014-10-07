<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-6
 * Time: 下午4:29
 */

class Plan extends CActiveRecord {
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{plan}}';
    }
    /**
     * 如果要设置场景，那么每个规则都应该设置场景，否则就会出现验证出错
     *
     */
    public function rules() {
        
        return array(
            array(
                'destination,startDate,endDate,images,city',
                'required',
                'on' => 'publish',
                'message' => '{attribute}不能为空'
            ) ,
            array(
                'together,purpose,type,flightNumber,vehicle,postscript',
                'safe'
            ) ,
            array(
                'planId',
                'required',
                'on' => 'detail',
                'message' => '{attribute}不能为空'
            ),
           array(
                'userId',
                'required',
                'on' => 'list',
                'message' => '{attribute}不能为空'
            ),
        );
    }
    public function attributeLabels() {
        
        return array(
            'planId' => '计划的ID',
            'destination' => '目的地或者景点(前缀可以是城市名或者省会名)',
            'startDate' => '开始日期',
            'endDate' => '结束日期',
            'together' => '和谁一起去',
            'purpose' => '找人/建议',
            'type' => '游玩类型',
            'flightNumber' => '航班号/列车号,本地游可不填',
            'vehicle' => '交通工具',
             'city' => '出发城市',
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
    public function behaviors() {
        
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createTime',
            ) ,
            'NearScopeBehavior' => array(
                'class' => 'ext.behavior.NearScopeBehavior',
                'latitude' => Yii::app()->user->latitude,
                'longitude' => Yii::app()->user->longitude,
            )
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
    /**
     *      如果景点未知。那么城市就未知。
     *      但是城市未知，显示在客户端就很别扭
     *
     *
     */
    protected function beforeSave() {
      
        if (parent::beforeSave()) {
            $this->userId = Yii::app()->user->userId;
           
            }
            
            return true;
        
    }
    private function addCondition(CFormModel & $condition) {
        $criteria = new CDbCriteria();
        if ($condition->gender == '0' || $condition->gender == '1') {
            $criteria->addCondition('gender=' . $condition->gender);
        }
        if (!empty($condition->location)) {
            //這里应该分词搜索的
 $criteria->addCondition('destination  like  \'%'.$condition->location.'%\'  OR  '.'  city  like  \'%'.$condition->location.'%\'');
			
        }
        if ($condition->residence == '0' || $condition->residence == '1') {
            
            switch ($condition->residence) {
                case '0':
                    $criteria->addCondition('residence=' . '\'' . Yii::app()->user->currentCity . '\'');
                    break;

                case '1':
                    $criteria->addCondition('residence!=' . '\'' . Yii::app()->user->currentCity . '\'');
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
    public function getDataProvider(CFormModel & $condition) {
        $latitude = Yii::app()->user->latitude;
        $longitude = Yii::app()->user->longitude;
        $dataProvider = new CActiveDataProvider(Plan::model()->unexpired()->near()->with('user') , array(
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        $dataProvider->setCriteria($this->addCondition($condition));        
        return $dataProvider;
    }
    public function getList($userId) {
        $dataProvider = new CActiveDataProvider(Plan::model() , array(
            'criteria' => array(
                'condition' => 'userId=' . $userId,
                'order' => 'planId DESC',
            ) ,
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        
        return $dataProvider;
    }
}
