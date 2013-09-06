<?php
/* @var $this ResidentController */
/* @var $data Resident */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('household_id')); ?>:</b>
	<?php echo CHtml::encode($data->household_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rel_with_householder')); ?>:</b>
	<?php echo CHtml::encode($data->rel_with_householder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_no')); ?>:</b>
	<?php echo CHtml::encode($data->id_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nation')); ?>:</b>
	<?php echo CHtml::encode($data->nation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
	<?php echo CHtml::encode($data->education); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
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

	*/ ?>

</div>