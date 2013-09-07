<?php
/* @var $this CarportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'车位',
);
?>

<h1>车位</h1>
<i>增加车位操作入口在居民栏目的住户信息页面。</i>
<div style="padding:9px 20px;">
	<form action="<?php echo $this->createUrl('fastview');?>" method="post"><b>车位快捷入口</b>(<i>输入编号</i>)：<input type="text" name="carport-id" value="" /> <input type="submit" value="查看" /></form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
