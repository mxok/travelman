<?php

class PhotoController extends Controller {
    public function actionList() {
      

    $model=  $this->initParams('Photo','model','list');
    $data=array('model'=>$model);
    if($model->validate()){


            $dataProvider = new CActiveDataProvider($model , array(
                'criteria' => array(
                    'condition' => 'userId=' . $model->userId,
                    'order' => 'photoId DESC',
                ) ,
                'pagination' => array(
                    'pageSize' => 20,
                ) ,
            ));
            $this->page($dataProvider, false);
            $data = array_merge($data, array(
                'dataProvider' => $dataProvider
            ));
        
    }
    else{

        $this->error->capture($model);
    }
        $this->render('list', $data);
    }
}
?>