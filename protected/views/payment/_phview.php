<?php
/* @var $this PaymentController */
/* @var $data PaymentRecord */
?>

<div class="view">

	<span style="color:blue;"><?php echo $data->id?></span>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('property_costs')); ?>:</b>
	<?php echo CHtml::encode($data->property_costs); ?>
	&nbsp; &nbsp;
	<br />
	<div style="float:right">
		<div style="padding: 5px 0; font-weight:bold;">
			<?php echo CHtml::encode($data->hh->building->name . ' ' . $data->hh->entrance . ' 单元 ' . $data->hh->floor . ' 层 #' . $data->hh->number); ?>
			&nbsp;
		</div>
		<?php echo CHtml::link('查看详细', array('view', 'id'=>$data->id)); ?>
		&nbsp;
		<?php echo CHtml::encode($data->date); ?>
	</div>
	<div style="clear: both;"></div>
</div>