<?php
$this->breadcrumbs=array(
	'小区信息'
);
?>

<h1>小区基本信息管理</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'basic-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo CHtml::textField('location','',array('id'=>'regionText','placeholder'=>'选择小区所在地区')),$form->hiddenField($model,'region', array('id'=>'region'));?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_class'); ?>
		<?php echo $form->dropDownList($model,'property_class',array(''=>' - 请选择 - ') + BasicInfo::propertyClasses()); ?>
		<?php echo $form->error($model,'property_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'developers'); ?>
		<?php echo $form->textField($model,'developers',array('size'=>50,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'developers'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建信息' : '修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.region.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.multiSelector.js');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.multiSelector.css');
?>
<script type="text/javascript">
$(function(){
	var rkey = $('#region').val();if(rkey && $.region.data[rkey]){$('#regionText').val($.region.data[rkey].name);}
	$('#regionText').multiSelector({source:$.region,choicemax:1,selected:function(){return $('#region').val();},callback:function(vs,ps){
		if(vs.length == 0){$('#region').val('');$('#regionText').val('');}else{$('#region').val(vs);$('#regionText').val(ps[vs]);}
	}});
});
</script>
