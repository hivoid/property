<?php
class Controller extends CController
{
	public $layout='//layouts/column2';

	public $promptDir = '//manage/prompt';

	public $menu=array();

	public $breadcrumbs=array();

	public function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			$this->raisePrompt();
			if(Yii::app()->user->isGuest && !($this->id == 'manage' && ($action->id == 'login' || $action->id == 'error')))
			{
				Yii::app()->user->loginRequired();
			}
			if(!Yii::app()->user->isGuest && ($this->id == 'manage' && $action->id == 'login'))
			{
				$this->redirect(array('//manage'));
			}
			// 是否已经填写小区信息
			$infoFilled = BasicInfo::model()->exists('id=' . Yii::app()->params['infoId']);
			// 需要完善小区基本信息后才能进行正常管理
			if(!$infoFilled && !($this->id === 'manage' && in_array($this->action->id, array('login','logout'))) && $this->id !== 'info')
			{
				$timeOut = 3; // 页面停留时间(秒)
				$stay = $timeOut * 1000;
				$url = Yii::app()->createUrl('//info');
				Yii::app()->getClientScript()->registerScript('promptJumpJs', "var timeCounter = document.getElementById('timeCounter');setInterval('timeCounter.innerHTML=timeCounter.innerHTML-1', 1000);setTimeout('location.href=\"{$url}\"', {$stay});");
				$this->renderPartial('//manage/prompt', array('message'=>'进行管理操作之前请先完善小区基本信息! ','timeOut'=>$timeOut,'url'=>$url), false, true);
				Yii::app()->end();
			}
			return true;
		}
	}

	public function raisePrompt()
	{
		if(!Yii::app()->user->hasFlash('promptMessage'))
			return true;
		// 提示信息
		$message = Yii::app()->user->getFlash('promptMessage');
		// 消息级别 success, info[默认], warn, error
		$level   = Yii::app()->user->getFlash('promptMessageLevel');
		// 提示模式 1|layer:模态弹出层[默认], 2|jump:显示消息后页面跳转
		$mode    = Yii::app()->user->getFlash('promptMessageMode');
		// 消息显示时间 毫秒 3000[默认]
		$stay    = Yii::app()->user->getFlash('promptMessageStay');

		$level = strtolower($level);
		in_array($level, array('success', 'info', 'warn', 'error')) || $level = 'success';

		$mode = isset($mode) && in_array($mode, array('2', 2, 'jump')) ? 2 : 1;

		$stay = (int)$stay;
		if($stay !== 0)
		{
			$stay = max($stay, 500);
			$stay = min($stay, 5000);
		}
		else
			$stay = 3000;
		if($mode === 1)
		{
			$view = rtrim($this->promptDir, '/') . '/layer/' . $level;
			$layerHtml = $this->renderPartial($view, array('message'=>$message, 'closeButtonId'=>'promptLayerCloseButton'), true, true);
			$layerHtml = '<div id="promptLayer">' . str_replace(array("'", "\r", "\n"), array("\'", '', ''), $layerHtml) . '</div>';
			$cs = Yii::app()->clientScript;
			$cs->registerCoreScript('jquery');
			$cs->registerScriptFile(Yii::app()->getBaseUrl(true) . '/js/fancybox/jquery.fancybox.js');
			$cs->registerCssFile(Yii::app()->getBaseUrl(true) . '/js/fancybox/jquery.fancybox.css');
			$cs->registerCss('messageCss', ".message-box{width:500px;border:1px solid #D9D9D9;float:left;display:inine;}
					.message-title{height:25px;background:#F3F3F3;}
					.message-title-word{float:left;padding:4px; 10px;font-size:14px;color:#595959;}
					.message-title-close{width:9px;height:8px;float:right;margin:8px 10px;}
					.message-content{padding: 20px 10px;}");
			Yii::app()->getClientScript()->registerScript('promptLayerJs', "
			$.fancybox({closeClick:false,openEffect:'none',closeEffect:'none',closeBtn:false,content:'{$layerHtml}'});
			setTimeout('$.fancybox.close();', 9000000);
			$('#promptLayerCloseButton').click(function(){ $.fancybox.close(); });");
		}
		else
		{
			$url = Yii::app()->request->getUrl();
			$staySec = ceil($stay / 1000);
			Yii::app()->getClientScript()->registerScript('promptJumpJs', "
					var timeCounter = document.getElementById('timeCounter');
					setInterval('timeCounter.innerHTML=timeCounter.innerHTML-1', 1000);
					setTimeout('location.href=\"{$url}\"', {$stay});
			");
			Yii::app()->getClientScript()->registerCssFile(Yii::app()->getBaseUrl(true) . '/css/tiao.css');
			$view = rtrim($this->promptDir, '/') . '/' . $level;
			$this->layout = false;
			$this->render($view, array(
				'message'=>$message,
				'url'=>$url,
				'timeOut'=>$staySec,
				'timeCounterId'=>'timeCounter'
			));
			Yii::app()->end();
		}
	}
}