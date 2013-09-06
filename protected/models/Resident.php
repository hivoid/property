<?php

/**
 * This is the model class for table "resident".
 *
 * The followings are the available columns in table 'resident':
 * @property string $id
 * @property string $household_id
 * @property string $name
 * @property string $sex
 * @property string $rel_with_householder
 * @property string $birthday
 * @property string $id_no
 * @property integer $nation
 * @property integer $education
 * @property string $phone
 * @property integer $status
 * @property string $crt_by
 * @property string $crt_time
 * @property string $up_by
 * @property string $up_time
 */
class Resident extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resident';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('household_id, name, sex, rel_with_householder, birthday', 'required'),
			array('nation, education, status', 'numerical', 'integerOnly'=>true),
			array('household_id, crt_by, up_by', 'length', 'max'=>10),
			array('name, rel_with_householder, phone, crt_time, up_time', 'length', 'max'=>20),
			array('sex', 'length', 'max'=>1),
			array('id_no', 'length', 'max'=>18),
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
			'name' => '姓名',
			'sex' => '性别',
			'rel_with_householder' => '与户主关系',
			'birthday' => '出生日期',
			'id_no' => '身份证号',
			'nation' => '民族',
			'education' => '教育程度',
			'phone' => '联系电话',
			'status' => '状态',
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
	 * @return Resident the static model class
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
