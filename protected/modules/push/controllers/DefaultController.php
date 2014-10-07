<?php



/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-5-27
 * Time: 下午12:41
 *
 *
 */
Yii::import('application.vendors.jpush.*');
require_once('jpush.php');
class ChatController extends Controller {

    public function actionIndex() {

        $message = new Message();
        $clientFlash = new ClientFlash();
        $relation=new Relation();
        $blckList=$relation->getBlacks();
        if (isset($_POST['Message'])) {
            $message->attributes=$_POST['Message'];
            $message->avatar = Yii::app()->user->avatar;
            $filesUrl=$this->upload($message, 'file');
            if(!empty($filesUrl)){
                $message->file = $filesUrl;
            }

            $message->chat();

            $this->render('index', array('message' => $message));
        }
    }


    // public function actionSendAll() {
    //     $jPush = new JPush();
    //     $message = new Message();
    //     if (isset($_POST['Message'])) {
    //         $message->attributes = $_POST['Message'];
    //         $jPush->sendAll($message->userid, null, $message->content, null);
    //     }
    //     $this->renderPartial('sendSingle');
    // }

    // private function upload($model, $attribute) {

    //     $filesUrl = array();
    //     $attach = CUploadedFile::getInstance($model, $attribute);
    //     if ($attach) {
    //         $type = $attach->extensionName;
    //         $filesUrl['type'] = $type;
    //         $preRand = md5(time() . mt_rand(0, 999999)) . '.';
    //         $imageName = $preRand . $type;
    //         $filesUrl['original'] = $imageName;
    //         $attach->saveAs('uploads/' . $imageName);
    //         $path = dirname(Yii::app()->BasePath) . '/uploads/';
    //         if ($type != 'amr') {
    //             $thumb = Yii::app()->thumb;
    //             $thumb->image = $path . $imageName;
    //             $thumb->width = 130;
    //             $thumb->height = 95;
    //             $thumb->mode = 4;
    //             $thumb->directory = $path;
    //             $thumb->defaultName = 's' . $preRand;
    //             $thumb->createThumb();
    //             $thumb->save();
    //             $filesUrl['thumb'] = $thumb->defaultName . $attach->extensionName;
    //         }
    //     }
    //     return $filesUrl;
    // }