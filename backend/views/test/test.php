<?php
/* @var $this yii\web\View */
?>
    <div class="ad-search">

		<?php $form = \yii\widgets\ActiveForm::begin([
			'options' => ['class' => 'form-inline layui-form inline'],
			'action' => 'earnings',
			'method' => 'get',
		]); ?>
        <div class="layui-group">
            <div class="layui-inline pull-left" style="width: 200px;">
                <input type="text" name="date" placeholder="请输入" autocomplete="off" class="layui-input" id="date" value="<?=Yii::$app->request->get('date')?>">
            </div>
            <span class="layui-btn-group" style="border-left: 100px;">
                    <button class="layui-btn pull-left layui-anim layui-anim-scaleSpring layui-anim-loop " id="ajax-submit" >立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary pull-left">重置</button>
            </span>
        </div>
    </div>
<?php \yii\widgets\ActiveForm::end(); ?>

    <div></div>
    <div id="echarts" style="height: 500px;"></div>
    <div class="box-body">

		<?= \yii\grid\GridView::widget([
			'dataProvider' => $dataProvider,
			//'filterModel' => $searchModel,
			'columns' => [
				'day_str',
				'num_uv',
				'num_register_user',
				'num_active_user',
				'num_pv_product',
				'num_uv_product',
				'num_apply_product',
				'platform_day_earnings',
				'each_uv_earnings',
				'each_apply_earnings'
			],
		]); ?>
    </div>

<?php
$this->registerJsFile('@web/plugins/layui/layui/layui.js');
$this->registerCssFile('@web/plugins/layui/layui/css/layui.css');
$this->registerJsFile('@web/plugins/echarts/echarts.js');
$url=\yii\helpers\Url::toRoute('weather');
$keys=$data['keys'];
$value=$data['value'];
$js = <<<JS
	var myChart=echarts.init(document.getElementById('echarts'));
	var option = {
			xAxis: {
				// type: 'manager_name',
				data:$keys
			},
			yAxis: {
				type: 'value'
			},
			series: [{
                    data: $value,
                    type: 'line',
                    smooth: true,
                    name:'收益',
                    markLine : {
	                    		data : [
	                    		        {type : 'average', name: '平均值'}
	                    		        
	                    		]
	                    	}
                }],
            legend:{
			    data:['收益']//显示右上角选择显示或者隐藏
			},
			toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
			tooltip:{
                //坐标轴触发，主要用于柱状图，折线图等(鼠标放上去有具体数据显示)
                trigger:'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            title: {
                    text:'近30日总收益$total 平均收益$avg'
                },
			dataZoom: [{
               
            }, {
                type: 'inside'
            }],
		};

	myChart.setOption(option);
	layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //执行一个laydate实例
      laydate.render({
        elem: '#date', //指定元素
        range:true
      });
    });
	
JS;
$this->registerJs($js);

