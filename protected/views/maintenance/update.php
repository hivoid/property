<?php
/* @var $this MaintenanceController */
/* @var $model MaintenanceRecord */

$this->breadcrumbs=array(
	'维修记录'=>array('index'),
	'修改',
);
?>

<h1>修改记录信息 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>