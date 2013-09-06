<?php
/* @var $this ResidentController */
/* @var $model Resident */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resident-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'household_id'); ?>
		<?php echo $form->textField($model,'household_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'household_id'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'rel_with_householder'); ?>
		<?php echo $form->textField($model,'rel_with_householder',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rel_with_householder'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->