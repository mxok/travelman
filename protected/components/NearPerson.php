<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-14
 * Time: 下午2:10
 */

class NearPerson {

private   $_geohash; 




    public   function  __construct(){

         $this->_geohash =Yii::createComponent('application.venderors.Geohash');



    }

    /**
     * @return mixed这里取得是6位的GEOHASH。到时候要改成四位的
     */
    public static  function   getNearPersonsNoOrder(){
       
        $sql=' SELECT userId FROM   tbl_myr_refresh
               WHERE geohash
               IN (:geohash1, 
                   :geohash2, 
                   :geohash3,
                   :geohash4, 
                   :geohash5, 
                   :geohash6, 
                   :geohash7, 
                   :geohash8,
                   :geohash9)';
        $geohashCode= UserRefreshForm::model()->getGeohash();
        
        $neighbors = $geohash->neighbors($geohashCode);
        array_push($neighbors, $geohashCode);
        $connection=  Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command->bindParam(":geohash1",$neighbors[0],PDO::PARAM_STR);
        $command->bindParam(":geohash2",$neighbors['top'],PDO::PARAM_STR);
        $command->bindParam(":geohash3",$neighbors['bottom'],PDO::PARAM_STR);
        $command->bindParam(":geohash4",$$neighbors['right'],PDO::PARAM_STR);
        $command->bindParam(":geohash5",$neighbors['left'],PDO::PARAM_STR);
        $command->bindParam(":geohash6",$neighbors['topleft'],PDO::PARAM_STR);
        $command->bindParam(":geohash7",$neighbors['topright'],PDO::PARAM_STR);
        $command->bindParam(":geohash8",$neighbors['bottomright'],PDO::PARAM_STR);
        $command->bindParam(":geohash9",$neighbors['bottomleft'],PDO::PARAM_STR);
        $result=$command->queryAll();
        foreach ($result as $key=>$value){
            $arr[$key]=$value['userId'];
        }
   
        return $arr;

    }
   public function sortArrayByCreateTime(array &$result){

        uasort($result, "cmp");




    }

   public  function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;
        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }



    public   function   getGeohash($latitude,$longitude){




    





    }

}

function  cmp ( $a ,  $b ) {
    if ( $a['distance']  ==  $b['distance'] ) {
        return  0 ;
    }
    return ( $a  <  $b ) ? 1  :  -1 ;
}
