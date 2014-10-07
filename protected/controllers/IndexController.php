<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-6
 * Time: 上午11:20
 */

class IndexController extends Controller {
    public function actionIndex() {







        $this->render('index');
    }
    public function actionUser() {
        $this->render('user');
    }
    public function actionPlan() {
        $this->render('plan');
    }
    public function actionManyouquan() {
        $this->render('manyouquan');
    }
    public function actionGuide() {
        $this->render('guide');
    }
    public function actionPush() {
        $this->render('push');
    }
    public function actionTemp() {
        $this->render('temp');
    }
    public function actionJianren() {
        $this->render('jianren');
    }
    
            public function actionTest(){
                
                phpinfo();
            }
			
			public  function  actionMessage(){				
				$this->render('message');
				
			}
}
