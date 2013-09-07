<?php
/* @var $this ResidentController */
/* @var $model Resident */

$this->breadcrumbs=array(
	'居民'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'信息修改',
);
?>

<h1>修改居民信息 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>