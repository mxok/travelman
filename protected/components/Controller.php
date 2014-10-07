<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends CController {
    public $layout = '//layouts/column1';
    public $menu = array();
    public $breadcrumbs = array();
    public $error;
    public $jsonText;
    public $savePath;
    public function behaviors() {
        return array(
            'json' => array(
                'class' => 'ext.behavior.JsonBehavior'
            ) ,
            'upload' => array(
                'class' => 'ext.behavior.UploadBehavior',
                'savePath' =>dirname(dirname(dirname(dirname(__FILE__)))) . '/uploads/'
            )
        );
    }
    protected function beforeAction(CAction $action) {
        $this->error = new ErrorCapture();
        
        return true;
    }
    public function initParams($className = '', $type = 'model', $scenario = null) {
        $model = null;
        if (trim($type) == 'model') {
            //在本地 $model=$className::model();就可以这是为什么？eval函数必须return
            $model = eval('return  ' . $className . '::model();');
        } else {
            $model = new $className();
        }
        if ($scenario != null) {
            $model->setScenario($scenario);
        }
        if (isset($_POST[get_class($model) ])) {
            $model->attributes = $_POST[get_class($model) ];
        }
        
        return $model;
    }
    /**
     * 手机客户端的分页，防止分页重复，与网页显示无关
     * @param  CActiveDataProvider $dataProvider
     *
     */
    public function page(CActiveDataProvider & $dataProvider, $more = true) {
        $total = $dataProvider->getTotalItemCount();
        $pageSzie = $dataProvider->getPagination()->getPageSize();
        $dataProvider->getPagination()->pageVar = 'page';
        $pageCount = ceil($total / $pageSzie);
        if ($dataProvider->getTotalItemCount() == 0) {
            $this->send(ERROR_EMPTY, 'data empty', $more);
        } else if (isset($_GET['page'])) {
            if (($pageCount) >= $_GET['page']) {
                $this->send(0, $dataProvider->getData() , $more, array(
                    'page' => $pageCount
                ));
            }
        } else {
            $this->send(ERROR_NONE, $dataProvider->getData() , $more, array(
                'page' => $pageCount
            ));
        }
    }
}
