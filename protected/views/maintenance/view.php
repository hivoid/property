<?php
/* @var $this MaintenanceController */
/* @var $model MaintenanceRecord */

$this->breadcrumbs=array(
	'维修记录'=>array('index'),
	'查看',
);

$this->menu[] = array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id));
$this->menu[] = array('label'=>'删除', 'url'=>array('delete', 'id'=>$model->id),'linkOptions'=>array('onclick'=>'javascript:return confirm("删除操作不可恢复，是否继续执行?");'));
?>

<h1>查看维修记录信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'date',
		'technician',
		'project',
		'description',
		'amount'=>array('name'=>'amount','value'=>'￥ ' . $model->amount.' 元'),
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
