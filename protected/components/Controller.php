<?php
class Controller extends CController
{
	public $layout='//layouts/column2';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

	public $breadcrumbs=array();

	public function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			if(Yii::app()->user->isGuest && !($this->id == 'manage' && $action->id == 'login'))
				Yii::app()->user->loginRequired();
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
}