<?php
/* @var $this HhController */
/* @var $model Household */

$this->breadcrumbs=array(
	'修改住户信息',
);
?>

<h1>修改住户信息 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_hhform', array('model'=>$model, 'buildings'=>$buildings)); ?>