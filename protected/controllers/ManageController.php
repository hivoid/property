<?php

class ManageController extends Controller
{
	public $menu = array(
				array('label'=>'小区信息管理','url'=>array('//info')),
				array('label'=>'管理员管理','url'=>array('//manager')),
				array('label'=>'单元楼信息管理','url'=>array('//building')),
				array('label'=>'居民管理','url'=>array('//resident')),
				array('label'=>'缴费管理','url'=>array('//payment')),
				array('label'=>'车位管理','url'=>array('//carport')),
				array('label'=>'维修记录','url'=>array('//maintenance')),
			);

	public function actionIndex()
	{
		$info = BasicInfo::model()->findByPk(Yii::app()->params['infoId']);
		$this->render('index', array('info'=>$info));
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}