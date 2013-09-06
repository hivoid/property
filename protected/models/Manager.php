<?php

/**
 * This is the model class for table "manager".
 *
 * The followings are the available columns in table 'manager':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $name
 * @property integer $is_super
 * @property string $login_count
 * @property string $last_login
 * @property integer $status
 * @property string $crt_time
 * @property string $crt_by
 * @property string $up_time
 * @property string $up_by
 */
class Manager extends CActiveRecord
{
	public $valiPassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'manager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$passRule = '密码最少6位, 最长20位.';
		return array(
			array('username, name', 'required', 'message'=>'{attribute} 不能为空.'),
			array('password, valiPassword', 'required', 'message'=>'您需要同时填写密码和重复密码.', 'on'=>array('password','create')),
			array('password', 'length', 'max'=>20, 'min'=>6, 'on'=>array('password','create'), 'tooLong'=>$passRule, 'tooShort'=>$passRule),
			array('valiPassword', 'validatePassword', 'on'=>array('password','create')),
			array('is_super, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20, 'min'=>2),
			array('username', 'length', 'max'=>20, 'min'=>4),
			array('password', 'length', 'max'=>128, 'except'=>array('password','create')),
			array('salt', 'length', 'max'=>64),
			array('login_count', 'length', 'max'=>10),
		);
	}

	public function validatePassword()
	{
		if($this->password !== $this->valiPassword)
			$this->addError('valiPassword', '两次密码输入不一致!');
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'creater'=>array(self::BELONGS_TO, 'Manager', 'crt_by'),
			'updater'=>array(self::BELONGS_TO, 'Manager', 'up_by')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名',
			'password' => '密码',
			'valiPassword' => '密码重复',
			'salt' => '密码混淆串',
			'name' => '姓名',
			'is_super' => '是否超级管理员',
			'login_count' => '登录次数',
			'last_login' => '最后登录时间',
			'status' => '状态',
			'crt_time' => '添加时间',
			'crt_by' => '添加人',
			'up_time' => '更新时间',
			'up_by' => '更新人',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Manager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->salt = uniqid();
				$this->salt = md5($this->salt);
				$this->password = md5($this->password.$this->salt);
				$this->crt_by = Yii::app()->user->id;
				$this->crt_time = time();
			}
			else
			{
				$this->up_by = Yii::app()->user->id;
				$this->up_time = time();
			}
			return true;
		}
		else
			return false;
	}

	public function afterLogin()
	{
		$this->last_login = time();
		$this->login_count = $this->login_count + 1;
		$this->save(array('last_login','login_count'));
	}
}