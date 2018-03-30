<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	//车辆查询配置
	'car_config' => [
		'che300' => [
			'token' => '08bee6600d708526085b8262c01ed8cc',
			'api_url' => 'http://api.che300.com',
			'vin_model_list_url' => 'http://api.che300.com/service/identifyModelByVIN', //根据vin获取车型列表
			'parameters_url' => 'http://api.che300.com/service/getModelParameters', //详细配置
			'price_url' => 'http://api.che300.com/service/eval/getUsedCarPriceAnalysis', //估价
		],
	],
	'app_list' => [
		0 => '淘钱宝',
		1 => '借钱快',
		2 => '借无忧',
		3 => '智融贷',
	],
	'app_front_list' => [
		0 => 'PC(淘钱宝)',
		1 => 'WAP(淘钱宝)',
		2 => 'IOS',
		3 => 'ANDROID',
		4 => 'WECHAT',
		5 => '小程序(借钱快贷款平台)',
		6 => '小程序(淘钱宝极速借钱)',
		7 => '小程序(征信查询助手)',
		8 => 'PC(智融贷)',
		9 => 'WAP(智融贷)',
	],
];
