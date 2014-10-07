<?php

class TempForm extends CFormModel {
    public $latitude;
    public $longitude;
    public $currentCity;
    public $location; //搜索将要去的景点或者城市名
    public $gender;
    public $residence; //这是本地外地（本地外地，根据用户的位置来区分的,标志位）
    public function attributeLabels() {
        
        return array();
    }
    public function rules() {
        
        return array(
            array(
                'latitude,longitude,currentCity',
                'required',
                'message' => '{attribute}不能为空'
            ) ,
            array(
                'location,gender,residence',
                'safe'
            ) ,
        );
    }
}
