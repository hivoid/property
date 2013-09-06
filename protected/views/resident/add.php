<?php
/* @var $this ResidentController */
/* @var $model Resident */

$this->breadcrumbs=array(
	'Residents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Resident', 'url'=>array('index')),
	array('label'=>'Manage Resident', 'url'=>array('admin')),
);
?>

<h1>Create Resident</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>