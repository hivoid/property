<?php
/* @var $this HhController */
/* @var $model Household */

$this->breadcrumbs=array(
	'居民'=>array('index'),
	'添加户主',
);
?>

<h1>添加户主</h1>

<?php $this->renderPartial('_hherform', array('model'=>$model, 'hh'=>$hh, 'buildings'=>$buildings)); ?>