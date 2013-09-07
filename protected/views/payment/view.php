<?php
/* @var $this PaymentController */
/* @var $model PaymentRecord */

$this->breadcrumbs=array(
	'缴费'=>array('index'),
	'查看',
);
?>

<h1>查看缴费详细 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'household_id'=>array('name'=>'household_id','value'=>$model->hh->building->name . ' ' . $model->hh->entrance . ' 单元 ' . $model->hh->floor . ' 层 #' . $model->hh->number),
		'date',
		'public_lighting',
		'heating',
		'waste_collection',
		'other',
		'remark',
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),

	),
)); ?>
