<?php
/* @var $this BuildingController */
/* @var $data Building */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('completion_year')); ?>:</b>
	<?php echo CHtml::encode($data->completion_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stories')); ?>:</b>
	<?php echo CHtml::encode($data->stories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('house_number')); ?>:</b>
	<?php echo CHtml::encode($data->house_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('household_count')); ?>:</b>
	<?php echo CHtml::encode($data->household_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_by')); ?>:</b>
	<?php echo CHtml::encode($data->crt_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_time')); ?>:</b>
	<?php echo CHtml::encode($data->crt_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('up_by')); ?>:</b>
	<?php echo CHtml::encode($data->up_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('up_time')); ?>:</b>
	<?php echo CHtml::encode($data->up_time); ?>
	<br />

</div>