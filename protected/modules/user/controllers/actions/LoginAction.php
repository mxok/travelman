<?php

class LoginAction extends CAction {
    public function run() {
        $form = new LoginForm;
        if (($data = Yii::app()->getRequest()->getPost('LoginForm')) !== null) {
            $form->setAttributes($data);


            if ($form->validate()) {
                if ($user = Yii::app()->authenticationManager->login($form)) {
                    Yii::app()->userManager->stateStorage->stateChange($user->userId,$form->attributes);
                    $profile = Yii::app()->userManager->getProfile($user);
                    $profile['sessionID'] = Yii::app()->session->sessionID;
                    $this->controller->send(0, $profile);
                }
            } else {
                $this->controller->error->capture($form);
            }
        }
        $this->controller->render('login', array( 'loginForm' => $form));
    }

}
