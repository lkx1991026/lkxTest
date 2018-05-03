<?php
/* @var $this yii/web/View */

$form=\yii\widgets\ActiveForm::begin([
	'options'=>['class'=>'form-inline'],

]);
?>
<div class="form-group form-inline">
	<label class="control-label">身份证</label>
	<input type="number" name="idcard" placeholder="请输入身份证号" class="form-control"/>
	<div class="help-block"></div>
</div>
<?= \yii\helpers\Html::submitButton('提交',['class'=>'btn btn-default']);?>
<?php \yii\widgets\ActiveForm::end();?>



