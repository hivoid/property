<?php
/* @var $this CarportController */
/* @var $model Carport */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carport-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php if($model->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>
<?php endif;?>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('cols'=>80,'rows'=>6)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->