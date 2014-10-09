<?php
/**
 *用于查询附近：
 *有两种附近需要查询，一种是查询附近的计划，一种是查询附近的人
 *不要直接使用位置查询组件，而要使用Behavior来获取
 */

class NearScopeBehavior extends CActiveRecordBehavior {
    public $latitude;
    public $longitude;
    public $enableDistance = false;
    public function near() {
        $comUserLocation = new ComUserLocation();
        $geohashCode = $comUserLocation->getGeohashCode($this->latitude, $this->longitude);
        $nearPersons = $comUserLocation->getNearPerson($geohashCode);
        $this->Owner->getDbCriteria()->addInCondition('t.userId', $nearPersons);
        /**
         * t*的原因是因为不管有多少个查询条件，select只有一个（select最先计算，后面的懒加载都是以这个为标准的
         * join不影响的原因是因为懒加载。
         */
        if ($this->enableDistance) {
            $select = 't.*,   (ACOS(SIN((' . $this->latitude . '* 3.1415) / 180 ) 
                          *SIN((travel_user_state.latitude * 3.1415) / 180 ) 
        	              +COS((' . $this->latitude . '* 3.1415) / 180 ) * 
        	               COS((travel_user_state.latitude * 3.1415) / 180 ) *
        	               COS((' . $this->longitude . '* 3.1415) / 180 - 
        		           (travel_user_state.longitude * 3.1415) / 180 ) ) * 6378.137)  
        		           as distance';
            $join = 'LEFT JOIN travel_user_state ON travel_user_state.userId=t.userId';
            $this->Owner->getDbCriteria()->mergeWith(array(
                'select' => $select,
                'join' => $join
            ));
        }
        
        return $this->Owner;
    }
}
