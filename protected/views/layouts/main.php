<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<style type="text/css">
	.operations .active{
		background-color: #F3F3F3;
	}
	</style>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页','url'=>array('//manage'), 'active'=>$this->id == 'manage' && $this->action->id != 'login'),
				array('label'=>'小区信息','url'=>array('//info'), 'active'=>$this->id == 'info'),
				array('label'=>'管理员','url'=>array('//manager'), 'active'=>$this->id == 'manager'),
				array('label'=>'单元楼信息','url'=>array('//building'), 'active'=>$this->id == 'building'),
				array('label'=>'居民','url'=>array('//resident'), 'active'=>$this->id == 'resident'),
				array('label'=>'缴费','url'=>array('//payment'), 'active'=>$this->id == 'payment'),
				array('label'=>'车位','url'=>array('//carport'), 'active'=>$this->id == 'carport'),
				array('label'=>'维修记录','url'=>array('//maintenance'), 'active'=>$this->id == 'maintenance'),
				array('label'=>'登录', 'url'=>array('/manage/login'), 'visible'=>Yii::app()->user->isGuest, 'active'=>$this->id == 'manage' && $this->action->id == 'login'),
				array('label'=>'退出登录 ('.Yii::app()->user->name.')', 'url'=>array('/manage/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> &nbsp;by &nbsp; WuGuangSheng.<br/><br />
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
