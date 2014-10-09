<?php

class JsonBehavior extends CBehavior {
    public function send($errorCode,$data,$more = true,$extra=array(),$execute=true) {
        //注意要判断message是否为空。
        $arr = array(
            'errorCode' => (string)$errorCode,
            'message' => format($data, $more,$extra)
        );
        $json = CJSON::encode($arr);
        $json = preg_replace_callback('/\\\\u([0-9a-f]{4})/i','unescapedUnicode', $json);
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']) , 'android') !== FALSE) {
            header('Content-type:application/json;charset=utf-8');
            if($execute){
               exit($json);  
            }
           else{
            echo $json;
           }
        } else if (empty($_SERVER['HTTP_USER_AGENT'])) {
            header('Content-type:application/json;charset=utf-8');
           if($execute){
               exit($json);  
            }
           else{
            echo $json;
           }
        } else {
            header('Content-type:text/html;charset=utf-8');
            Yii::app()->getController()->jsonText = jsonFormat($json);
        }
    }
}
/** Json数据格式化
 * @param  Mixed  $data   数据
 * @param  String $indent 缩进字符，默认4个空格
 * @return JSON
 */
function jsonFormat($data, $indent = null) {
    // 缩进处理
    $ret = '';
    $pos = 0;
    $length = strlen($data);
    $indent = isset($indent) ? $indent : '    ';
    $newline = "<br/>"; //html的换行
    $prevchar = '';
    $outofquotes = true;
    
    for ($i = 0; $i <= $length; $i++) {
        $char = substr($data, $i, 1);
        if ($char == '"' && $prevchar != '\\') {
            $outofquotes = !$outofquotes;
        } elseif (($char == '}' || $char == ']') && $outofquotes) {
            // $ret.= $newline;
            $pos--;
            
            for ($j = 0; $j < $pos; $j++) {
                $ret.= $indent;
            }
        }
        $ret.= $char;
        if (($char == ',' || $char == '{' || $char == '[') && $outofquotes) {
            $ret.= $newline;
            if ($char == '{' || $char == '[') {
                $pos++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $ret.= $indent;
            }
        }
        $prevchar = $char;
    }
    
    return $ret;
}
/**
 * @param $more  是否显示user信息
 *
 * 但是额外的信息，比如说评论的数量貌似无法显示。
 */
function format($data, $more = true,$extra=array()) {
    $array = array();
    $meta=null;
    if (is_array($data)) {
        
        foreach ($data as $activeRecord) {
            if (isset($activeRecord->user) && ($activeRecord->user instanceof User)) {
                if ($more) {
                    $meta = array_merge($activeRecord->attributes,Yii::app()->userManager->getProfile($activeRecord->user),$extra);
                }
                else{
                    $meta = array_merge($activeRecord->attributes,Yii::app()->userManager->getProfile($activeRecord->user),$extra); 
                }
            
                array_push($array, $meta);
            } else if ($activeRecord instanceof User) {
                array_push($array,Yii::app()->userManager->getProfile($activeRecord));
            } else {
                
                return $data;
            }
        }        
        return $array;
    } else if (isset($data->user) && ($data->user instanceof User)) {
        
        return array_merge($data->attributes, Yii::app()->userManager->getProfile($data->user));
    } else if ($data instanceof User) {
        
        return Yii::app()->userManager->getProfile($data);
    }
    
    return $data;
}
?>