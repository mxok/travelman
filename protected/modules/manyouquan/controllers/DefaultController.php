<?php
/*
  分页重复的问题还未解决。
*/
class DefaultController extends Controller {
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function behaviors() {
        parent::init();
        return array_merge(parent::behaviors() , array(
            'UploadBehavior' => array(
                'class' => 'ext.behavior.UploadBehavior',
                'savePath' => $this->savePath,
            )
        ));
    }
    public function actionPublish() {
        $photo = $this->initParams('Photo', 'new', 'publish');
        $this->multiImageUpload($photo);
        if ($photo->validate() && $photo->save()) {
            $this->send(ERROR_NONE, 'success');
        } else {
            $this->error->capture($photo);
        }
        $this->render('publish', array(
            'model' => $photo
        ));
    }
    //数据可能会存在重复。因为假设用户没有发。还是会返回旧的数据。
    public function actionIndex() {
        $criteria = new CDbCriteria;
        $relationComponent = new RelationComponent();
        $friends = $relationComponent->getfriends();
        $criteria->addInCondition('userId', $friends);
        $criteria->order = 'photoId DESC';
        $dataProvider = new CActiveDataProvider('Photo', array(
            'pagination' => array(
                'pageSize' => 20,
            ) ,
        ));
        $dataProvider->setCriteria($criteria);
        $this->page($dataProvider);
        $this->render('index');
    }
    public function actionComment() {
        // public function actionSuggest() {
        // }
        // public function actionDelete($Photoid) {
        //     $comment = Comment::model();
        //     $comment->deleteByPk($Photoid);
        //     _echo(0, '删除成功');
        // }
        
    }
}
