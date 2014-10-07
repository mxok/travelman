<?php

class AuthenticationManager extends CApplicationComponent {
    public function login(LoginForm $form, CHttpRequest $request = null) {
        if ($form->login()) {

            return $form->identity->user;
        }
    }
}
?>