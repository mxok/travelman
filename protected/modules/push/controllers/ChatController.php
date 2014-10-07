<?php //
///**
// * Created by PhpStorm.
// * User: Administrator
// * Date: 14-9-7
// * Time: 下午3:20
// */
//

class ChatController extends Controller {
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        //未提示客户端
        $platform='android';
        if(isset($_GET['p'])){
              $platform=$_GET['p'];	
        }
  
        	
        $message = new Message();
        $relation = new Relation();
        if (isset($_POST['Message'])) {
        	$message->attributes = $_POST['Message'];	
        	if($message->validate()){        	
        	  $message->file = $this->upload($message);

                if(UserStatus::model()->findByPk($message->receiver)->type==0){
                    $message->chat('android');
                }
               else{
                   $message->chat('ios');
               }
			
        	}
          
        }
        $this->render('index', array(
            'message' => $message
        ));
    }
    private function upload($model, $attribute = 'file') {
        $file = array();
        $attach = CUploadedFile::getInstance($model, $attribute);
        if ($attach) {
            $type = $attach->extensionName;
            $file['type'] = $type;
            $preRand = $model->receiver . time() . '.';
            $imageName = $preRand . $type;
            $file['origin'] = $imageName;
            $attach->saveAs($this->savePath . $imageName);
            if (($type!='amr')||($type != 'caf')) {
                $thumb = Yii::app()->thumb;
                $thumb->image = $this->savePath.$imageName;
                $size = getimagesize($thumb->image);
                $width = $size[0];
                $height = $size[1];
                $thumb->width = $width / 2;
                $thumb->height = $height / 2;
                $thumb->mode = 4;
                $thumb->directory = $this->savePath;
                $thumb->defaultName = '_' . $preRand;
                $thumb->createThumb();
                $thumb->save();
                $file['thumb'] = $thumb->defaultName . $attach->extensionName;
            }
            return $file;
        } else {            
            return null;
        }
    }
}
