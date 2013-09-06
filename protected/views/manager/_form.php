<?php
/* @var $this ManagerController */
/* @var $model Manager */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manager-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salt'); ?>
		<?php echo $form->textField($model,'salt',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'salt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_super'); ?>
		<?php echo $form->textField($model,'is_super'); ?>
		<?php echo $form->error($model,'is_super'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login_count'); ?>
		<?php echo $form->textField($model,'login_count',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'login_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_login'); ?>
		<?php echo $form->textField($model,'last_login',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'crt_time'); ?>
		<?php echo $form->textField($model,'crt_time',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'crt_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'crt_by'); ?>
		<?php echo $form->textField($model,'crt_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'crt_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'up_time'); ?>
		<?php echo $form->textField($model,'up_time',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'up_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'up_by'); ?>
		<?php echo $form->textField($model,'up_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'up_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->