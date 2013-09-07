<?php
/* @var $this ResidentController */
/* @var $model Resident */

$this->breadcrumbs=array(
	'居民'=>array('index'),
	'添加居民',
);
?>

<h1>添加居民</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>