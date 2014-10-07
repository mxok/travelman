<?php

class DefaultController extends Controller {
    public function actionIndex() {
        $tempForm = $this->initParams('TempForm', 'new');
        $data = array(
            'tempForm' => $tempForm
        );
        if ($tempForm->validate()) {
            $plan = Plan::model();
            $dataProvider = $plan->getDataProvider($tempForm);
            $this->page($dataProvider);
            $data = array_merge($data, array(
                'dataProvider' => $dataProvider
            ));
        } else {
            $this->error->capture($tempForm);
        }
        $this->render('index', $data);
    }
}
