<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'缴费',
);
?>
<style type="text/css">
.sift{margin: 5px;}
.sift a{
display: inline-block;
text-decoration: none;
margin: 6px 10px 6px 0px;
padding: 2px 6px 2px 6px;
color: #00527f;
background-color: #d9e8f3;
border: 1px solid #9ce;
cursor: pointer;
}
.sift span{
font-weight: bold;
color: #930;
}
</style>
<h1>缴费记录</h1>
<div class="sift">
	<form action="#" method="get">
	<?php echo CHtml::hiddenField('r', $_GET['r']);?>
	类目：<?php echo CHtml::dropDownList('s', $s, array(''=>' - 全部 - ') + $this->costs);?>
	&nbsp;
	缴费日期：<?php echo CHtml::dropDownList('dt', $dt, array(''=>' - 全部 - ') + $this->sdays);?>
	<?php echo CHtml::submitButton('筛选', array('name'=>''));?>
	&nbsp;
	<span>快捷：</span>
	<a href="<?php echo $this->createUrl('parr');?>">物业费欠费住户</a>
	<a href="<?php echo $this->createUrl('carr');?>">有线电视欠费住户</a>
	</form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
