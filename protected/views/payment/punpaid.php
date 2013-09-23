<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'物业费欠费住户',
);
?>
<h1>物业费欠费住户</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_unpaidView',
)); ?>
