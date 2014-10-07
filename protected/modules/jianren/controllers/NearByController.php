<?php

class NearByController extends Controller
{

    
    public function  actionIndex()
    {   
        $searchForm=new SearchForm();
        $gender=null;
        $residenceFlag=null;
        $location=null;
        $latitude=  UserRefreshForm::model()->getLatitude();
        $longitude=UserRefreshForm::model()->getLongitude();
        $criteria=new CDbCriteria();
         if(isset($_POST['SearchForm'])){
       $gender=$_POST['SearchForm']['gender'];
       $residenceFlag=$_POST['SearchForm']['residence'];
       }
        $nearPersons=MGetNear::getNearPersonsNoOrder();
        $criteria->select=' t.*,tbl_myr_refresh.status as status,(ACOS(SIN(('.$latitude.'* 3.1415) / 180 ) *SIN((tbl_myr_refresh.latitude * 3.1415) / 180 ) +COS(('.$latitude.'* 3.1415) / 180 ) * COS((tbl_myr_refresh.latitude * 3.1415) / 180 ) *COS(('.$longitude .'* 3.1415) / 180 - (tbl_myr_refresh.longitude * 3.1415) / 180 ) ) * 6378.137)   as distance';
        $criteria->join='LEFT JOIN tbl_myr_refresh ON tbl_myr_refresh.userId=t.userId';
        $criteria->addInCondition('t.userId',$nearPersons);
        if($gender!=null){
        $criteria->addCondition("gender={$gender}");
        }
       
        if($residenceFlag!=null){
               $currentCity = UserRefreshForm::model()->getCurrentCity();
               $residence=Yii::app()->user->residence;
            switch ($residenceFlag) {
                case 0:
                
                $criteria->addCondition("t.residence='{$currentCity}'");

                    break;
                case 1:
                $criteria->addCondition("t.residence!='{$currentCity}'");
                    break;
                default:
                    break;
            }
           
        }
        $criteria->order='distance ASC';
        $UserModel=User::model();
        $total=$UserModel->count($criteria);
        $pager=new CPagination($total);
        $pager->pageSize=10;
        $pager->applyLimit($criteria);
        $userList=$UserModel->findAll($criteria);
        $dataFormat=    new DataFormat();
        $format=$dataFormat->format($userList,null,'distance','status');

        $data=array(
            'userList'=>$format,
            'pages'=>$pager,
            'searchForm'=>$searchForm,
        );
        $clientFlash=new clientFlash();
        if($total>0){
            $clientFlash->pushMobile(0, $format);
        }
      else{

        $clientFlash->pushMobile(3, '数据为空');
      }
       $this->render('index',$data);

    }
    


}