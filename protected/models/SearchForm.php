<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class  SearchForm  extends CFormModel{
    public   $location;//搜索将要去的景点或者城市名
    public   $gender;
    public   $residence; //这是本地外地（本地外地，根据用户的位置来区分的）
    public  function   attributelabels(){
        
        return array(
            'location'=>'将要去的景点或者城市名',
            'gender'=>'性别',
            'residence'=>'本地/外地'
            
            
        );
        
    }
   public   function   rules(){



    return array(
       array('location,gender,residence','safe'),


        );
   }
}