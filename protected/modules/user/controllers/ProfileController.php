<?php
/**
 * 如果不在单独的控制器里面写过滤器，将无法正确的过滤
 */
class ProfileController extends Controller {
    public function filters() {
        return array(
            array('application.filters.SessionCheckFilter'),
        );
    }
    public function actionIndex() {
        $model = $this->loadModel();
        $this->send(0, $model);
        $this->render('index', array(
            'model' => $model
        ));
    }
    public function loadModel() {
        $model = null;
        if ($model == null) {
            if (isset($_POST['User']['userId'])) {
                $model = User::model()->with(array('avatar','extension'))->findByPk($_POST['User']['userId'])->getUser();
            } else {
                $model = User::model()->with(array('avatar','extension'))->findByPk(YII::app()->user->userId)->getUser();
            }
            if ($model === null) {
                throw new CHttpException(404, '您访问的用户不存在');
            }
        }
        
        return $model;
    }
}
?>