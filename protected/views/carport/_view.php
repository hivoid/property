<?php
/* @var $this CarportController */
/* @var $data Carport */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	&nbsp; &nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('household_id')); ?>:</b>
	<?php echo CHtml::encode($data->hh->building->name . ' ' . $data->hh->entrance . ' 单元 ' . $data->hh->floor . ' 层 #' . $data->hh->number); ?>
	&nbsp; &nbsp;
	<?php echo CHtml::link('查看', array('view', 'id'=>$data->id)); ?>
	|
	<?php echo CHtml::link('删除', array('delete', 'id'=>$data->id), array('onclick'=>'javascript:return confirm("删除操作不可恢复，是否继续执行?");')); ?>
</div>