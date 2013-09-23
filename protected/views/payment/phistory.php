<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'物业费欠费住户'=>array('parr'),
	CHtml::encode($model->building->name . ' ' . $model->entrance . ' 单元 ' . $model->floor . ' 层 #' . $model->number)
);
?>
<h1><?php echo CHtml::encode($model->building->name . ' ' . $model->entrance . ' 单元 ' . $model->floor . ' 层 #' . $model->number); ?> 物业费缴费记录</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_phview',
)); ?>
