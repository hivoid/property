<?php
/* @var $this ResidentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'居民',
);
?>

<h1>居民</h1>
<div class="row">
	<form action="<?php echo Yii::app()->request->url; ?>" method="get">
	<b>单元楼:</b>
	<select name="bid" id="bid">
		<option value=""<?php if(empty($bid)):?> selected="selected" <?php endif;?>>请选择</option>
<?php foreach ($buildings as $key=>$value):?>
		<option value="<?php echo $key;?>"<?php if($bid == $key):?> selected="selected" <?php endif;?>><?php echo CHtml::encode($value);?></option>
<?php endforeach;?>
	</select>
	&nbsp; | &nbsp;
	<b>住户:</b>
	<select name="hid" id="hid">
		<option value=""<?php if(empty($hid)):?> selected="selected" <?php endif;?>>请选择</option>
<?php foreach ($hhs as $key=>$value):?>
		<option value="<?php echo $key;?>"<?php if($hid == $key):?> selected="selected" <?php endif;?>><?php echo CHtml::encode($value);?></option>
<?php endforeach;?>
	</select>
	&nbsp; | &nbsp;
	<b>姓名:</b>
	<input type="text" name="n" value="<?php echo $n;?>" />
	<input type="hidden" name="r" value="<?php echo $_GET['r'];?>" />
	<input type="submit" value="检索" />
	</form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<script type="text/javascript">
jQuery(function($){
	$('#bid').change(function(){
		$('#hid').html('');
		$('#hid').load('<?php echo $this->createUrl('hhoptions');?>', {bid:$(this).val()});
	});
});
</script>