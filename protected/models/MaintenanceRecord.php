<?php

/**
 * This is the model class for table "maintenance_record".
 *
 * The followings are the available columns in table 'maintenance_record':
 * @property string $id
 * @property string $date
 * @property string $technician
 * @property string $project
 * @property string $description
 * @property double $amount
 * @property string $crt_by
 * @property string $crt_time
 * @property string $up_by
 * @property string $up_time
 */
class MaintenanceRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'maintenance_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, technician, project', 'required'),
			array('amount', 'numerical'),
			array('technician, crt_time, up_time', 'length', 'max'=>20),
			array('project', 'length', 'max'=>30),
			array('description', 'length', 'max'=>500),
			array('crt_by, up_by', 'length', 'max'=>10),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'creater'=>array(self::BELONGS_TO, 'Manager', 'crt_by'),
				'updater'=>array(self::BELONGS_TO, 'Manager', 'up_by')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => '维修日期',
			'technician' => '维修技术员',
			'project' => '维修项目',
			'description' => '项目说明',
			'amount' => '额外花费',
			'crt_by' => '添加人',
			'crt_time' => '添加时间',
			'up_by' => '更新人',
			'up_time' => '更新时间',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MaintenanceRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->crt_by = Yii::app()->user->id;
				$this->crt_time = time();
			}
			else
			{
				$this->up_by = Yii::app()->user->id;
				$this->up_time = time();
			}
			return true;
		}
		else
			return false;
	}
}
