<?php
/* @var $this ResidentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'居民',
);
?>

<h1>居民</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
