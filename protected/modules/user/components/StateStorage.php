<?php

class StateStorage extends CApplicationComponent {
    public $data = array();
    public function init() {
        parent::init();
        if (isset(Yii::app()->user->userId)) {
            $this->data = UserState::model()->findByPk(Yii::app()->user->userId)->attributes;
        }
    }
    /**
     * 这里的create 并没有存储经纬度和当前城市
     * @param  User         $user 
     * @param  RegsiterForm $form 
     * @return  bool          
     */
    public function create(User $user, RegistrationForm $form) {
        $model = new UserState();
        $model->userId = $user->userId;
        $model->type = $form->type;
        
        if ($model->save()) {
            
            return $model;
        } else {
            
            return false;
        }
    }
    /**
     *
     * @param
     * @param
     * @return
     */
    public function stateChange($userId, array $data) {
        $model = UserState::model()->findByPk($userId);
        if (array_key_exists('userId', $data)) {
            unset($data['userId']);
        }
        $model->attributes = $data;
        if (!empty($model->attributes)) {
            $model->save();           
            foreach ($model->attributes as $key => $value) {
                Yii::app()->user->setState($key, $value);
            }
        }
    }
    //如果没有设置，将在数据库中去查找，问题在于,Userid如何找到
    public function __get($name) {
        if (isset(Yii::app()->user->$name)) {          
            return Yii::app()->user->$name;
        } else {            
            return $this->data[$name];
        }
    }
}
?>