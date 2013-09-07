<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'缴费',
);
?>

<h1>缴费记录</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
