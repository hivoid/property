<?php
/* @var $this MaintenanceController */
/* @var $model MaintenanceRecord */

$this->breadcrumbs=array(
	'维修记录'=>array('index'),
	'添加',
);
?>

<h1>添加记录</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>