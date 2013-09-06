<?php
/* @var $this HhController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'居民',
);
?>

<h1>住户</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_hhview',
)); ?>
