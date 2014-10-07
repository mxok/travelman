<?php

class EditController extends Controller {
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $user = User::model()->findByPk(Yii::app()->user->userId);
        if (isset($_POST['User'])) {
            $user->setAttributes($_POST['User'], false);
            if ($user->save(false)) {
                $this->send(ERROR_NONE, 'success');
            } else {
                $this->send(ERROR_TIP, 'file');
            }
        }
        $this->render('index', array('user' => $user));
    }
}
