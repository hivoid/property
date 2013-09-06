<?php
/* @var $this HhController */
/* @var $model Household */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'household-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<b>单元楼：<?php echo $buildings[$model->building_id];?></b>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'entrance'); ?>
		<?php echo $form->textField($model,'entrance', array('size'=>4)); ?> (仅填写数字，比如:3单元,填写:3)
		<?php echo $form->error($model,'entrance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floor'); ?>
		<?php echo $form->textField($model,'floor', array('size'=>2)); ?> (填写楼层号，从 1 开始计数)
		<?php echo $form->error($model,'floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number', array('size'=>2)); ?> (仅填写序号，比如：9层2门,填写:2,而不是:902)
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'covered_area'); ?>
		<?php echo $form->textField($model,'covered_area'); ?> (平方米)
		<?php echo $form->error($model,'covered_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'has_gas'); ?>
		<?php echo $form->radioButtonList($model, 'has_gas', array('0'=>'无','1'=>'有'), array('labelOptions'=>array('style'=>'display:inline-block'), 'separator'=>' &nbsp; ')); ?>
		<?php echo $form->error($model,'has_gas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_rent'); ?>
		<?php echo $form->radioButtonList($model, 'is_rent', array('0'=>'否','1'=>'是'), array('labelOptions'=>array('style'=>'display:inline-block'), 'separator'=>' &nbsp; ')); ?>
		<?php echo $form->error($model,'is_rent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('cols'=>80,'rows'=>5)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
