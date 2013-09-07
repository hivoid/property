<?php
/* @var $this PaymentController */
/* @var $model PaymentRecord */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'修改',
);
?>

<h1>修改缴费信息 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'hdatas'=>$hdatas,'hrelations'=>$hrelations)); ?>