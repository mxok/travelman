<?php
  class  SearchHelper{




  	public  static  function   addCondition(SearchForm $condition, CDbCriteria $criteria){


if ($condition->gender) {
            $criteria->addCondition("gender={$gender}");
        }
        if ($search->location) {
           //這里应该分词搜索的
            $criteria->compare('destination',$location,true);
        }
         if($condition->residenceFlag){
             
            switch ($residenceFlag) {
                case 0:
                
                $criteria->addCondition("travel_user_extension.residence='{$this->currentCity}'");

                    break;
                case 1:
                $criteria->addCondition("travel_user_extension.residence!='{$this->currentCity}'");
                    break;
                default:
                    break;
            }
           
        }



  	}
  }


?>