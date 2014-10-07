<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/
/**
 * Description of DropList
 *
 * @author Administrator
 */
Yii::import('application.vendors.scws.*');
require_once ('scws.php');
class DropList extends CActiveRecord {
    public $scenicName;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{scenic}}';
    }
    public function attributeLabels() {
        
        return array(
          'scenicName' => '输入的景点名'
        );
    }
    public function rules() {
        
        return array(array( 'scenicName',  'required','message'=>'必填'));
    }
    public function getScenics() {
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name', $this->scenicName);
        $currentCity = Yii::app()->user->currentCity;
        $criteria->addCondition("city='{$currentCity}'");
        return $this->findAll($criteria);
    }
    public function getScenicsAll() {
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name', $this->scenicName);
        return $this->findAll($criteria);
    }


    public   function   getScenicsBySegment(){
                $criteria = new CDbCriteria();
                $scws = new SCWS();
                $scws->parse($this->scenicName);
                $param1 = $scws->result[0];
                if ($param1!= null) {
                    $criteria->addCondition("city='{$param1}'OR province='{$param1}'");
                }
                if (count($scws->result) > 1) {
                    $param2 = $scws->result[1];
                    $criteria->addSearchCondition('name', $param2);
                }
              
                return $this->findAll($criteria);



    }

  public    function  getDropList(){


               return 	array_merge($this->getScenics(),
                                  	$this->getScenicsAll(),
               	                    $this->getScenicsBySegment()
               	                    );
  }
}
