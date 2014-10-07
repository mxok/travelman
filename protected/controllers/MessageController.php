<?php

class MessageController extends Controller {
    /**
     *  每次登录的时候调用一下这个接口。
     *  每次刷新主界面的时候调用一下这个接口
     *
     * 但是有更新用户却没有查看的话，那么消息就提醒不了。因此客户端要发送一个标志位，用来判断是否已读
     *
     */
    public function filters() {
        
        return array(
            array(
                'application.filters.SessionCheckFilter'
            ) ,
        );
    }
    public function actionIndex() {
        $status = UserStatus::model()->findByPk(Yii::app()->user->userId);
        $refreshTime = $status->refreshTime;
        $result = Plan::model()->findAllByAttributes(array(
            'userId' => Yii::app()->user->userId
        ));
        $primaryKeys = array();
        
        foreach ($result as $value) {
            array_push($primaryKeys, $value->primaryKey);
        }
        $criteria = new CDbCriteria();
        $criteria->addInCondition('planId', $primaryKeys);
        $criteria->addCondition('createTime>=' . $refreshTime);
        $inbox = PlanComment::model()->findAll($criteria);
        $count = count($inbox);
        if ($count > 0) {
            $this->send(ERROR_NONE, $inbox, false, array(
                'count' => $count
            ) , false);
        }
        //传递一个已读未读的标志位
        if (isset($_POST['read'])) {
            $status->refreshTime = time();
            $status->save();
        }
		$this->render('index');
    }
	
}
?>