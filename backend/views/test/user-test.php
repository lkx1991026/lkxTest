<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1
 * Time: 11:58
 */
/*
 * @var $this yii\web\View
 */
$from=\yii\widgets\ActiveForm::begin([
	'action'=>'user-test',
	'method'=>'post',
	'options'=>[
		'class'=>'layui-form'
	]
]);
echo $from->field($model,'username')->textInput(['class'=>'layui-input layui-inline']);
echo $from->field($model,'nickname')->textInput(['class'=>'layui-input layui-inline','id'=>'nickname']);
echo \yii\helpers\Html::submitButton('提交',['class'=>'layui-input-btn layui-inline']);
\yii\widgets\ActiveForm::end()
?>

