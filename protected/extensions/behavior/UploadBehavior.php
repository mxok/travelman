<?php

class UploadBehavior extends CBehavior {
    /** 
     * 
     *   $savePath = dirname(dirname(Yii::app()->BasePath)) . '/uploads/';
    */
	public  $savePath;
    /**
     *  多文件上传。key默认为images
     * @param    CModel  $model
     * @return  null
     */
    public function multiImageUpload($model) {
        $files = array();
        if (isset($_FILES['image'])) {
            $images = CUploadedFile::getInstancesByName('image');
            if (isset($images) && count($images) > 0) {                
                foreach ($images as $image => $pic) {
                    $prefix= YII::app()->user->userId.time().$image .'.';
                    $imageName = $prefix. $pic->extensionName;
                    $pic->saveAs($this->savePath . $imageName);
                    $files['origin'][$image] = $imageName;
                    $files['thumb'][$image] = $this->saveThumb($prefix,$pic->extensionName);
                }
            }
        }
        $model->images = CJSON::encode($files);
    }
    /**
     * 保存缩略图
     * @param  string $filePath 文件所在的路径
     * @param  string $imageName     文件名
     * @return string                缩略图的文件名
     */
    private function saveThumb($imageName,$extensionName) {
  
        $thumb = Yii::app()->thumb;
        $thumb->image = $this->savePath. $imageName.$extensionName;
	
        $size=getimagesize($thumb->image);
        $width=$size[0];
        $height=$size[1];
        $thumb->width = $width/2;
        $thumb->height = $height/2;
        $thumb->mode = 4;
        $thumb->directory = $this->savePath;
        $thumb->defaultName = '_' . $imageName;
        $thumb->createThumb();
        $thumb->save();      
        return $thumb->defaultName.$extensionName;
		
    }
    /**
     *上传多个key不同的文件这里头像解析就要注意了！字段名发生了变化
     * @param        $model
     * @param array  $array  上传表单的attribute
     */
    public function upload($model, $array = array()) {
        $files = array();    
        foreach ($array as $index => $attribute) {
            $attach = CUploadedFile::getInstance($model, $attribute);
			
            if ($attach) {
                if(isset(YII::app()->user->userId)){
                   $prefix= YII::app()->user->userId.time().$index . '.';  
                }
                else{
                   $prefix=md5(microtime()).$index.'.'; 
                }
                $imageName = $prefix. $attach->extensionName;
                $attach->saveAs($this->savePath. $imageName);          
                $thumbName = $this->saveThumb($prefix,$attach->extensionName);  			
                $model->$attribute = CJSON::encode(array(
                    'origin' => $imageName,
                    'thumb' => $thumbName
                ));
            }
        }
    }
    

}
