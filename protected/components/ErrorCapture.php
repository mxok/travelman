<?php
/***
  为什么不是CModel,因为CModel并没有处理behavior。
  Behavior的处理使用的是attachBehaviors，但是Cmodel里面并没有这样处理
*/
Class ErrorCapture extends CFormModel {
    public function attributeNames() {
    }
    public function behaviors() {
        return array(
            'json' => array(
                'class' => 'ext.behavior.JsonBehavior'
            )
        );
    }
    //请注意，这里是一个引用
    public function capture(CModel & $model) {
        $e = array_keys(get_object_vars($model));
        $p = array_keys($model->attributes);
        $c = array_merge($e, $p);
        foreach ($c as $attributeName) {
            if ($errorMessage = $model->getError($attributeName)) {
                if ($attributeName == 'password') {
                    $this->send(ERROR_PASSWORD, $errorMessage);
                } else {
                    $this->send(ERROR_PARAM, $errorMessage);
                }
            }
        }
    }
}
?>