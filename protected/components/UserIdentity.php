<?php
/**
 *
 *
 *
 * 支持邮箱/用户名/和用户ID登录
 */

class UserIdentity extends CUserIdentity {
    public $user;
    public function authenticate() {
        $this->user = User::model()->find(array(
            'condition' => 'email=:username  OR  username=:username  OR userId=:username',
            'params' => array(
                ':username' => $this->username
            )
        ));
        if ($this->user == null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;

            return false;
        }
        if (!Yii::app()->userManager->hasher->checkPassword($this->password, $this->user->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;

            return false;
        }

        $this->errorCode = self::ERROR_NONE;

        return true;
    }
}
