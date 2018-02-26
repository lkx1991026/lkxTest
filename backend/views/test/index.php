
<?php
/* @var $this yii\web\View */
?>
<a id="click" href="javascript:;">点我</a>
<?php
$this->registerJsFile('@web/plugins/layui/layui/layui.all.js');
$js=<<<JS
    $('#click').on('click',function() {
        layer.open({type:4,content:'hello'});
    })
JS;
$this->registerJs($js);

