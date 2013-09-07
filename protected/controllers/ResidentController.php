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

	public function actionAdd($hid)
	{
		$hmodel = Household::model()->findByPk($hid);
		if(null == $hmodel)
		{
			throw new CHttpException(404, '你在尝试在一个不存在的住户下添加居民！');
		}
		$model=new Resident;
		$model->household_id = $hmodel->id;
		if(isset($_POST['Resident']))
		{
			$model->attributes=$_POST['Resident'];
			if($model->save())
			{
				BasicInfo::model()->updateCounters(array('resident_count'=>1), 'id='.Yii::app()->params['infoId']);
				Household::model()->updateCounters(array('size'=>1), 'id='.$hmodel->id);
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$buildings = Building::model()->findAll();
		$hhs = array();
		$buildingPair = array();
		foreach ($buildings as $building)
		{
			$buildingPair[$building->id] = $building->name;
		}
		$criteria = new CDbCriteria();
		$criteria->with = 'hh.building';
		$criteria->together = true;
		if(!empty($_GET['hid']))
		{
			$hmodel = Household::model()->findByPk($_GET['hid']);
			if($hmodel)
			{
				$criteria->compare('household_id', $_GET['hid']);
				$_GET['bid'] = $hmodel->building_id;
			}
		}
		if(!empty($_GET['bid']))
		{
			$hms = Household::model()->findAllByAttributes(array('building_id'=>$_GET['bid']), array('order'=>'entrance ASC, floor ASC'));
			if($hms)
			{
				empty($hmodel) && $criteria->compare('hh.building_id', $_GET['bid']);
				foreach ($hms as $hm) {
					$hhs[$hm->id] = $hm->entrance . ' 单元 ' . $hm->floor . ' 层 #' . $hm->number;
				}
			}
		}
		if(!empty($_GET['n']))
		{
			$criteria->compare('t.name', $_GET['n'], true);
		}
		$dataProvider=new CActiveDataProvider('Resident', array(
				'criteria'=>$criteria,
				'pagination'=>array('pageSize'=>'15','pageVar'=>'p'),
			));
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
			'buildings'=>$buildingPair,
			'hhs'=>$hhs,
			'hid'=>empty($_GET['hid']) ? null : $_GET['hid'],
			'bid'=>empty($_GET['bid']) ? null : $_GET['bid'],
			'n'=>empty($_GET['n']) ? null : $_GET['n']
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
					array('label'=>'所有居民', 'url'=>array('list'), 'active'=>$action->id == 'list'),
					array('label'=>'添加户主', 'url'=>array('create'), 'active'=>$action->id == 'create'),
			);
			return true;
		}
	}

	public function actionHhoptions()
	{
		$bid = Yii::app()->request->getParam('bid');
		$options = '<option value="">请选择</option>';
		if($bid)
		{
			$hms = Household::model()->findAllByAttributes(array('building_id'=>$bid), array('order'=>'entrance ASC, floor ASC'));
			if($hms)
			{
				foreach ($hms as $hm) {
					$options .= '<option value="' . $hm->id . '">' .  $hm->entrance . ' 单元 ' . $hm->floor . ' 层 #' . $hm->number . '</option>';
				}
			}
		}
		echo $options;
		Yii::app()->end();
	}
}
