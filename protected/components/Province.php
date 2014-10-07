<?php

class Province extends CActiveRecord{
    public static  function  model($className=__CLASS__){
 


        return parent::model($className);
    }



    public  function  tableName(){

        return '{{province}}';
    }


    public  function  loadModel($location){


      return    $this->find('name=:name', array(':name'=>$location));


    }
}
?>