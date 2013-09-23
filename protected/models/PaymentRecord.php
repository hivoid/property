<?php

/**
 * This is the model class for table "payment_record".
 *
 * The followings are the available columns in table 'payment_record':
 * @property string $id
 * @property string $household_id
 * @property string $date
 * @property double $public_lighting
 * @property double $heating
 * @property double $waste_collection
 * @property double $property_costs
 * @property double $catv_costs
 * @property double $other
 * @property string $remark
 * @property string $crt_by
 * @property string $up_by
 * @property string $up_time
 * @property string $crt_time
 */
class PaymentRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_record';
	}

	public function rules()
	{
		return array(
			array('household_id, date', 'required'),
			array('public_lighting, heating, waste_collection, property_costs, catv_costs, other', 'numerical', 'min'=>0),
			array('public_lighting, heating, waste_collection, property_costs, catv_costs, other', 'checkTotal'),
			array('household_id', 'length', 'max'=>10),
			array('remark', 'length', 'max'=>500),
		);
	}

	public function  checkTotal($attribute, $params)
	{
		$total = $this->public_lighting + $this->heating + $this->waste_collection + $this->other + $this->property_costs + $this->catv_costs;
		if($total <= 0)
			$this->addError($attribute, '您至少需要填写一项缴费金额.');
	}

	public function relations()
	{
		return array(
			'hh'=>array(self::BELONGS_TO, 'Household', 'household_id'),
			'creater'=>array(self::BELONGS_TO, 'Manager', 'crt_by'),
			'updater'=>array(self::BELONGS_TO, 'Manager', 'up_by')
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'household_id' => '住户',
			'date' => '缴费日期',
			'public_lighting' => '照明',
			'heating' => '取暖',
			'waste_collection' => '垃圾清理',
			'property_costs' => '物业费',
			'catv_costs' => '有线电视费',
			'other' => '其它费用',
			'remark' => '备注说明',
			'crt_by' => '添加人',
			'up_by' => '更新人',
			'up_time' => '更新时间',
			'crt_time' => '添加时间',
		);
	}

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
