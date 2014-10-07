<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-14
 * Time: 下午2:10
 * 改造：使用单例的模式
 */
require_once ('geohash/GeoHash.php');

class ComUserLocation {
    public $geohash;
    public function __construct() {
        $this->geohash = new Geohash();
    }
/**
 * 根据GEOHASH编码得到附近的人
 * @param  string  $geohashCode 
 * @return  array  $arr
 */
    public  function getNearPerson($geohashCode) {
        $neighbors = $this->geohash->neighbors($geohashCode);
        array_push($neighbors, $geohashCode);
        $criteria = new CDbCriteria;
        $criteria->addInCondition('geohash' , array_values($neighbors));
        $states = UserState::model()->findAll($criteria);
        $arr = array();
        foreach ($states as $key => $value) {
            $arr[$key] = $value->userId;
        }
        return $arr;
    }
    public function sortArrayByCreateTime(array & $result) {
        uasort($result, "cmp");
    }
    public function getDistance($lat1, $lng1, $lat2, $lng2) {
        $earthRadius = 6367000; //approximate radius of earth in meters
        $lat1 = ($lat1 * pi()) / 180;
        $lng1 = ($lng1 * pi()) / 180;
        $lat2 = ($lat2 * pi()) / 180;
        $lng2 = ($lng2 * pi()) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2) , 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2) , 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        
        return round($calculatedDistance);
    }
    public function getGeohashCode($latitude, $longitude) {
        $hashCode = $this->geohash->encode($latitude, $longitude);
        
        return substr($hashCode, 0, 4);
    }
}
function cmp($a, $b) {
    if ($a['distance'] == $b['distance']) {
        
        return 0;
    }
    
    return ($a < $b) ? 1 : -1;
}
