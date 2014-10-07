<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-7
 * Time: 上午11:08
 */

class SameFlightController extends Controller{




    public function   actionFind(){
    if(isset($_POST['flightNumber'])){
        $current= date('Y-m-d');
        $flightNumber=$_POST['flightNumber'];
        $criteria = new CDbCriteria();
        $criteria->join='LEFT JOIN tbl_mry_user ON tbl_mry_plan.userId=tbl_mry_user.userId';
        $criteria->addCondition('flightNumber=:flightNumber');
        $criteria->params=array(':flightNumber'=>$flightNumber);
        $criteria->order='startDate DESC';
        $UserModel=User::model();
        $total=$UserModel->count($criteria);
        $pager=new CPagination($total);
        $pager->pageSize=10;
        $pager->applyLimit($criteria);
        $UserList=$UserModel->findAll($criteria);
        //删除PASSWORD相关的信息
         $dataFormat=    new DataFormat();
        $format=$dataFormat->format($userList,null,null);
        $clientFlash=new ClientFlash();
        if($total>0){
           $clientFlash->pushMobile(0, $format); 
        }
       
      else{

        _echo(3,数据为空);
      }
    }

      






    }

} 