<?php
/* @var $this BuildingController */
/* @var $data Building */
?>

<div class="view">

	<strong><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></strong>
	 &nbsp;&nbsp; &gt;&gt;
	<span><a href="<?php echo $this->createUrl('view', array('id'=>$data->id));?>">查看</a></span>
	|
	<span><a href="<?php echo $this->createUrl('update', array('id'=>$data->id));?>">修改</a></span>
	|
	<span><a onclick="javascript:return confirm('删除不可恢复！ 确认删除？');" href="<?php echo $this->createUrl('delete', array('id'=>$data->id));?>">删除</a></span>
	<br /><br />

	<p>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	&nbsp; | &nbsp; 
	<b><?php echo CHtml::encode($data->getAttributeLabel('completion_year')); ?>:</b>
	<?php echo CHtml::encode($data->completion_year == 0 ? '未知' : $data->completion_year . '年'); ?>
	&nbsp; | &nbsp; 
	<b><?php echo CHtml::encode($data->getAttributeLabel('stories')); ?>:</b>
	<?php echo CHtml::encode($data->stories); ?>
	&nbsp; | &nbsp; 
	<b><?php echo CHtml::encode($data->getAttributeLabel('house_number')); ?>:</b>
	<?php echo CHtml::encode($data->house_number); ?>
	&nbsp; | &nbsp; 
	<b><?php echo CHtml::encode($data->getAttributeLabel('household_count')); ?>:</b>
	<?php echo CHtml::encode($data->household_count); ?>
	</p>
<?php if($data->crt_by):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_by')); ?>:</b>
	<?php echo CHtml::encode($users[$data->crt_by]->name); ?>
<?php endif;?>
<?php if($data->crt_time):?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_time')); ?>:</b>
	<?php echo date('Y-m-d H:i', $data->crt_time); ?>
	<br />
<?php endif;?>
<?php if($data->up_by):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('up_by')); ?>:</b>
	<?php echo CHtml::encode($users[$data->up_by]->name); ?>
<?php endif;?>
<?php if($data->up_time):?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('up_time')); ?>:</b>
	<?php echo date('Y-m-d H:i', $data->up_time); ?>
	<br />
<?php endif;?>
</div>