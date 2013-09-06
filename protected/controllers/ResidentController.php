<?php

class ResidentController extends Controller
{
	public $layout='//layouts/column2';

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionHhview($id)
	{
		$this->render('hhview',array(
				'model'=>$this->loadHModel($id),
		));
	}

	public function actionCreate()
	{
		$buildings = Building::model()->findAll();
		if(empty($buildings))
		{
			Yii::app()->user->setMessage('您还没有建立任何单元楼信息，请先创建相应单元楼信息，然后在其基础上添加住户信息！', 'info', 5000, 'jump');
			$this->redirect(array('//Building/create'));
		}
		$buildingPair = array();
		foreach ($buildings as $building)
		{
			$buildingPair[$building->id] = $building->name;
		}
		$hh = new Household();
		$model = new Resident();
		$model->phone = '';
		if(isset($_POST['Household']))
		{
			$hh->attributes = $_POST['Household'];
			$model->attributes = $_POST['Resident'];
			$hh->householder = 0;
			$model->household_id = 0;
			$model->rel_with_householder = '本人';
			$mvr = $model->validate();
			if($hh->validate() && $mvr)
			{
				$hh->save(false);
				$model->household_id = $hh->id;
				$model->save(false);
				$hh->householder = $model->id;
				$hh->size = 1;
				$hh->save(false, array('householder', 'size'));
				BasicInfo::model()->updateCounters(array('household_count'=>1), 'id='.Yii::app()->params['infoId']);
				BasicInfo::model()->updateCounters(array('resident_count'=>1), 'id='.Yii::app()->params['infoId']);
				Building::model()->updateCounters(array('household_count'=>1), 'id='.$hh->building_id);
				$this->redirect(array('hhview','id'=>$hh->id));
			}
		}

		$this->render('hhcreate',array(
			'hh'=>$hh,
			'model'=>$model,
			'buildings'=>$buildingPair
		));
	}

	public function actionAdd()
	{
		$model=new Resident;

		if(isset($_POST['Resident']))
		{
			$model->attributes=$_POST['Resident'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('add',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Resident']))
		{
			$model->attributes=$_POST['Resident'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionHhupdate($id)
	{
		$model=$this->loadHModel($id);

		$buildings = Building::model()->findAll();
		$buildingPair = array();
		foreach ($buildings as $building)
		{
			$buildingPair[$building->id] = $building->name;
		}
		if(isset($_POST['Household']))
		{
			$model->attributes=$_POST['Household'];
			if($model->save())
				$this->redirect(array('hhview','id'=>$model->id));
		}

		$this->render('hhupdate',array(
			'model'=>$model,
			'buildings'=>$buildingPair
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionList()
	{
		$dataProvider=new CActiveDataProvider('Resident');
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array('building','hder');
		$criteria->together = true;
		$dataProvider=new CActiveDataProvider('Household', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10)));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=Resident::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'没有这个居民.');
		return $model;
	}

	public function loadHModel($id)
	{
		$model=Household::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'住户不存在.');
		return $model;
	}

	public function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			$this->menu=array(
					array('label'=>'所有住户', 'url'=>array('index'), 'active'=>$action->id == 'index'),
					array('label'=>'添加户主', 'url'=>array('create'), 'active'=>$action->id == 'create'),
			);
			return true;
		}
	}
}
