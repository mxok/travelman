<?php

class RegistrationAction extends CAction {
    public function run() {
        $form = new RegistrationForm();
        if (isset($_FILES['RegistrationForm'])) {

            $this->controller->upload($form, array('avatar0'));
        }


        if (($data = Yii::app()->getRequest()->getPost('RegistrationForm')) !== null) {
            $form->setAttributes($data);
            if ($form->validate()) {
                if ($user = Yii::app()->userManager->createUser($form)) {
                    Yii::app()->user->login(new UserIdentity($form->username,$form->password),0);
                    Yii::app()->userManager->stateStorage->stateChange($user->userId,array('residence' => $form->residence));
                    $profile = Yii::app()->userManager->getProfile($user);
                    $profile['sessionID'] = Yii::app()->session->sessionID;
                    $this->controller->send(0, $profile);
                } else {
                    $this->controller->send(ERROR_FATAL,Yii::t('UserModule.user', 'register failure'));
                }
            } else {
                $this->controller->error->capture($form);
            }
        }
        $this->controller->render('registration', array('registration' => $form));
    }
}
?>