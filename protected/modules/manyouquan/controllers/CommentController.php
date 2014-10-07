<?php

class CommentController extends Controller {
    public function actionIndex() {
        $comment = $this->initParams('PhotoComment', 'new');
        if ($comment->validate() && $comment->save()) {
            $this->send(ERROR_NONE, 'success');
        }
        $this->render('index', array(
            'commentForm' => $comment
        ));
    }
    public function actionList() {
          $model=$this->initParams('Photo','model','detail');
           $data = array(
            'model' =>$model
        );
          if($model->validate()){
          	$dataProvider = new CActiveDataProvider('PhotoComment', array(
                'criteria' => array(
                    'condition' => 'photoId=' . $model->photoId,
                    'order' => 'commentId DESC',
                    'with' => array(
                        'user'
                    )
                ) ,
                'pagination' => array(
                    'pageSize' => 20,
                ) ,
            ));
            $this->page($dataProvider);
            $data = array_merge($data, array(
                'dataProvider' => $dataProvider
            ));
          }
          else{
          	$this->error->capture($model);
          }
            $this->render('list',$data);
        }

    }
?>