<?php

/**
 * This is the model class for table "household".
 *
 * The followings are the available columns in table 'household':
 * @property string $id
 * @property string $building_id
 * @property integer $entrance
 * @property integer $floor
 * @property integer $number
 * @property double $covered_area
 * @property integer $has_gas
 * @property integer $size
 * @property string $householder
 * @property integer $is_rent
 * @property string $remark
 * @property string $crt_by
 * @property string $crt_time
 * @property string $up_by
 * @property string $up_time
 */
class Household extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'household';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('building_id, entrance, floor, number, covered_area, householder', 'required'),
			array('is_rent', 'required', 'message'=>'请选择房屋状态是否出租.'),
			array('floor, has_gas, size, is_rent', 'numerical', 'integerOnly'=>true),
			array('floor','checkFloor'),
			array('number', 'numerical', 'integerOnly'=>true, 'min'=>1, 'max'=>100),
			array('entrance', 'numerical', 'integerOnly'=>true, 'min'=>1, 'max'=>10),
			array('covered_area', 'numerical', 'min'=>10, 'max'=>1000),
			array('building_id, householder, crt_by, up_by', 'length', 'max'=>10),
			array('remark', 'length', 'max'=>500),
			array('crt_time, up_time', 'length', 'max'=>20),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'hder'=>array(self::BELONGS_TO, 'Resident', 'householder'),
			'building'=>array(self::BELONGS_TO, 'Building', 'building_id'),
			'creater'=>array(self::BELONGS_TO, 'Manager', 'crt_by'),
			'updater'=>array(self::BELONGS_TO, 'Manager', 'up_by')
		);
	}

	public function checkFloor()
	{
		$building = Building::model()->findByPk($this->building_id);
		if(empty($building))
		{
			$this->addError('building_id', '所选单元楼不存在.');
		}
		else
		{
			if ($this->floor > $building->stories)
			{
				$this->addError('floor', CHtml::encode("所填楼层超过 {$building->name} 楼层数量 ({$building->stories} 层)"));
			}
		}
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'building_id' => '楼号',
			'entrance' => '单元',
			'floor' => '楼层',
			'number' => '房间号',
			'covered_area' => '建筑面积',
			'has_gas' => '天燃气',
			'size' => '在录人口',
			'householder' => '户主',
			'is_rent' => '是否租住',
			'remark' => '备注',
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
	 * @return Household the static model class
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
