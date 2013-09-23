<?php
/* @var $this PaymentController */
/* @var $model PaymentRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'household_id'); ?>
		<?php echo CHtml::textField('householdtext','',array('id'=>'householdText','placeholder'=>'选择住户')),$form->hiddenField($model,'household_id', array('id'=>'household_id'));?>
		<?php echo $form->error($model,'household_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date',array('id'=>'datepicker')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'public_lighting'); ?>
		<?php echo $form->textField($model,'public_lighting'); ?>
		<?php echo $form->error($model,'public_lighting'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'heating'); ?>
		<?php echo $form->textField($model,'heating'); ?>
		<?php echo $form->error($model,'heating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'waste_collection'); ?>
		<?php echo $form->textField($model,'waste_collection'); ?>
		<?php echo $form->error($model,'waste_collection'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_costs'); ?>
		<?php echo $form->textField($model,'property_costs'); ?>
		<?php echo $form->error($model,'property_costs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catv_costs'); ?>
		<?php echo $form->textField($model,'catv_costs'); ?>
		<?php echo $form->error($model,'catv_costs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other'); ?>
		<?php echo $form->textField($model,'other'); ?>
		<?php echo $form->error($model,'other'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('cols'=>60,'rows'=>8)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.multiSelector.js');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.multiSelector.css');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<script type="text/javascript">
jQuery(function($){
	var hdatas = <?php echo CJSON::encode($hdatas);?>;
	var hrelation = <?php echo CJSON::encode($hrelations);?>;
	var hsource = {data:hdatas,relation:hrelation};
	var rkey = $('#household_id').val();if(rkey && hdatas[rkey]){$('#householdText').val(hdatas[rkey].name);}
	$('#householdText').multiSelector({source:hsource,choicemax:1,minlevel:2,selected:function(){return $('#household_id').val();},callback:function(vs,ps){
		if(vs.length == 0){$('#household_id').val('');$('#householdText').val('');}else{$('#household_id').val(vs);$('#householdText').val(ps[vs]);}
	}});

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