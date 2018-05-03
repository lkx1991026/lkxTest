<?php
/* @var $this yii\web\View */
?>
<head>
</head>
<body>
    <table id="myTable">

        <?php foreach($data as $v):?>
            <tr>
                <td><?=$v['user_name']?></td>
            </tr>
        <?php endforeach;?>

    </table>
</body>

<?php
$this->registerCssFile('@web/sortable/css/base/jquery-ui-1.9.2.custom.min.css');
$this->registerJsFile('@web/sortable/js/jquery-1.8.3.js');
$this->registerJsFile('@web/sortable/js/jquery-ui-1.9.2.custom.min.js');

$js = <<<JS
        $(function() {
          $('#myTable').sortable();
        })
        

JS;
$this->registerJs($js);

