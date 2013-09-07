<?php
/* @var $this CarportController */
/* @var $model Carport */

$this->breadcrumbs=array(
	'车位'=>array('index'),
	'修改',
);
?>

<h1>修改车位信息 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>