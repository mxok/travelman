<?php
//详细的我已经返回了

class PlanController extends Controller {
    public $userId;
    public $model;
    /**
     * actionIndex 返回个人发布的计划列表,还有就是查看别人的计划列表,只包含评论数，不包含评论
     * 
     */
    public function filters() {
        return array(
            array('application.filters.SessionCheckFilter'),
        );
    }
    public function actionIndex() {
        $model=$this->initParams('Plan','model','list');
       
		
          $data=array('model'=>$model);
    if($model->validate()){
            $dataProvider = new CActiveDataProvider($model , array(
                'criteria' => array(
                    'condition' => 'userId=' . $model->userId,
                    'order' => 'planId DESC',
                ) ,
                'pagination' => array(
                    'pageSize' => 20,
                ) ,
            ));
            $this->page($dataProvider, false);
            $data = array_merge($data, array(
                'dataProvider' => $dataProvider
            ));
        
    }
    else{

        $this->error->capture($model);
    }
        $this->render('index', $data);
    }
    /**
     * 
     * 查看plan的详细。在里面就包括了评论等具体的内容，注意，评论则需要分页。
     * 因为plan本身已经返回，所以只返回评论的内容。
     */
    public function actionDetail($planId) {
        $plan = Plan::model()->findByPk('planId','planId=:planId',array(':planId'=>$planId));
        $dataProvider = $plan->getComments();
        $this->page($dataProvider);
        $data = array(
            'data' => $dataProvider
        );
        $this->render('detail', $data);
    }
   
}
?>