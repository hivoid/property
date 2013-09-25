<?php
/* @var $this MaintenanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'维修记录',
);
?>

<h1>维修记录</h1>
<style type="text/css">
.sift{margin: 5px;}
</style>
<div class="sift">
	<form action="#" method="get">
	<?php echo CHtml::hiddenField('r', $_GET['r']);?>
	技术员：<?php echo CHtml::telField('u', $u);?>
	&nbsp;
	维修日期：<?php echo CHtml::telField('dt', $dt, array('id'=>'datepicker'));?>
	<?php echo CHtml::submitButton('查找', array('name'=>''));?>
	&nbsp;
	</form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<script>
jQuery(function($){
	$.datepicker.regional['zh-CN'] = {
		closeText: '关闭',
		prevText: '&#x3C;上月',
		nextText: '下月&#x3E;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		dateFormat: 'yy/mm/dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
	$( "#datepicker" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
});
</script>