<?php

class City extends CActiveRecord{
    public static  function  model($className=__CLASS__){
 


        return parent::model($className);
    }



    public  function  tableName(){

        return '{{city}}';
    }


    public  function  loadModel($location){


      return    $this->find('name=:name', array(':name'=>$location));


    }
}
?>