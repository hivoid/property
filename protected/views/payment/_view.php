<?php
/* @var $this PaymentController */
/* @var $data PaymentRecord */
?>

<div class="view">

	<b>编号:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('household_id')); ?>:</b>
	<?php echo CHtml::encode($data->household_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('public_lighting')); ?>:</b>
	<?php echo CHtml::encode($data->public_lighting); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('heating')); ?>:</b>
	<?php echo CHtml::encode($data->heating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('waste_collection')); ?>:</b>
	<?php echo CHtml::encode($data->waste_collection); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>

</div>