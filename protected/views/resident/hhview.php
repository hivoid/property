<?php
/* @var $this HhController */
/* @var $model Household */

$this->breadcrumbs=array(
	'居民'=>array('index'),
	'住户信息',
);

$this->menu[] = array('label'=>'修改住户信息', 'url'=>array('hhupdate', 'id'=>$model->id));
?>

<h1>查看住户信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'building_id'=>array('label'=>'所在单元楼', 'value'=>$model->building->name),
		'entrance',
		'floor',
		'number',
		'covered_area'=>array('name'=>'covered_area','value'=>$model->covered_area . ' (平方米)'),
		'has_gas'=>array('name'=>'has_gas','value'=>$model->has_gas == 1 ? '有' : '无'),
		'size'=>array('name'=>'size','value'=>$model->size.' 人'),
		'householder'=>array('name'=>'householder','value'=>CHtml::link($model->hder->name, $this->createUrl('view', array('id'=>$model->householder))), 'type'=>'html'),
		'is_rent'=>array('name'=>'is_rent','value'=>$model->is_rent == 1 ? '是' : '否'),
		'remark',
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
