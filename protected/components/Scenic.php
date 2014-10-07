<?php

class Scenic extends CActiveRecord {
    const CITY = 1;
    const PROVINCE = 2;
    const SECENIC = 3;
    const INVAILD = 0;
    private $_flag = 0;
    public static function model($className = __CLASS__) {
        
        return parent::model($className);
    }
    public function tableName() {
        
        return '{{scenic}}';
    }
    /**
      *用户有可能输入四种情况：
      * 1.景点名
      * 2.城市名
      * 3.国家名
      * 4.省的名字
      * 5.一个数据库没有的名字
      * 6.要从行政数据库里面查找名字
      */
    public function authenticate($location) {
        //先判断这是否是一个景点名
        if ($this->find('name=:name', array(
            ':name' => $location
        ))) {
            
            return $this->_flag = self::SECENIC;
        }
        //在行政区表里面查找城市名或者省名
        else if (City::model()->loadModel($location)) {
            
            return $this->_flag = self::CITY;
        } else if (Province::model()->loadModel($location)) {
            
            return $this->_flag = self::PROVINCE;
        }
        //查找国家名或者著名的景点。暂无，不支持国外的
        else {
            
            return $this->_flag = self::INVAILD;
        }
    }
    public function getCity($location) {
        if ($this->_flag == self::SECENIC) {
               if(is_int($location)){

              if ($cityName = $this->find('scenicId=:scenicId', array(':scenicId' => $location))->city) {
                
                return $cityName;
                    }

               }

            if ($cityName = $this->find('name=:name', array(':name' => $location))->city) {
                
                return $cityName;
            }
        }
        //比如用户发了一个杭州大雁塔。但是未收录
        else {
            
            return $location;
        }
    }
}
