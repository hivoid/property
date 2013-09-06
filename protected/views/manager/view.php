<?php
/* @var $this ManagerController */
/* @var $model Manager */

$this->breadcrumbs=array(
	'管理员'=>array('index'),
	$model->name,
);

$this->menu[] = array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id), 'visible'=>Yii::app()->user->isSuper);
$this->menu[] = array('label'=>'重设密码', 'url'=>array('password', 'id'=>$model->id), 'visible'=>Yii::app()->user->isSuper);
?>

<h1>管理员信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'username',
		'is_super'=>array('value'=>$model->is_super == 1 ? '是' : '否','label'=>'超级管理员'),
		'login_count',
		'last_login'=>array('value'=>date('Y-m-d H:i:s', $model->last_login),'name'=>'last_login', 'visible'=>$model->last_login != 0),
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
