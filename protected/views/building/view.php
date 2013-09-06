<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'单元楼'=>array('index'),
	$model->name,
);

$this->menu[] = array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id));
$this->menu[] = array('label'=>'删除', 'url'=>array('delete', 'id'=>$model->id), 'itemOptions'=>array('onclick'=>'javascript:return confirm("删除操作不可恢复！确认删除？");'));
?>
<h1>单元楼信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'completion_year'=>array('name'=>'completion_year','value'=>$model->completion_year == 0 ? '未知' : $model->completion_year.'年'),
		'stories',
		'house_number',
		'household_count',
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
