<?php

class DefaultController extends Controller
{
	


	 public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $user = User::model();
        $searchForm = $this->initParams('SearchForm', 'new');
        $dataProvider = $user->getDataProvider($searchForm);
        $this->page($dataProvider, true);
        $data = array(
            'search' => $searchForm,
            'dataProvider' => $dataProvider
        );
        $this->render('index', $data);
    }
}