<?php
/* @var $this ResidentController */
/* @var $model Resident */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resident-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<b><?php echo $model->hh->building->name . ' ' . $model->hh->entrance . ' 单元 ' . $model->hh->floor . ' 层 #' . $model->hh->number;?></b>
<?php if ($model->hh->householder == $model->id):?>
		&nbsp; <span style="font-weight:bold;color:#925;">[房主]</span>
<?php endif;?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model, 'sex', array('' => ' - 请选择 - ') + Lookup::items('sex')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
<?php if ($model->hh->householder != $model->id):?>
	<div class="row">
		<?php echo $form->labelEx($model,'rel_with_householder'); ?>
		<?php echo $form->textField($model,'rel_with_householder',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rel_with_householder'); ?>
	</div>
<?php endif;?>
	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday', array('id'=>'datepicker')); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_no'); ?>
		<?php echo $form->textField($model,'id_no',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'id_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nation'); ?>
		<?php echo $form->dropDownList($model, 'nation', array('' => ' - 请选择 - ') + Lookup::items('nation')); ?>
		<?php echo $form->error($model,'nation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'education'); ?>
		<?php echo $form->dropDownList($model, 'education', array('' => ' - 请选择 - ') + Lookup::items('education')); ?>
		<?php echo $form->error($model,'education'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
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
	$( "#datepicker" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true,defaultDate:'1990-01-01',yearRange:'1900:2013'});
});
</script>