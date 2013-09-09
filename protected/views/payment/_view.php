<?php
/* @var $this PaymentController */
/* @var $data PaymentRecord */
?>

<div class="view">

	<span style="color:blue;"><?php echo $data->id?></span>
	&nbsp;
<?php if($data->public_lighting > 0):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('public_lighting')); ?>:</b>
	<?php echo CHtml::encode($data->public_lighting); ?>
	&nbsp; &nbsp;
<?php endif;?>
<?php if($data->heating > 0):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('heating')); ?>:</b>
	<?php echo CHtml::encode($data->heating); ?>
	&nbsp; &nbsp;
<?php endif;?>
<?php if($data->waste_collection > 0):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('waste_collection')); ?>:</b>
	<?php echo CHtml::encode($data->waste_collection); ?>
	&nbsp; &nbsp;
<?php endif;?>
<?php if($data->other > 0):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
<?php endif;?>
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