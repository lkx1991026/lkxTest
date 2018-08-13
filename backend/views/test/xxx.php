<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 10:48
 */
/* @var $this yii\web\View */
$js=<<<JS

$(function()
{
    
    setInterval(show,1000);
	function show() {
      	console.log(111);
}
    
});
JS;
$this->registerJs($js);
