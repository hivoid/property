<?php
/* @var $this PaymentController */
/* @var $model PaymentRecord */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'添加',
);
?>

<h1>添加缴费记录</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'hdatas'=>$hdatas,'hrelations'=>$hrelations)); ?>