<?php

class Hasher extends CApplicationComponent
{
    public function init()
    {
        parent::init();
    }

    public function hashPassword($password, array $params = array())
    {
        return CPasswordHelper::hashPassword($password);
    }
    
    public function checkPassword($password, $hash)
    {
        return CPasswordHelper::verifyPassword($password, $hash);
    }
    
}
