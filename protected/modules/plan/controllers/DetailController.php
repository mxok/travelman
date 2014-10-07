<?php

class DetailController extends Controller {
    /**
     * 查看计划的详细界面
     * 详细界面只有评论。其中index页面使用了user moudel的comment view
     * 使用POST的方式来提交
     * PS：如果不使用场景，就获取不到值
     * 如何处理validate后传值给View层的情况
     */
     public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $plan = Plan::Model();
        $plan->setScenario('detail');
        $data = array(
            'model' => Plan::model()
        );
        if (isset($_POST['Plan'])) {
            $plan->attributes = $_POST['Plan'];
        }
        if ($plan->validate()) {
            $dataProvider = new CActiveDataProvider(PlanComment::model()->with('user') , array(
                'criteria' => array(
                    'condition' => 'planId=' . $plan->planId,
                    'order' => 'commentId DESC',
                ) ,
                'pagination' => array(
                    'pageSize' => 10,
                ) ,
            ));
            $data = array_merge($data, array(
                'dataProvider' => $dataProvider
            ));
            $this->page($dataProvider);
        } else {
            $this->error->capture($plan);
        }
        $this->render('index', $data);
    }
}
