<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
    <?php Yii::app()->bootstrap->register(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/s.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet " type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/assets/css/public.css"/>
    <script type="text/javascript" src='<?php echo Yii::app()->request->baseUrl; ?>/js/c.js'></script>
    <script type="text/javascript" src='<?php echo Yii::app()->request->baseUrl; ?>/js/m.js'></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'临时模块', 'url'=>array('/index/temp')),
				array('label'=>'参数与重要说明', 'url'=>array('/index/index')),
				array('label'=>'计划模块', 'url'=>array('/index/plan', 'view'=>'about')),
				array('label'=>'用户模块', 'url'=>array('/index/user')),
				array('label'=>'漫游圈模块', 'url'=>array('/index/manyouquan')),
				array('label'=>'攻略模块','url'=>array('/index/guide')),
				array('label'=>'推送模块','url'=>array('/index/push')),
				array('label'=>'捡人模块','url'=>array('/index/jianren')),
				array('label'=>'后台管理模块(慎用)','url'=>array('/backend/')),
				array('label'=>'消息提醒模块','url'=>array('/message/')),
				array('label'=>'登录', 'url'=>array('/user/default/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'退出登录 ('.Yii::app()->user->name.')', 'url'=>array('/user/default/logout'),'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<?php echo $content; ?>
               <div class="clear">
                    <?php
                     if(!isset(Yii::app()->user->userId)){
       ?>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;如果您还没有注册，点击这里<a href='<?php  echo $this->createUrl('default/registration') ?>'>注册</a><br/><?php }?>    
                </div>
         
	<div id="footer">
		   <?php  echo $this->jsonText;?>
	</div>


</body>
</html>
