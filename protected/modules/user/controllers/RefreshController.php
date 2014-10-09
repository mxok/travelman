<?php

class RefreshController extends Controller {
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $form = new StateForm();
        if (($data = Yii::app()->getRequest()->getPost('StateForm')) !== null) {
            $form->setAttributes($data);
            if ($form->validate()) {
                if(Yii::app()->userManager->stateStorage->stateChange(Yii::app()->user->userId, $form->attributes)){
                   $this->send(0, Yii::t('UserModule.user', 'refresh  success'));

                };               
            } else {
                $this->error->capture($form);
            }
        }
        $this->render('refresh', array('stateForm' => $form));
    }
}
?>