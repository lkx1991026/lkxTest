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
];
