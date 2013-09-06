<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'小区物业管理系统',
	'language'=>'zh_cn',
	'timeZone'=>'Asia/Shanghai',
	'charset'=>'utf-8',
	'defaultController'=>'manage',

	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abd',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
			'allowAutoLogin'=>false,
			'loginUrl'=>array('//manage/login'),
		),
		'urlManager'=>array(
			'showScriptName'=>false,
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=property_management',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'techcentos',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			'errorAction'=>'manage/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'cache' => array(
				'class' => 'system.caching.CFileCache',
				'keyPrefix'=>'a3076a930491163e4c9b8550c0fbae6c',
		),
	),
	'params'=>array(
		'infoId'=>'10000',
	),
);