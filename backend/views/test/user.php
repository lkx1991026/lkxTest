<?php
/* @var $this yii\web\View */
?>
	<div class="ad-search">

		<?php $form = \yii\widgets\ActiveForm::begin([
			'options' => ['class' => 'form-inline'],
			'action' => ['user'],
			'method' => 'get',
		]); ?>
		<div class="layui-group">
			<div class="layui-inline pull-left" style="width: 200px;">
				<input type="text" name="date" placeholder="请输入" autocomplete="off" class="layui-input" id="date">
			</div>
            <div class="layui-inline pull-left">
                <input type="text" name="keyword" class="layui-input" placeholder="请输入关键字搜索"/>
            </div>
			<span class="layui-btn-group" style="border-left: 100px;">
                    <button class="layui-btn pull-left layui-anim layui-anim-scaleSpring " >立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary pull-left">重置</button>
            </span>
		</div>
	</div>
<?php \yii\widgets\ActiveForm::end(); ?>


	<div id="echarts" style="height: 800px; border: dashed 1px red;"></div>
<?php
$this->registerJsFile('@web/plugins/layui/layui/layui.js');
$this->registerCssFile('@web/plugins/layui/layui/css/layui.css');
$this->registerJsFile('@web/plugins/echarts/echarts.js');
$url=\yii\helpers\Url::toRoute('channel');
$js = <<<JS
	var myChart=echarts.init(document.getElementById('echarts'));
	var option = {
			xAxis: {
				// type: 'manager_name',
				data:$day_list,
			},
			yAxis: {
				type: 'value'
			},
			legend:{
			    data:$legend//显示右上角选择显示或者隐藏
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
			series: $data,
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

