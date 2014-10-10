<?php
 class User  extends  CActiveRecord{
  public $distance;
  public $age;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{user}}';
    }
    public function relations() {
        
        return array(

            'state' => array(self::HAS_ONE, 'UserState', 'userId')

        );
    }

    public function behaviors()
    {
        return array(
            'NearScopeBehavior' => array(
                'class' => 'ext.behavior.NearScopeBehavior',
                'latitude'=>Yii::app()->user->latitude,
                'longitude'=>Yii::app()->user->longitude,
                'enableDistance'=>true
            )
        );
    }

    private function addCondition(CFormModel & $condition)
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
            $criteria->mergeWith(array('order'=>'distance asc'));
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
        $dataProvider = new CActiveDataProvider(User::model()->near(), array(
                'pagination' => array(
                'pageSize' => 20,
                
            ),
        ));
        $dataProvider->setCriteria($this->addCondition($condition));
        return $dataProvider;
    }
  private function getAge() {
        $birthday = $this->birthday;
        $age = date('Y', time()) - date('Y', strtotime($birthday)) - 1;
        if (date('m', time()) == date('m', strtotime($birthday))) {

            if (date('d', time()) > date('d', strtotime($birthday))) {
                $age++;
            }
        } elseif (date('m', time()) > date('m', strtotime($birthday))) {
            $age++;
        }
      return $age;
    }


 }


?>