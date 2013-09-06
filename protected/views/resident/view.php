<?php
/* @var $this ResidentController */
/* @var $model Resident */

$this->breadcrumbs=array(
	'居民'=>array('index'),
	$model->name,
);
?>

<h1>查看居民信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'household_id'=>array('label'=>'住房','value'=>$model->hh->building->name . ' ' . $model->hh->entrance . ' 单元 ' . $model->hh->floor . ' 层 #' . $model->hh->number),
		'name',
		'sex'=>array('name'=>'sex','value'=>Lookup::item('sex', $model->sex)),
		'rel_with_householder',
		'birthday',
		'id_no'=>array('name'=>'id_no','value'=>empty($model->id_no) ? '未知' : $model->id_no),
		'nation'=>array('name'=>'nation','value'=>Lookup::item('nation', $model->sex, '未知')),
		'education'=>array('name'=>'education','value'=>Lookup::item('education', $model->sex, '未知')),
		'phone'=>array('name'=>'phone','value'=>empty($model->phone) ? '未知' : $model->phone),
		'crt_time'=>array('value'=>date('Y-m-d H:i:s', $model->crt_time),'name'=>'crt_time', 'visible'=>$model->crt_time != 0),
		'crt_by'=>array('value'=>$model->crt_by == 0 ? '' : $model->creater->name,'name'=>'crt_by', 'visible'=>$model->crt_by != 0),
		'up_time'=>array('value'=>date('Y-m-d H:i:s', $model->up_time),'name'=>'up_time', 'visible'=>$model->up_time != 0),
		'up_by'=>array('value'=>$model->up_by == 0 ? '' :$model->updater->name,'name'=>'up_by', 'visible'=>$model->up_by != 0),
	),
)); ?>
