<?php

class WebUser extends CWebUser
{
	public function init()
	{
		$this->setStateKeyPrefix('a3076a930491163e4c9b8550c0fbae6c');
		parent::init();
	}

	protected function afterLogin($fromCookie)
	{
		parent::afterLogin($fromCookie);
		$login = Manager::model()->findByPk($this->getId());
		if(!$fromCookie && method_exists($login, 'afterLogin'))
			$login->afterLogin($this);
	}

	protected function afterLogout()
	{
		parent::afterLogout();
		Yii::app()->user->setReturnUrl(null);
	}

	/**
	 * 设置给下一个页面提示信息
	 * @param string $message 提示信息
	 * @param string $level 信息级别, 可设置为 success[默认], info, warn 和 error
	 * @param number $stay 提示信息停留时间 默认 3000毫秒
	 * @param mix $mode	提示模式 1或layer 为默认方式, 即页面加载完成后弹出层提示, 2或jump为显示提示页面后跳转(同刷新)
	 */
	public function setMessage($message, $level='success', $stay=3000, $mode=null)
	{
		$this->setFlash('promptMessage'      , $message);
		$this->setFlash('promptMessageLevel' , $level);
		$this->setFlash('promptMessageStay'  , $stay);
		$this->setFlash('promptMessageMode'  , $mode);
	}
}