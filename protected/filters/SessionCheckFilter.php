<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

class SessionCheckFilter extends CFilter {
    public function init() {
        parent::init();
        $this->attachBehaviors(array(
            'class' => 'ext.behavior.JsonBehavior'
        ));
    }
    protected function preFilter($filterChain) {
        if (isset(Yii::app()->user->userId) && (!empty(Yii::app()->user->userId))) {

             return true;
        } else {
         $this->send(ERROR_SESSION, '用户id获取失败，您需要重新登录');
           Yii::app()->user->loginRequired();
            return false;
        }

         
    }
    
   
}
