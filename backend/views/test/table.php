<?php
/* @var $this yii\web\View */
?>
<form class="xx" action="<?=\yii\helpers\Url::toRoute(['table'])?>" method="post" enctype="multipart/form-data">
    1.<input type="file" name="av" value=""/>
    2.<input type="text" name="xx" value="2"/>
    3.<input type="text" name="xx" value="3"/>
    <input type="submit" value="提交">
</form>
<?php
$js=<<<JS
    $(function() {
     var change=function() {
        $('.xx input:not([name=remark])').each(function() {
        console.log($(this).val());
        })
        console.log($(".xx").html());
     }
     $('input').blur(change);
    })
    
JS;
$this->registerJs($js);
