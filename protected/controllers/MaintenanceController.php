<?php

class MaintenanceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
		$model=new MaintenanceRecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MaintenanceRecord']))
		{
			$model->attributes=$_POST['MaintenanceRecord'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MaintenanceRecord']))
		{
			$model->attributes=$_POST['MaintenanceRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($u = null, $dt = null)
	{
		$criteria = new CDbCriteria();
		if(isset($dt) && '' !== $dt)
		{
			$criteria->compare('date', $dt);
		}
		if(isset($u) && '' !== $u)
		{
			$criteria->compare('technician', $u, true);
		}
		$dataProvider=new CActiveDataProvider('MaintenanceRecord', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10, 'pageVar'=>'p')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'u'=>$u,
			'dt'=>$dt
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MaintenanceRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MaintenanceRecord']))
			$model->attributes=$_GET['MaintenanceRecord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MaintenanceRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MaintenanceRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MaintenanceRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='maintenance-record-form')
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
					array('label'=>'所有记录', 'url'=>array('index'), 'active'=>$action->id == 'index'),
					array('label'=>'添加新记录', 'url'=>array('create'), 'active'=>$action->id == 'create'),
			);
			return true;
		}
	}
}
