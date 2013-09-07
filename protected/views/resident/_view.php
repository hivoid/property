<?php
/* @var $this ResidentController */
/* @var $data Resident */
?>

<div class="view">

	<div style="padding-bottom: 10px;">
		<b><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></b> (<?php echo Lookup::item('sex', $data->sex); ?>)
	</div>
	<b>住房:</b>
	<a href="<?php echo $this->createUrl('hhview', array('id'=>$data->household_id));?>">
	<?php echo CHtml::encode($data->hh->building->name . ' ' . $data->hh->entrance . ' 单元 ' . $data->hh->floor . ' 层 #' . $data->hh->number); ?>
	</a>
	&nbsp; | &nbsp;
	<b>年龄:</b>
	<?php echo date('Y') - date('Y', strtotime($data->birthday)); ?>
<?php if($data->phone):?>
	&nbsp; | &nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />
<?php endif;?>
</div>