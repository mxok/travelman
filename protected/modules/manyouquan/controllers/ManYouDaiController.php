<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-7
 *            
 *
 * 12:06
 */ $plan = $this->initParams('Plan', 'new');
        $uploadsComponent = Yii::createComponent('application.components.UploadsComponent');
        $uploadsComponent->multiImageUpload($plan);
        if ($plan->validate()) {
            if ($plan->save()) {
                $this->redirect(array(
                    'user/plan'
                ));
            }
        }
        $this->render('publish', array(
            'model' => $plan
        ));

class ManYouDaiController extends  Controller{
    public   function  actionPublish(){
      $uploadsComponent = Yii::createComponent('application.components.UploadsComponent');
        $uploadsComponent->multiImageUpload($plan);
        $share=new Share();
        $clientFlash=new ClientFlash();
        if (isset($_POST['Share'])) {
            $share->content=$_POST['Share']['content'];
            $share->location=$_POST['Share']['location'];
           $share->city=$_POST['Share']['city'];
           $share->score=$_POST['Share']['score'];
            $share->createTime=date('Y-m-d H:i:s',time()-8*3600);
            $filesArray=upload($share,array('file1','file2','file3','file4','file5','file6','file7','file8','file9'));
            $share->images=json_encode($filesArray);
            $share->userId=Yii::app()->user->userId;  
            if($share->save()){
                $shareId=Yii::app()->db->getLastInsertID();
                $clientFlash->pushMobile(0, $shareId);
                 $this->redirect(array('index'));
            };
         

        }

   $this->render('publish',array('shareModel'=>$share));

    }
    
   public  function  actionIndex(){
    //   $refreshTime= UserRefreshForm::model()->findByPk(Yii::app()->user->userId)->refreshTime;
       $currentTime=time();
   //   UserRefreshForm::model()->updateByPk(Yii::app()->user->userId, array('refreshTime'=>$currentTime));
       $criteria = new CDbCriteria;
       $mFriends= new MFriends();
       $friendsList= $mFriends->getFriendsList();
       array_push($friendsList,Yii::app()->user->userId );
       $criteria->select='t.*,count(tbl_myr_share_comment.shareId) as count';
       $criteria->join='LEFT JOIN tbl_myr_share_comment ON tbl_myr_share_comment.shareId=t.shareId';
      // $criteria->addCondition('t.createTime>='.$refreshTime);
       $criteria->addInCondition('t.userId' ,$friendsList);
       $criteria->group = 't.shareId';
       $criteria->order='t.shareId DESC';
       $share=Share::model();
       $total=$share->count($criteria);
       $pager=new CPagination($total);
       $pager->pageSize=10;
       $pager->applyLimit($criteria);
       $shareList=$share->findAll($criteria); 
       $dataFormat=new DataFormat();
       $format=array();
       $format=$dataFormat->format($shareList);
         $data=array(
            'shareList'=>$format,
            'pages'=>$pager
        );
            if($total>0){
        $clientFlash=new ClientFlash();
       $clientFlash->pushMobile(0, $format);
      }
      else{
        _echo(3,'data empty');
      }
       $this->render('index',$data);
   }


      public function  actionComment(){
         $comment=new Comment();
           if(isset($_POST['Comment'])){
          $comment->shareId=$_POST['Comment']['shareId'];
          $comment->createTime=time();
          $comment->replyId=$_POST['Comment']['replyId'];
          $comment->content=$_POST['Comment']['content'];
          $comment->userId=Yii::app()->user->userId;
          $clientFlash=new ClientFlash();
          if( $comment->validate()&&$comment->save()){
        $clientFlash->setFlash(0, 'comment', '评论成功');
          }
    else{
        $clientFlash->setFlash(1, 'comment', '评论失败');
    }

       }
  $this->render('comment',array('commentForm'=>$comment));


      }

    public  function actionSuggest(){

    }

    public   function  actionDelete($shareid){

        $comment=Comment::model();
        $comment->deleteByPk($shareid);
        _echo(0,'删除成功');
    }
    
     public function  actionCommentList($shareId){  
       $currentTime=time();
       $criteria = new CDbCriteria;
       $criteria->addCondition('shareId=:shareId');
       $criteria->params=array(':shareId'=>$shareId);
       $criteria->order='t.commentId DESC';
       $comment=  Comment::model();
       $total=$comment->count($criteria);
       $pager=new CPagination($total);
       $pager->pageSize=10;
       $pager->applyLimit($criteria);
       $commentList=$comment->findAll($criteria); 
       $dataFormat=new DataFormat();
       $format=array();
        $clientFlash=new ClientFlash();
       $format=$dataFormat->format($commentList);
          if($total>0){
        $clientFlash=new ClientFlash();
       $clientFlash->pushMobile(0, $format);
      }
      else{
        _echo(3,'数据为空');
      }
     }
}