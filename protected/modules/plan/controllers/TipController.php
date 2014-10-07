<?php

class TipController extends Controller {
    public function actionIndex() {
        $dropList = $this->initParams('DropList');
        if (isset($_POST['DropList'])) {
            if ($dropList->validate()) {
                $this->send(0, $dropList->getDropList());
            }
        }
        $this->render('index', array(
            'dropList' => $dropList
        ));
    }
}
