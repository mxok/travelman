<?php

class EditController extends Controller
{
    public function filters()
    {

        return array(
            array(
                'application.filters.SessionCheckFilter'
            ),
        );
    }

    public function actionIndex()
    {
        $user = User::model()->findByPk(Yii::app()->user->userId);
        if ((isset($_POST['User'])) || (isset($_FILES['User']))) {
            $user->setAttributes($_POST['User'], false);
            $this->upload($user, array('avatar0'));
            if ($user->save(false)) {
                $this->send(ERROR_NONE, 'success');
            } else {
                $this->send(ERROR_FATAL, 'fail');
            }
        }

        $this->render('index', array('user' => $user));
    }
}
