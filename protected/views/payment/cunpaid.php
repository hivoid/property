<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'有线电视欠费住户',
);
?>
<h1>有线电视欠费住户</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_cunpaidView',
)); ?>
