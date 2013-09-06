<?php

/**
 * This is the model class for table "basic_info".
 *
 * The followings are the available columns in table 'basic_info':
 * @property string $id
 * @property string $name
 * @property string $region
 * @property string $address
 * @property string $zip
 * @property integer $property_class
 * @property string $developers
 * @property integer $building_count
 * @property integer $carport_count
 * @property integer $household_count
 * @property integer $resident_count
 */
class BasicInfo extends CActiveRecord
{
	private static $_propertyClasses = array(
				'1'=>'普通住宅',
				'2'=>'公寓'
			);

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'basic_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name', 'required', 'message'=>'您还没有填写 {attribute}.'),
			array('property_class, region', 'required', 'message'=>'请选择 {attribute}'),
			array('property_class', 'numerical', 'integerOnly'=>true, 'message'=>'非法操作'),
			array('id, building_count, carport_count, household_count, resident_count', 'length', 'max'=>10),
			array('name', 'length', 'max'=>20),
			array('region', 'length', 'max'=>6, 'min'=>6),
			array('zip', 'numerical', 'integerOnly'=>true),
			array('zip', 'length', 'max'=>6, 'min'=>6, 'message'=>'请正确填写 {attribute}', 'tooLong'=>'请正确填写 {attribute} (六位数字)', 'tooShort'=>'请正确填写 {attribute} (六位数字)'),
			array('address', 'length', 'max'=>255),
			array('developers', 'length', 'max'=>30),
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
			'name' => '小区名称',
			'region' => '所在地',
			'address' => '地址',
			'zip' => '邮编',
			'property_class' => '建筑类型',
			'developers' => '开发商',
			'building_count' => '建筑楼数量',
			'carport_count' => '车位数量',
			'household_count' => '住户数量',
			'resident_count' => '居民数量',
		);
	}

	public function getPropertyClassName()
	{
		return self::propertyClass($this->property_class, '未知');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BasicInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function propertyClasses()
	{
		return self::$_propertyClasses;
	}

	public static function propertyClass($key, $default = null)
	{
		return array_key_exists($key, self::$_propertyClasses) ? self::$_propertyClasses[$key] : $default;
	}
}
