<?php
class UserIdentity extends CUserIdentity
{
	private $_id;

	public function authenticate()
	{
		$login = Manager::model()->findByAttributes(array('username'=>$this->username));
		if($login===null || $login->status != 1)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($login->password!==md5($this->password.$login->salt))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$login->id;
			$this->setState('id', $login->id);
			$this->setState('username', $login->username);
			$this->setState('isSuper', $login->is_super);
			$this->setState('loginCount', $login->login_count+1);
			$this->setState('lastLoginTime', $login->last_login);
			$this->setState('loginTime', time());
			$this->errorCode=self::ERROR_NONE;
			$this->setState('name', $login->name);
		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}