<?php

class PlanController extends Controller {
    public function actionDropList() {
        $dataFormat = new DataFormat();
        $currentCity = UserRefreshForm::model()->getCurrentCity();
        $criteria1 = new CDbCriteria();
        $criteria2 = new CDbCriteria();
        $criteria3 = new CDbCriteria();
        $dropListModel = DropList::model();
        $dropListData1 = null;
        $dropListData2 = null;
        $dropListData3 = null;
        $format2 = array();
        $format3 = array();
        $format1 = array();
        if (isset($_POST['DropList']['secenicName']) && !empty($_POST['DropList']['secenicName'])) {
            $secenicName = $_POST['DropList']['secenicName'];
            $criteria1->addSearchCondition(' secenicName', $secenicName);
            $criteria1->addCondition("cityName='{$currentCity}'");
            $dropListData1 = $dropListModel->findAll($criteria1);
            $format1 = $dataFormat->format($dropListData1, null);
            if (count($format1) <= 0) {
                //匹配整个数据库
                $criteria2->addSearchCondition(' secenicName', $secenicName);
                $dropListData2 = $dropListModel->findAll($criteria2);
                //分词
                $scws = new SCWS();
                $scws->sendMobile($secenicName);
                $param1 = $scws->result[0];
                if ($param1 != null) {
                    $criteria3->addCondition("cityName='{$param1}'");
                }
                if (count($scws->result) > 1) {
                    $param2 = $scws->result[1];
                    $criteria3->addSearchCondition(' secenicName', $param2);
                }
                // $total = $dropListModel->count($criteria);
                // $pager = new CPagination($total);
                // $pager->pageSize = 100;
                // $pager->applyLimit($criteria);
                $dropListData3 = $dropListModel->findAll($criteria3);
                $format2 = $dataFormat->format($dropListData2, null);
                $format3 = $dataFormat->format($dropListData3, null);
            }
            $format = array_merge($format1, $format2, $format3);
            //去除重复的ID
            if (count($format) > 0) {
                $this->sendMobile(0, $format);
            } else {
                $this->sendMobile(3, '数据为空');
            }
        } else {
            $this->sendMobile(1, '数据错误');
        }
        $this->render('dropList', array(
            'dropList' => $dropListModel
        ));
    }
}
