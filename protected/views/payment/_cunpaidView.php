<?php
/* @var $this PaymentController */
/* @var $data PaymentRecord */
?>

<div class="view">

	<div style="left">
		<div style="padding: 5px 0; font-weight:bold;">
			<?php echo CHtml::encode($data->building->name . ' ' . $data->entrance . ' 单元 ' . $data->floor . ' 层 #' . $data->number); ?>
			&nbsp;
		</div>
		<?php echo CHtml::link('查看缴费信息', array('chistory', 'hid'=>$data->id)); ?>
		<?php echo CHtml::link('查看住户信息', array('//resident/hhview', 'id'=>$data->id)); ?>
	</div>
	<div style="clear: both;"></div>
</div>