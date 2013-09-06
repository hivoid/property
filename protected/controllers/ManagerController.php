<?php

class ManagerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','delete','view','update', 'password'),
				'users'=>array('wgs'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Manager('create');

		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if($model->is_super)
		{
			throw new CHttpException(400, '超级管理员信息不允许修改.');
		}
		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionPassword($id)
	{
		$model=$this->loadModel($id);
		$model->setScenario('password');
		$model->password = '';
		$message = '';
		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
			if($model->validate())
			{
				$model->salt = uniqid();
				$model->salt = md5($model->salt);
				$model->password = md5($model->password.$model->salt);
				$model->save(false, array('password','salt'));
				$model->password = '';
				$model->valiPassword = '';
				$message = '密码设置成功!';
			}
		}
	
		$this->render('password',array(
				'model'=>$model,
				'message'=>$message
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->status = 0;
		$model->save(false, array('status'));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', 1);
		$dataProvider=new CActiveDataProvider('Manager', array(
				'pagination'=>array('pageSize'=>10),
				'criteria'=>$criteria
				));
		$datas = $dataProvider->getData();
		$creaters = array();
		if($datas)
		{
			$pk = array();
			foreach ($datas as $data) {
				if($data->crt_by)
					$pk[] = $data->crt_by;
			}
			if($pk)
			{
				$rows = Manager::model()->findAllByPk($pk);
				foreach ($rows as $row) {
					$creaters[$row->id] = $row;
				}
			}
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'creaters'=>$creaters
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Manager the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Manager::model()->findByPk($id);
		if($model===null || $model->status != 1)
			throw new CHttpException(404,'您访问的内容不存在.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Manager $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manager-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			$this->menu=array(
					array('label'=>'添加管理员', 'url'=>array('create'), 'active'=>$action->id == 'create'),
					array('label'=>'列表', 'url'=>array('index'), 'active'=>$action->id == 'index'),
			);
			return true;
		}
	}
}
