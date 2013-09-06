<div class="message-box">
	<div class="message-title">
		<div class="message-title-word">警告</div>
		<div class="message-title-close"><a href="javascript:void();" id="<?php echo $closeButtonId;?>"><img src="<?php echo Yii::app()->getBaseUrl(true);?>/images/gb.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div class="message-content">
		<img src="<?php echo Yii::app()->getBaseUrl(true);?>/images/org_32.jpg" border="0"> &nbsp; <?php echo CHtml::encode($message); ?>
	</div>
</div>