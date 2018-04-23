<?=$form->field($model,'yanCaptchaValidate')->widget(\webroot\common\widgets\yanCaptcha\YanCaptchaWidget::className(),[
	'app_id'=>xxx,
	'pattern'=>'static',
	'width'=>300,
	'api_server'=>'api.yanphp.com'
])->label(false)?>