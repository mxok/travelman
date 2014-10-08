<?php

class Hasher extends CApplicationComponent
{
    public function init()
    {
        parent::init();
    }

    /**
     *
     * 某些系统不支持crypt加密。只能用md5加密了
     *
     *
     * @param password        客户端传递过来的密码
     *@param array $params
     * @return string
     */
    public function hashPassword($password, array $params = array())
    {

        if (!function_exists('crypt')) {
            return CPasswordHelper::hashPassword($password);
        } else {
            return md5($password);
        }
    }

    /**
     * @param $password
     * @param $hash         服务器存储的加密后的密码
     *  * @return bool
     */
    public function checkPassword($password, $hash)
    {
        if(md5($password)==$hash){
            return  true;
        }

        return  false;
//        return CPasswordHelper::verifyPassword($password, $hash);
    }

}
