
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 17:15
 */
$form = \yii\widgets\ActiveForm::begin([
	'options' => ['class' => 'form-inline'],
	'action' => ['test'],
	'method' => 'post',
]);

?>
<textarea name="data"></textarea>
<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-default']);
\yii\widgets\ActiveForm::end();

