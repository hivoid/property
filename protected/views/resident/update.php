<?php
/* @var $this ResidentController */
/* @var $model Resident */

$this->breadcrumbs=array(
	'Residents'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Resident', 'url'=>array('index')),
	array('label'=>'Create Resident', 'url'=>array('create')),
	array('label'=>'View Resident', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Resident', 'url'=>array('admin')),
);
?>

<h1>Update Resident <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>