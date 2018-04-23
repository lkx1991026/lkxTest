<?php
/* @var $this yii\web\View */
use \yii\web\JsExpression;
use \kartik\select2\Select2;
?>

    <!---->
    <div></div>
    <div id="echarts" style="height: 600px;"></div>
<!--    <div class="ad-search">-->

<!--		--><?php //$form = \yii\widgets\ActiveForm::begin([
//			'options' => ['class' => 'form-inline layui-form inline'],
//			'action' => 'total',
//			'method' => 'get',
//		]); ?>
<!--        <div class="layui-group">-->
<!--            <div class="layui-inline pull-left" style="width: 200px;">-->
<!--                <input type="text" name="date" placeholder="请输入"-->
<!--                       autocomplete="off" class="layui-input" id="date"-->
<!--                       value="--><?//= Yii::$app->request->get('date') ?><!--"/>-->
<!--            </div>-->
<!--			--><?//= $form->field($searchModel, 'app_id')->dropDownList(Yii::$app->params['app_list'], ['prompt' => '全部']) ?>
<!--			--><?//= Select2::widget([
//				'name' => 'filter[front]',
//				'options' => ['placeholder' => '请选择前端'],
//				'data' => Yii::$app->params['app_front_list'],
//				'theme' => Select2::THEME_BOOTSTRAP,
//
//				'pluginOptions' => [
//					'allowClear' => true,
//					'width' => '255px',
//					'multiple' => true,
//				],
//            ])
//			 ?>
<!--            <span class="layui-btn-group" style="border-left: 100px;">-->
<!--                <button class="layui-btn pull-left layui-anim layui-anim-scaleSpring layui-anim-loop "-->
<!--                        id="ajax-submit">立即提交</button>-->
<!--                <button type="reset"-->
<!--                        class="layui-btn layui-btn-primary pull-left">重置</button>-->
<!--            </span>-->
<!--        </div>-->
<!--    </div>-->
<?php //\yii\widgets\ActiveForm::end(); ?>
<!--    <div class="box-body">-->

<!--		--><?//= \yii\grid\GridView::widget([
//			'dataProvider' => $dataProvider,
//			//'filterModel' => $searchModel,
//			'columns' => [
//				'day_str',
//				'num_pv',
//				'num_uv',
//				'num_register_user',
//				'num_active_user',
//				'num_pv_product',
//				'num_uv_product',
//				'num_apply_product',
//			],
//		]); ?>
<!--    </div>-->

<?php
//$this->registerJsFile('@web/plugins/layui/layui/layui.js');
//$this->registerCssFile('@web/plugins/layui/layui/css/layui.css');
$this->registerJsFile('@web/plugins/echarts/echarts.js');
$url = \yii\helpers\Url::toRoute('weather');
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
			series: $data,
            legend:{
			     x: 'left',  
                inactiveColor: '#999',  
                selectedMode: 'multiple',  
                orient: 'vertical',  
                width: 150,
                top: 50,  
                borderWidth: 2,  
                borderColor: 'blue',  
                textStyle: {  
                    color: '#000'  
                },
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
            title: {
                    text:'近30日总收益平均收益'
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

