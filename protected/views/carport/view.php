<?php
/* @var $this CarportController */
/* @var $model Carport */

$this->breadcrumbs=array(
	'车位'=>array('index'),
	'查看',
);
?>

<h1>查看车位信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'household_id'=>array('name'=>'household_id','value'=>$model->hh->building->name . ' ' . $model->hh->entrance . ' 单元 ' . $model->hh->floor . ' 层 #' . $model->hh->number),
		'description',
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
<div style="text-align:center;padding: 15px 0;">
	<?php echo CHtml::link('修改', array('update', 'id'=>$model->id)); ?>
	|
	<?php echo CHtml::link('删除', array('delete', 'id'=>$model->id), array('onclick'=>'javascript:return confirm("删除操作不可恢复，是否继续执行?");')); ?>
</div>