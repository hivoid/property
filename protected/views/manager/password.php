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
		<strong><?php echo CHtml::encode($model->name); ?></strong>
	</div>

	<div class="row">
		<p>用户名：<?php echo CHtml::encode($model->username); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valiPassword'); ?>
		<?php echo $form->passwordField($model,'valiPassword',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'valiPassword'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('重设'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
if($message):
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<div style="width:auto;border:solid 1px #CFF; background-color:#EFF; padding: 10px; color: #339; font-weight: bold;" id="message">
<?php echo $message;?>
</div>
<script type="text/javascript">
$('#message').delay(3000).slideUp();
</script>
<?php endif;?>