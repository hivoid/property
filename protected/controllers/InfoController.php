<?php

class InfoController extends Controller
{
	public $layout='//layouts/column2';

	public function actionIndex()
	{
		$model = BasicInfo::model()->findByPk(Yii::app()->params['infoId']);
		if(null === $model)
		{
			$model=new BasicInfo;
		}
		$model->zip == 0 && $model->zip = null;
		if(isset($_POST['BasicInfo']))
		{
			$model->attributes=$_POST['BasicInfo'];
			if($model->save())
				$this->redirect(array('//manage'));
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
}
