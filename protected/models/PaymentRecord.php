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
 * @property double $other
 * @property string $remark
 * @property string $crt_by
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('household_id, date', 'required'),
			array('public_lighting, heating, waste_collection, other', 'numerical'),
			array('household_id, crt_by', 'length', 'max'=>10),
			array('remark', 'length', 'max'=>500),
			array('crt_time', 'length', 'max'=>20),
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
			'id' => 'ID',
			'household_id' => '住户',
			'date' => '缴费日期',
			'public_lighting' => '照明',
			'heating' => '取暖',
			'waste_collection' => '垃圾清理',
			'other' => '其它费用',
			'remark' => '备注说明',
			'crt_by' => '添加人',
			'crt_time' => '添加时间',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentRecord the static model class
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
