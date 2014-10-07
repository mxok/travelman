<?php
//如何决定用户发的是哪个guide的ID?
//直接按照景点名来显示就可以了。将来不在同一城市的按照时间来显示。

class PublishController extends Controller {
    public function actionIndex() {
        $photo = new Photo();
        $photo->setScenario('guide');
        if (isset($_POST['Photo'])) {
            $guide = null;
            $photo->attributes = $_POST['Photo'];
            $uploadsComponent = Yii::createComponent('application.components.UploadsComponent');
            $uploadsComponent->multiImageUpload($photo);
            if ($photo->validate()) {
                if ($photo->isNewGuide()) {
                    $guide = new Guide();
                } else {
                    $guide = $photo->isNewGuide();
                }
                $guide->savePhoto($photo);
            }
        }
        $this->render('index', array(
            'model' => $photo
        ));
    }
}
?>