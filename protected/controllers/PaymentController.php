<?php

class PaymentController extends Controller
{
	public $layout='//layouts/column2';

	public $costs = array(
				'public_lighting'  => '照明费',
				'heating'          => '取暖费',
				'waste_collection' => '垃圾清理费',
				'property_costs'   => '物业费',
				'catv_costs'       => '有线电视费',
				'other'            => '其它费用'
			);
	public $sdays = array(
			1  => '今天',
			3  => '三天内',
			7  => '一周内',
			30 => '一个月内',
			90 => '三个月内',
	);

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

	public function actionIndex($dt = null, $s = null)
	{
		$criteria = new CDbCriteria();
		if(isset($dt) && '' !== $dt)
		{
			$date = intval($dt);
			if(array_key_exists($date, $this->sdays))
			{
				if($date == 30)
				{
					$critical = strtotime("-1 months", strtotime('tomorrow'));
					$cdate = date('Y-m-d', $critical);
					$criteria->compare('date', ">= {$cdate}");
				}
				elseif ($date == 90)
				{
					$critical = strtotime("-3 months", strtotime('tomorrow'));
					$cdate = date('Y-m-d', $critical);
					$criteria->compare('date', ">= {$cdate}");
				}
				else
				{
					$critical = strtotime("-{$date} Days", strtotime('tomorrow'));
					$cdate = date('Y-m-d', $critical);
					$criteria->compare('date', ">= {$cdate}");
				}
			}
		}
		if(isset($s) && '' !== $s)
		{
			if(array_key_exists($s, $this->costs))
			{
				$sub = $s;
				$criteria->compare($sub, "> 0");
			}
		}
		$dataProvider=new CActiveDataProvider('PaymentRecord', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10, 'pageVar'=>'p')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			's'=>isset($sub) ? $sub : null,
			'dt'=>isset($date) ? $date : null
		));
	}

	public function actionParr()
	{
		$criteria = new CDbCriteria();
		$critical = strtotime("-1 months", strtotime('tomorrow'));
		$cdate = date('Y-m-d', $critical);
		$criteria->compare('date', ">= {$cdate}");
		$criteria->compare('property_costs', "> 0");
		$criteria->group = 'household_id';
		$criteria->select = 'household_id';
		$models = PaymentRecord::model()->findAll($criteria);
		$hcriteria = new CDbCriteria();
		if($models)
		{
			$pk = array();
			foreach ($models as $model) {
				$pk[] = $model->household_id;
			}
			$hcriteria->addNotInCondition('id', $pk);
		}
		$hcriteria->with = 'building';
		$hcriteria->together = true;
		$dataProvider=new CActiveDataProvider('Household', array('criteria'=>$hcriteria,'pagination'=>array('pageSize'=>10, 'pageVar'=>'p')));
		$this->render('punpaid',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionPhistory($hid)
	{
		$model = Household::model()->findByPk($hid);
		if($model)
		{
			$criteria = new CDbCriteria();
			$criteria->compare('household_id', $hid);
			$criteria->compare('property_costs', "> 0");
			$criteria->order = 't.date DESC';
			$dataProvider=new CActiveDataProvider('PaymentRecord', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10, 'pageVar'=>'p')));
			$this->render('phistory',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model
			));
		}
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
