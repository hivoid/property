<?php

/**
 * This is the model class for table "building".
 *
 * The followings are the available columns in table 'building':
 * @property string $id
 * @property string $name
 * @property integer $completion_year
 * @property integer $stories
 * @property string $house_number
 * @property integer $household_count
 * @property string $crt_by
 * @property string $crt_time
 * @property string $up_by
 * @property string $up_time
 */
class Building extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id, stories, house_number', 'required'),
			array('id', 'numerical', 'integerOnly'=>true, 'max'=>4294967295, 'min'=>1),
			array('household_count', 'numerical', 'integerOnly'=>true, 'max'=>4294967295),
			array('stories', 'numerical', 'integerOnly'=>true, 'max'=>500, 'min'=>2),
			array('completion_year', 'numerical', 'integerOnly'=>true, 'min'=>1970, 'max'=>date('Y')),
			array('house_number', 'numerical', 'integerOnly'=>true, 'max'=>50000, 'min'=>2),
			array('name', 'length', 'max'=>20),
			array('id,name', 'unique'),
			array('name', 'compare', 'operator'=>'!=', 'compareValue'=>'#')
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
			'id' => '楼号',
			'name' => '楼名',
			'completion_year' => '建筑年份',
			'stories' => '楼层数量',
			'house_number' => '住房总数量',
			'household_count' => '当前住户数量',
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
	 * @return Building the static model class
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
