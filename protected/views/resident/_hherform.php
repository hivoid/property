<?php
/* @var $this HhController */
/* @var $hh Household */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'household-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($hh,'building_id',array('label'=>'所在单元楼')); ?>
		<?php echo $form->dropDownList($hh,'building_id',$buildings); ?>
		<?php echo $form->error($hh,'building_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'entrance'); ?>
		<?php echo $form->textField($hh,'entrance', array('size'=>4)); ?> (仅填写数字，比如:3单元,填写:3)
		<?php echo $form->error($hh,'entrance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'floor'); ?>
		<?php echo $form->textField($hh,'floor', array('size'=>2)); ?> (填写楼层号，从 1 开始计数)
		<?php echo $form->error($hh,'floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'number'); ?>
		<?php echo $form->textField($hh,'number', array('size'=>2)); ?> (仅填写序号，比如：9层2门,填写:2,而不是:902)
		<?php echo $form->error($hh,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'covered_area'); ?>
		<?php echo $form->textField($hh,'covered_area'); ?> (平方米)
		<?php echo $form->error($hh,'covered_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'has_gas'); ?>
		<?php echo $form->radioButtonList($hh, 'has_gas', array('0'=>'无','1'=>'有'), array('labelOptions'=>array('style'=>'display:inline-block'), 'separator'=>' &nbsp; ')); ?>
		<?php echo $form->error($hh,'has_gas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'is_rent'); ?>
		<?php echo $form->radioButtonList($hh, 'is_rent', array('0'=>'否','1'=>'是'), array('labelOptions'=>array('style'=>'display:inline-block'), 'separator'=>' &nbsp; ')); ?>
		<?php echo $form->error($hh,'is_rent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($hh,'remark'); ?>
		<?php echo $form->textArea($hh,'remark',array('cols'=>80,'rows'=>5)); ?>
		<?php echo $form->error($hh,'remark'); ?>
	</div>

	<br />
	<hr />

	<div class="row">
		<strong>户主信息 (主要联系人):</strong>
	</div>
	<br />

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
		<?php echo CHtml::submitButton('添加'); ?>
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