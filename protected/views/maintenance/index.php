<?php
/* @var $this MaintenanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'维修记录',
);
?>

<h1>维修记录</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
