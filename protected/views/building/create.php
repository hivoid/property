<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'单元楼'=>array('index'),
	'添加',
);
?>

<h1>添加单元楼</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>