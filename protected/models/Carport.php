<?php

/**
 * This is the model class for table "carport".
 *
 * The followings are the available columns in table 'carport':
 * @property string $id
 * @property string $household_id
 * @property string $description
 * @property string $crt_by
 * @property string $crt_time
 * @property string $up_by
 * @property string $up_time
 */
class Carport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'carport';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, household_id', 'required'),
			array('id, household_id, crt_by, up_by', 'length', 'max'=>10),
			array('description', 'length', 'max'=>500),
			array('crt_time, up_time', 'length', 'max'=>20),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '编号',
			'household_id' => '所属住户',
			'description' => '说明',
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
	 * @return Carport the static model class
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
