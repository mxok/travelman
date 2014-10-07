<?php

class DefaultController extends Controller {
    public function actionIndex() {
        //删除表中的所有数据

        Yii::app()->db->createCommand()->truncateTable('travel_user_state');
        Yii::app()->db->createCommand()->truncateTable('travel_user_relation');
        Yii::app()->db->createCommand()->truncateTable('travel_plan');
        Yii::app()->db->createCommand()->truncateTable('travel_plan_comment');
        Yii::app()->db->createCommand()->truncateTable('travel_photo');
        Yii::app()->db->createCommand()->truncateTable('travel_photo_comment');
        Yii::app()->db->createCommand()->truncateTable('travel_photo_like');
        Yii::app()->db->createCommand()->truncateTable('YiiSession');
        Yii::app()->db->createCommand()->truncateTable('travel_user');
         //        array_map('unlink', glob($this->savePath . '*'));
        p('file add data is deleted!');
    }
}
