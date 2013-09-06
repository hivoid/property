<?php

class BuildingController extends Controller
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
		$model=new Building;
		$model->completion_year = '';

		if(isset($_POST['Building']))
		{
			$model->attributes=$_POST['Building'];
			empty($model->name) && $model->name = '#'.$model->id;
			if($model->save())
			{
				BasicInfo::model()->updateCounters(array('building_count'=>1), 'id='.Yii::app()->params['infoId']);
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
		$model->completion_year == 0 && $model->completion_year = '';;

		if(isset($_POST['Building']))
		{
			$model->attributes=$_POST['Building'];
			empty($model->name) && $model->name = '#'.$model->id;
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
		if($model->household_count > 0)
		{
			if(!isset($_GET['ajax']))
			{
				Yii::app()->user->setMessage('当前单元楼已有住户信息添加，不能再进行删除操作！', 'info');
				$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('view', 'id'=>$model->id));
			}
		}
		else
		{
			$model->delete();
			BasicInfo::model()->updateCounters(array('building_count'=>-1), 'id='.Yii::app()->params['infoId']);
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Building');
		$datas = $dataProvider->getData();
		$users = array();
		if($datas)
		{
			$pk = array();
			foreach ($datas as $data) {
				if ($data->crt_by && !in_array($data->crt_by, $pk))
				{
					$pk[] = $data->crt_by;
				}
				if ($data->up_by && !in_array($data->up_by, $pk))
				{
					$pk[] = $data->up_by;
				}
			}
			if($pk)
			{
				$rows = Manager::model()->findAllByPk($pk);
				foreach ($rows as $row)
				{
					$users[$row->id] = $row;
				}
			}
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'users'=>$users,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Building the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Building::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Building $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='building-form')
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
					array('label'=>'添加单元楼', 'url'=>array('create'), 'active'=>$action->id == 'create'),
					array('label'=>'列表', 'url'=>array('index'), 'active'=>$action->id == 'index'),
			);
			return true;
		}
	}
}
