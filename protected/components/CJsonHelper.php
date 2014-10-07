<?php

class CJsonHelper extends CComponent {
    /**
     *
     * @var $relations
     */
    public $relations;
    /**
     * $extensionKey
     * @var string
     */
    public $extensionKey = 'extension';
    /**
     * $mainKey
     * @var string
     */
    public $mainKey = 'message';
    /**
     * $errorCodeKey
     * @var string
     */
    public $errorCodeKey = 'errorCode';
    /**
     * $extension
     * @var array
     */
    public $extension = array();
    /**
     * $result
     * @var array
     */
    public $result = array();
    /**
     * $errorCode
     * @var integer
     */
    public $errorCode = 0;
    /**
     *
     * @var $data
     */
    public $data;
    /**
     * parse CActiveRecord
     */
    private function getRelationsArray($model) {
        $a = array();
        $relations = $this->relations;
        if (!empty($relations)) {
            /**
             * parse relations : 'user'=>array('username','id','age');
             *
             */
            
            foreach ($relations as $rk => $relatedShowAttributes) {
                if ($model->hasRelated($rk)) {
                    $rm = $model->getRelated($rk);
                    
                    return array_merge($model->attributes, $this->getRelatedAttributes($rm, $relatedShowAttributes));
                }
            }
        } else {
            $relations = $model->relations();
            $r = array_keys($relations);
            
            foreach ($r as $rk) {
                if ($model->hasRelated($rk)) {
                    $rm = $model->getRelated($rk);
                    
                    return array_merge($model->attributes, $rm->attributes);
                }
            }
        }
    }
    private function setProvider() {
        if ($this->data instanceof CActiveDataProvider) {
            $data = $this->data->getData();
            
            foreach ($data as $singleActiveRecord) {
                array_push($this->result, $this->getRelationsArray($singleActiveRecord));
            }
        } else if ($this->data instanceof CActiveRecord) {
            $this->result = $this->getRelationsArray($this->data);
        }
        
        return $this->result;
    }
    private function merge() {
        if (!empty($this->extension)) {
            
            return array(
                $this->errorCodeKey = $this->errorCode,
                $this->extensionKey => $this->extension,
                $this->mainKey => $this->result,
            );
        } else {
            
            return array(
                $this->errorCodeKey => $this->errorCode,
                $this->mainKey => $this->result,
            );
        }
    }
    private function getRelatedAttributes($model, $relatedShowAttributes) {
        $relationAtts = array();
        
        foreach ($relatedShowAttributes as $k) {
            $relationAtts[$k] = $model->getAttribute($k);
        }
        
        return $relationAtts;
    }
    public function format($errorCode,$data, $execute = true) {
        $this->errorCode=$errorCode;

        if (is_array($data)) {
            
            foreach ($data as $name => $value) {
                $this->$name = $value;
            }
        } else {
            $this->result = $data;
        }
        $this->setProvider();
        $json = CJSON::encode($this->merge());
        $json = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'unescapedUnicode', $json);
        $sever = $_SERVER['HTTP_USER_AGENT'];
        if (strpos(strtolower($sever) , 'android') !== FALSE || empty($sever)) {
            header('Content-type:application/json;charset=utf-8');
            if ($execute) {
                exit($json);
            }
        } else {
            header('Content-type:text/html;charset=utf-8');
            Yii::app()->getController()->jsonText = jsonFormat($json);
        }
    }
}
function unescapedUnicode($match) {
    
    return mb_convert_encoding(pack('H*', $match[1]) , 'UTF-8', 'UCS-2BE');
}
?>