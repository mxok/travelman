<?php
  /**
   * 
   * 版本控制实际上是在后台管理系统完成的.这里稍稍有一点逻辑问题。
   * 要得到数据库所有数据。怎么办？主键无法更改！
   * 
   * 
   */ 
class   VersionController  extends   Controller{
	  public  function  actionIndex(){
	  $model=new Version();
	  if(isset($_POST['Version'])){

	    	 $model->setAttributes($_POST['Version'], false); 
 			
	     if($model->save()) {
	     	 echo '成功';
	     }
	
	  
	}
 else{

	  	$data=	$model->findAll(null);  		
        $this->send(ERROR_NONE,$data[0]);
	   }
	 
	$this->render('index',array('model'=>$model));
   }
   
   
}
?>