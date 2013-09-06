<?php
class Region extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Region the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'region';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, slug, name, province, level', 'required'),
			array('code, province, city, level', 'numerical', 'integerOnly'=>true),
			array('slug, name', 'length', 'max'=>20),
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
			'code' => 'Code',
			'slug' => 'Slug',
			'name' => 'Name',
			'province' => 'Province',
			'city' => 'City',
			'level' => 'Level',
		);
	}

	public static function code2name($code, $outDelimiter = ', ', $fullName = true)
	{
		$regions = Yii::app()->cache->get('regions');
		if(empty($regions))
		{
			self::refreshCache();
			$regions = Yii::app()->cache->get('regions');
		}
		$rs = preg_split('/\s*,\s*/', trim($code),-1,PREG_SPLIT_NO_EMPTY);
		array_walk($rs, function(&$v, $k) use($regions,$fullName){
			if(array_key_exists($v, $regions))
				$v = $regions[$v]['level'] == 1 ?
					$regions[$v]['name'] :
					($fullName ? "{$regions[$regions[$v]['province']]['name']}／{$regions[$v]['name']}" : "{$regions[$v]['name']}");
			else
				$v = '';
		});
		return implode($outDelimiter, $rs);
	}

	public static function refreshCache()
	{
		if(!Yii::app()->cache)
			throw new CException('系统没有开启缓存服务.');
		$regionListJs = dirname(Yii::app()->getRequest()->getScriptFile()).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'jquery.region.js';
		if(!touch($regionListJs)) throw new CException('Touch js data file error!');
		$jsFileHandler = @fopen($regionListJs, 'w+');
		if(!$jsFileHandler)
			throw new CException('Read data file error!');
		
		$slugCache = array();
		$locationCache = array();
		$data = array(); // JS
		$relation = array(); // JS
		
		$models = Region::model()->findAll(array('order'=>'code ASC'));
		foreach($models as $area)
		{
			$slugCache[$area->slug] = $area->code;
			$area->name = preg_replace('/\r|\n/','', $area->name);
			$locationCache[$area->code] = array('name'=>$area->name, 'level'=>$area->level, 'province'=>$area->province, 'slug'=>$area->slug, 'code'=>$area->code);
			$data[$area->code] = array('name'=>$area->name, 'level'=>$area->level, 'parent'=>$area->level == 1 ? 0 : $area->province);
			if($area->level == 1)
			{
				$relation[0][] = $area->code;
			}
			elseif($area->level == 2)
			{
				$relation[$area->province][] = $area->code;
			}
		}
		$jsFileContent = "(function($){ $.extend({region:{";
		$jsFileContent .= "data : " . json_encode($data) . ",relation : " . json_encode($relation);
		$jsFileContent .= "}});})(jQuery);";
		@fwrite($jsFileHandler, $jsFileContent);
		@fclose($jsFileHandler);
		Yii::app()->cache->set('regionSlug', $slugCache, 3600*24*365);
		Yii::app()->cache->set('regions', $locationCache, 3600*24*365);
		return true;
	}

	public static function info($code, $default = null)
	{
		if(Yii::app()->cache)
		{
			$rs = Yii::app()->cache->get('regions');
			if(empty($rs))
			{
				self::refreshCache();
				$rs = Yii::app()->cache->get('regions');
			}
			return array_key_exists($code, $rs) ? $rs[$code] : (isset($default) ? $default : null);
		}
		else
		{
			$industry = self::model()->findByPk($code);
			return empty($industry) ? null : array('slug'=>$industry->slug, 'name'=>$industry->iname, 'level'=>$industry->level, 'sect'=>$industry->sect, 'sort'=>$industry->sort, 'code'=>$industry->icode);
		}
	}
	
	public static function children($code = '')
	{
		if(Yii::app()->cache)
		{
			$rs = Yii::app()->cache->get('regions');
			if(empty($rs))
			{
				self::refreshCache();
				$rs = Yii::app()->cache->get('regions');
			}
			$return = array();
			foreach($rs as $key => $i)
			{
				if(empty($code))
				{
					if($i['level'] == 1)
						$return[$key] = $i;
				}
				else
				{
					if($i['level'] == 2 && $i['province'] == $code)
						$return[$key] = $i;
				}
			}
			return $return;
		}
		else
			throw new CException('系统没有开启缓存服务.');
	}

	public static function slugInfo($slug, $default = null)
	{
		if(Yii::app()->cache)
		{
			$rs = Yii::app()->cache->get('regions');
			if(empty($rs))
			{
				self::refreshCache();
				$rs = Yii::app()->cache->get('regions');
			}
			$ss = Yii::app()->cache->get('regionSlug');
			$code = $ss[$slug];
			return array_key_exists($code, $rs) ? $rs[$code] : (isset($default) ? $default : null);
		}
		else
		{
			$industry = self::model()->findByAttributes(array('slug'=>$slug));
			return empty($industry) ? null : array('slug'=>$industry->slug, 'name'=>$industry->iname, 'level'=>$industry->level, 'sect'=>$industry->sect, 'sort'=>$industry->sort, 'code'=>$industry->icode);
		}
	}
}