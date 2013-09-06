<?php
$this->pageTitle=Yii::app()->name;
?>
<style type="text/css">
#basic-info{
	font-size: 14px;
}
#basic-info code{
	font-weight: bold;
	color: #c63;
}
#basic-info span{
	width: 100px;
	display: inline-block;
}
#basic-info li{
	list-style-type: none;
	height: 26px;
	width: 500px;
	padding-left: 20px;
	margin-top : 5px;
}
</style>
<h1><i><?php echo CHtml::encode('欢迎进入 ' . $info->name . ' ' . Yii::app()->name); ?></i></h1>

<p>点击菜单可以进行相应管理操作.</p>
<ul id="basic-info">
	<li><span>小区名称: </span><code><?php echo CHtml::encode($info->name); ?></code></li>
	<li><span>所在地: </span><code><?php echo Region::code2name($info->region); ?></code></li>
<?php if($info->address):?>
	<li><span>详细地址: </span><code><?php echo CHtml::encode($info->address); ?></code></li>
<?php endif;?>
<?php if($info->zip):?>
	<li><span>邮编: </span><code><?php echo $info->zip; ?></code></li>
<?php endif;?>
	<li><span>建筑类型: </span><code><?php echo $info->propertyClassName; ?></code></li>
<?php if($info->developers):?>
	<li><span>开发商: </span><code><?php echo CHtml::encode($info->developers); ?></code></li>
<?php endif;?>
	<li><span>当前住户: </span><code><?php echo $info->household_count; ?></code></li>
	<li><span>当前居民人口: </span><code><?php echo $info->resident_count; ?></code></li>
</ul>
