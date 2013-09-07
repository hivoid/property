<?php
/* @var $this HhController */
/* @var $data Household */
?>

<div class="view">
	<div style="padding: 5px 0; border-bottom:1px solid #ccc;margin-bottom: 6px;">
	<a style="color:#000;" href="<?php echo $this->createUrl('hhview', array('id'=>$data->id)); ?>"><b><?php echo CHtml::encode($data->building->name); ?> &nbsp;<?php echo CHtml::encode($data->entrance); ?> 单元 &nbsp;<?php echo CHtml::encode($data->floor); ?> 层 &nbsp;#<?php echo CHtml::encode($data->number); ?></b></a> 
	<a href="<?php echo $this->createUrl('view', array('id'=>$data->householder)); ?>" style="color:#36f;font-weight:bold;display:inline-block;padding-left:20px;"><?php echo CHtml::encode($data->hder->name); ?></a>
	</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?> 人
	<a href="<?php echo $this->createUrl('list', array('hid'=>$data->id));?>">查看</a>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_rent')); ?>:</b>
	<?php echo CHtml::encode($data->is_rent == 1 ? '是' : '否'); ?>
	<br />
	<div style="padding: 5px;">
		<a href="<?php echo $this->createUrl('hhview', array('id'=>$data->id)); ?>">查看详细</a>
		|
		<a href="<?php echo $this->createUrl('view', array('id'=>$data->householder)); ?>">查看户主信息</a>
		|
		<a href="<?php echo $this->createUrl('hhupdate', array('id'=>$data->id)); ?>">修改</a>
		|
		<a href="<?php echo $this->createUrl('add', array('hid'=>$data->id)); ?>">添加其他居住人口</a>
		|
		<a href="<?php echo $this->createUrl('//carport/create', array('hid'=>$data->id)); ?>">添加车位</a>
	</div>
</div>