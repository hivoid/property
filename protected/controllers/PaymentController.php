<?php

class PaymentController extends Controller
{
	public $layout='//layouts/column2';

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$hdatas = array();
		$hrelations = array();
		$allhs = Household::model()->with('building')->findAll();
		if(empty($allhs))
		{
			Yii::app()->user->setMessage('您还没有建立任何住户信息，请先创建相应住户信息，然后在其基础上添加住户缴费信息！', 'info', 5000, 'jump');
			$this->redirect(array('//resident'));
		}
		foreach ($allhs as $h) {
			$pid = '100000' . $h->building_id;
			$hdatas[$pid] = array('name'=>$h->building->name,'level'=>1,'parent'=>0);
			$hdatas[$h->id] = array('name'=>$h->building->name . ' ' . $h->entrance . '单元 ' . $h->floor . '层 #'. $h->number,'level'=>2,'parent'=>$pid);
			isset($hrelations[0]) || $hrelations[0] = array();
			in_array($pid, $hrelations[0]) || $hrelations[0][] = $pid;
			isset($hrelations[$pid]) || $hrelations[$pid] = array();
			in_array($h->id, $hrelations[$pid]) || $hrelations[$pid][] = $h->id;
		}
		$model=new PaymentRecord;

		if(isset($_POST['PaymentRecord']))
		{
			$model->attributes=$_POST['PaymentRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'hdatas'=>$hdatas,
			'hrelations'=>$hrelations
		));
	}

	public function actionUpdate($id)
	{
		$hdatas = array();
		$hrelations = array();
		$allhs = Household::model()->with('building')->findAll();
		foreach ($allhs as $h) {
			$pid = '100000' . $h->building_id;
			$hdatas[$pid] = array('name'=>$h->building->name,'level'=>1,'parent'=>0);
			$hdatas[$h->id] = array('name'=>$h->building->name . ' ' . $h->entrance . '单元 ' . $h->floor . '层 #'. $h->number,'level'=>2,'parent'=>$pid);
			isset($hrelations[0]) || $hrelations[0] = array();
			in_array($pid, $hrelations[0]) || $hrelations[0][] = $pid;
			isset($hrelations[$pid]) || $hrelations[$pid] = array();
			in_array($h->id, $hrelations[$pid]) || $hrelations[$pid][] = $h->id;
		}
		$model=$this->loadModel($id);

		if(isset($_POST['PaymentRecord']))
		{
			$model->attributes=$_POST['PaymentRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'hdatas'=>$hdatas,
			'hrelations'=>$hrelations
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PaymentRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=PaymentRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
