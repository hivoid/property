<?php
/* @var $this MaintenanceController */
/* @var $data MaintenanceRecord */
?>

<div class="view">

	<div style="float: left;">
	<b><?php echo CHtml::link(CHtml::encode($data->project), array('view', 'id'=>$data->id)); ?></b>
	&nbsp;
	<span>( <?php echo CHtml::encode($data->technician); ?> )</span>
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />
	</div>

	<div style="float: right">
	<?php echo CHtml::encode($data->date); ?>
	</div>

	<div style="clear: both;"></div>
</div>