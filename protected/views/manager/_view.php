<?php
/* @var $this ManagerController */
/* @var $data Manager */
?>

<div class="view">

	<strong><?php echo CHtml::encode($data->name); ?></strong>
<?php if($data->is_super == 1):?>
	<span style="color:red">[超级管理员]</span>
<?php else:?>
	<span style="color:blue">[普通管理员]</span>
<?php endif;?>
	&nbsp;&nbsp;
	<span><a href="<?php echo $this->createUrl('view', array('id'=>$data->id));?>">查看</a></span>
<?php if(Yii::app()->user->isSuper):?>
<?php if(!$data->is_super):?>
	|
	<span><a href="<?php echo $this->createUrl('update', array('id'=>$data->id));?>">修改</a></span>
	|
	<span><a onclick="javascript:return confirm('删除不可恢复！ 确认删除？');" href="<?php echo $this->createUrl('delete', array('id'=>$data->id));?>">删除</a></span>
<?php endif;?>
	|
	<span><a href="<?php echo $this->createUrl('password', array('id'=>$data->id));?>">重设密码</a></span>
<?php endif;?>
	<br /><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login')); ?>:</b>
	<?php echo date('Y-m-d H:i:s', $data->last_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_count')); ?>:</b>
	<?php echo CHtml::encode($data->login_count); ?>
	<br />

<?php if($data->is_super != 1):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_time')); ?>:</b>
	<?php echo date('Y-m-d H:i:s', $data->crt_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crt_by')); ?>:</b>
	<?php echo CHtml::encode($creaters[$data->crt_by]->name); ?>
	<br />
<?php endif;?>
</div>