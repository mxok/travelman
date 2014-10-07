<?php

class DefaultController extends Controller {
    public $currentCity;
    public $nearPersons;
    public $residence;
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $plan = Plan::model();
        $searchForm = $this->initParams('SearchForm', 'new');
        $dataProvider = $plan->getDataProvider($searchForm);
        $this->page($dataProvider, true);
        $data = array(
            'search' => $searchForm,
            'dataProvider' => $dataProvider
        );
        $this->render('index', $data);
    }
}
