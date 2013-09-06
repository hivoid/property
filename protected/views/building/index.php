<?php
/* @var $this BuildingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'单元楼',
);
?>

<h1>单元楼管理</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
