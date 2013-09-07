<?php
/* @var $this MaintenanceController */
/* @var $model MaintenanceRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maintenance-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date', array('id'=>'datepicker')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'technician'); ?>
		<?php echo $form->textField($model,'technician',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'technician'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project'); ?>
		<?php echo $form->textField($model,'project',array('size'=>50,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'project'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('cols'=>80,'rows'=>8)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?> ￥ (元)
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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