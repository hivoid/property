<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>错误信息</title>
<style type="text/css">
#tzhuan{
	margin:0px auto;
	clear:both;
	width:602px;
	text-align:left;
	padding-top:120px;
}
.tzbjo{
	background:url(<?php echo Yii::app()->getBaseUrl(true);?>/images/prompt-bg.gif) no-repeat scroll left 0px;
	height:55px;
	width:602px;
}
.tzbjt{
	border-left:solid 1px #1c72af;
	border-right:solid 1px #1c72af;
	width:598px;
	height:100px;
	font-size:14px;
	padding-top:50px;
}
.tzxx_box{
	width:500px;
	height:auto;
	margin: 0 auto;
	font-size:14px;
	line-height:20px;
	color:#333333;
}
.tz_zt_tb{
	width:32px;
	height:32px;
	float:left;
	display:inline;
	margin-right:5px;
}
.fanhui{
	color:#004080;
	text-decoration:underline;
}
.tzbjh{
	background:url(<?php echo Yii::app()->getBaseUrl(true);?>/images/prompt-bg.gif) no-repeat scroll left -55px;
	height:20px;
	width:602px;
}
.fanhui a{
	text-decoration:underline;
	color:#004080;
}
.fanhui a:hover{
	text-decoration:underline;
	color:#004080;
}
</style>
</head>
<body>
<div id="tzhuan">
	<div class="tzbjo"></div>
	<div class="tzbjt">
		<div class="tzxx_box">
			<div class="tz_zt_tb"><img src="<?php echo Yii::app()->getBaseUrl(true);?>/images/jinggao.jpg" border="0"></div>
			<strong><?php echo CHtml::encode($message); ?></strong>
			<br />
			页面将在<span id="<?php echo $timeCounterId;?>"><?php echo $timeOut;?></span>秒内跳转，您也可以手动点击：<a href="<?php echo $url;?>"><span class="fanhui">这里</span></a>
		</div>
	</div>
	<div class="tzbjh"></div>
</div>
</body>
</html>
