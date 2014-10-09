<?php

class UserManager extends CApplicationComponent {
    public $hasher;
    public $user;
    public $stateStorage;
    public function init() {
        $this->hasher =Yii::createComponent('application.modules.user.components.Hasher');
        $this->stateStorage=Yii::createComponent('application.modules.user.components.StateStorage');
    }
    public function createUser(RegistrationForm $form) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $user = new User;
            $data = $form->getAttributes();
            $user->setAttributes($data, false);
            $user->password = $this->hasher->hashPassword($form->password);
            $user->session = Yii::app()->session->sessionID;
            $user->md5 = md5(time());
            $user->registerDate = date('Y-m-d', time());

            if ($user->save()) {
                if ($this->stateStorage->create($user, $form)) {
                    $transaction->commit();
                    return $user;
                }
            }
           throw new CException(Yii::t('UserModule.user', 'Error creating account!'));
        }
        catch(Exception $e) {

            $transaction->rollback();
            
            return false;
        }
    }
    public function getProfile(User $user) {
        $age = $this->getAge($user);
        $data= array_merge(array(
            'age' => $age,
            'residence' => $user->state->residence,
            'distance'=>$user->distance,
        ) , $user->attributes);

        unset($data['session']);
        unset($data['password']);
        return  $data;
    }
    private function getAge($user) {
        $birthday = $user->birthday;
        $age = date('Y', time()) - date('Y', strtotime($birthday)) - 1;
        if (date('m', time()) == date('m', strtotime($birthday))) {
            if (date('d', time()) > date('d', strtotime($birthday))) {
                $age++;
            }
        } elseif (date('m', time()) > date('m', strtotime($birthday))) {
            $age++;
        }
        
        return $age . '';
    }




      public   function    checkEmail($email){

          $model= User::model()->find('email=:email', array(':email' =>$email));
          if ($model) {
              Yii::app()->getController()->send(ERROR_EMAIL_HAS,Yii::t('UserModule.user', 'email already has  been  registered'));
              return  false;
          }

          else{
              Yii::app()->getController()->send(ERROR_NONE,Yii::t('UserModule.user', 'email not has  been  registerted'));

          }

      }
}
?>