<?php
 class User  extends  CActiveRecord{
  public $distance;
  public $age;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{user_meta}}';
    }
    public function relations() {
        
        return array(
            'extension' => array(
                self::HAS_ONE,
                'UserExt',
                'userId'
            ) ,
            'status' => array(
                self::HAS_ONE,
                'UserStatus',
                'userId'
            ) ,
            'avatar' => array(
                self::HAS_ONE,
                'Avatar',
                'userId'
            )
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
    /**
     * getUser 返回的是一个数组，而非一个对象
     * @return array
     */
    public function getUser() {
       $this->age = $this->getAge();
        return array_merge(array(
            'age'=>$this->age,
            'gender' => $this->gender,
            'residence' => $this->residence,
            'distance'=>$this->distance,
        ) , $this->extension->attributes, $this->avatar->attributes);
    }
    private function addCondition(CFormModel & $condition)
    {        
        $criteria = new CDbCriteria();
        //不用empty的原因是因为值为0empty照样是空
        if ($condition->gender=='0'||$condition->gender=='1') {

            $criteria->addCondition('gender=' . $condition->gender);
        }
        if ($condition->location !== null) {
            //這里应该分词搜索的
            $criteria->compare('destination', $condition->location, true);
        }
        if ($condition->residence !== null) {

            switch ($condition->residence) {
                case 0:
                    $criteria->addCondition('residence=' . '\'' . Yii::app()->user->currentCity . '\'');
                    break;

                case 1:
                    $criteria->addCondition('residence!=' . '\'' . Yii::app()->user->currentCity . '\'');
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
        $birthday = $this->extension->birthday;
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