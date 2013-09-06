<?php
$this->pageTitle=Yii::app()->name . ' - 错误';
$this->breadcrumbs=array(
	'错误',
);
?>

<h2>错误: <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>