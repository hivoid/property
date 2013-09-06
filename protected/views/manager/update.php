<?php
/* @var $this ManagerController */
/* @var $model Manager */

$this->breadcrumbs=array(
	'管理员'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'修改',
);
?>

<h1>信息修改 <?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manager-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<p>用户名：<?php echo CHtml::encode($model->username); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->