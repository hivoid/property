<?php

class CarportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
	public function actionCreate($hid)
	{
		$hm = Household::model()->findByPk($hid);
		if(empty($hm))
		{
			Yii::app()->user->setMessage('您尝试在一个不存在的住户下添加车位!','info');
			$this->redirect(array('//resident/index'));
		}
		$model=new Carport;
		$model->household_id = $hm->id;
		if(isset($_POST['Carport']))
		{
			$model->attributes=$_POST['Carport'];
			if($model->save())
			{
				BasicInfo::model()->updateCounters(array('carport_count'=>1), 'id='.Yii::app()->params['infoId']);
				Household::model()->updateCounters(array('carport_count'=>1), 'id='.$hm->id);
				$this->redirect(array('view','id'=>$model->id));
			}
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

		if(isset($_POST['Carport']))
		{
			$model->attributes=$_POST['Carport'];
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
		$model = $this->loadModel($id);
		if($model->delete())
		{
			BasicInfo::model()->updateCounters(array('carport_count'=>-1), 'id='.Yii::app()->params['infoId']);
			Household::model()->updateCounters(array('carport_count'=>-1), 'id='.$model->household_id);
		}
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Carport');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=Carport::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'车位不存在.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Carport $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='carport-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionFastview()
	{
		if (isset($_POST['carport-id']) && !empty($_POST['carport-id']))
		{
			$cpid = intval($_POST['carport-id']);
			if(Carport::model()->exists('id='.$cpid))
				$this->redirect(array('view', 'id'=>$cpid));
		}
		Yii::app()->user->setMessage('编号为 ['.$_POST['carport-id'].'] 的车位不存在.');
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
}
