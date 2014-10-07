<?php

class DefaultController extends Controller {
    public function actions() {
        
        return array(
            'registration' => array(
                'class' => 'application.modules.user.controllers.actions.RegistrationAction',
            ) ,
            'login' => array(
                'class' => 'application.modules.user.controllers.actions.LoginAction',
            )
        ) ;
    }
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect('login');
    }
}
