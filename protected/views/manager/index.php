<?php
/* @var $this ManagerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'管理员',
);
?>

<h1>管理员</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'viewData'=>array('creaters'=>$creaters)
)); ?>
