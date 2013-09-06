<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'单元楼'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'信息修改',
);
?>

<h1>信息修改 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>