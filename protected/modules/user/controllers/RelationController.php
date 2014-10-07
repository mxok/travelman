<?php

class RelationController extends Controller {
public $dataProvider;
public  $model;
public function init(){
    $this->model=$this->initParams('Relation');
    parent::init();

}
     public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
  
    //取得好友列表
    public function actionFriends() {
      
        $this->dataProvider = $this->model->getList('Friends');
    }
    //
    public function actionFans() {
      
        $this->dataProvider = $this->model->getList('Fans');
      
    }
    //取得关注列表
    public function actionFollows() {
     
        $this->dataProvider = $this->model->getList('Follows');
    }
    //取得黑名单列表
    public function actionBlacks() {
        $this->dataProvider = $this->model->getList('Blacks');
    }
    //删除某个关系:取消关注，取消拉黑
    public function actionCancel() {
        $this->model->priUserId = Yii::app()->user->userId;
        if ($model->validate()) {
            $a = $model->attributes;
            unset($a['createTime']);
            $model = $model->findByPk($a);
            if ($model->delete()) {
                $this->send(ERROR_NONE, 'success');
            }
            else{
                 $this->send(ERROR_TIP, 'fail');
            }
        }
        else{
            $this->error->capture($this->model);
        }
        $this->render('cancel', array('relation' => $this->model));
    }
    public function actionAdd() {
        $model = $this->initParams('Relation', 'new');
        if ($model->validate()) {
            if ($model->addRelation()) {
                $this->send(ERROR_NONE, 'success');
            }
            else{
                $this->send(ERROR_TIP, 'fail');
            }
        } else {
            $this->error->capture($this->model);
        }
        $this->render('add', array(
            'relation' => $model
        ));
    }
    protected function afterAction(CAction $action) {
        if ($this->dataProvider != null) {
            $this->page($this->dataProvider);
			$this->render('index');
        }
    
    }
}
?>