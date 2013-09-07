<?php
/* @var $this CarportController */
/* @var $model Carport */

$this->breadcrumbs=array(
	'车位'=>array('index'),
	'添加新车位',
);
?>

<h1>添加新车位</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>