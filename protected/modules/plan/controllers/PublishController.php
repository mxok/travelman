<?php
/**
 * 验证一但设置场景，所有的场景都要设置。而且接受POST值在场景之后
 */

class PublishController extends Controller {
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $plan = $this->initParams('Plan', 'new', 'publish');
        $this->multiImageUpload($plan);
        if ($plan->validate()) {
            if ($plan->save()) {
                $this->send(ERROR_NONE, array(
                    'planId' => $plan->planId
                ));
            }
        } else {
            $this->error->capture($plan);
        }
        $this->render('index', array(
            'model' => $plan
        ));
    }
}
?>