<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 11:16
 */

namespace backend\controllers;

use app\models\CrmLog;
use app\models\PCount;
use backend\models\BidataChannelApply;
use backend\models\BidataChannelStats;
use backend\models\BidataEarnings;
use backend\models\BidataEarningsSearch;
use backend\models\BidataProductStats;
use backend\models\BidataStats;
use backend\models\BidataStatsSearch;
use backend\models\UserCount;
use backend\models\UserTest;
use common\helpers\car\Che300;
use common\helpers\DateHelper;
use common\models\WxxCity;
use function GuzzleHttp\Psr7\str;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TestController extends Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionStatistics()
	{
		$admin_logs = CrmLog::find()
			->groupBy('manager_name')
			->indexBy('manager_name')
			->select(['manager_name', 'count(id)'])
			->asArray()
			->all();
		return $this->render('statistics', ['data' => $admin_logs]);
	}

	public function actionChannel()
	{
		if (\Yii::$app->request->isAjax && $date = \Yii::$app->request->get('date')) {
			if (isset($date) && strpos($date, ' - ') !== false) {
				list($start_time, $end_time) = explode(' - ', $date);
				$start_time = strtotime($start_time);
				$end_time = strtotime($end_time) + 86399;
			}

//		echo $start_time;exit;
			$data = PCount::find()
				->where(['between', 'time', $start_time, $end_time])
				->select(['time', 'channel_id'])
				->orderBy('time ASC')
				->asArray()
				->all();
			$template = [];
			$legend = [];
//		var_dump($data);exit;
			foreach ($data as $val) {
				$date = date('Y-m-d', $val['time']);
				if (!isset($template[$date][$val['channel_id']])) {
					$template[$date][$val['channel_id']] = 1;
				} else {
					$template[$date][$val['channel_id']] += 1;
				}

				if (!in_array($val['channel_id'], $legend)) {
					$legend[] = (string)$val['channel_id'];
				}
			}
//			sort($legend,SORT_ASC);
			$data = [];
			foreach ($legend as $val) {
				$sub_data = [];
				foreach ($template as $v) {
					if (isset($v[$val])) {
						$sub_data[] = $v[$val];
					} else {
						$sub_data[] = 0;
					}
				}
				$data[] = [
					'name' => $val,
					'type' => 'line',
					'data' => $sub_data
				];
			}

			$keys = array_keys($template);
//		var_dump($data);exit;
			$datas = ['legend' => $legend, 'data' => $data, 'keys' => $keys];
//			var_dump(json_encode($datas));exit;
			return json_encode($datas);
		}

		return $this->render('statistics');
	}

	public function actionTest()
	{
		if ($data = \Yii::$app->request->post('data')) {
			$arr = explode("+", $data);
			var_dump(array_values($arr));
		}
		return $this->render('test');
	}

	public function actionUser()
	{
		$date = \Yii::$app->request->get('date');
		if (isset($date) && strpos($date, ' - ') !== false) {
			list($start_time, $end_time) = explode(' - ', $date);
			$start_time = strtotime($start_time);
			$end_time = strtotime($end_time);
		}else{
			$start_time=strtotime('-7 day');
			$end_time=strtotime(date('Y-m-d'));
		}
		$model=UserCount::find()
			->where(['between','time',$start_time,$end_time])
			->orderBy('time ASC')
			->groupBy('date')
			->indexBy('date')
			->select(['FROM_UNIXTIME(time,"%Y-%m-%d") date','count(*)']);
		$register_user_count=(clone $model)->andWhere(['type'=>1])->asArray()->all();
		$login_user_count=(clone $model)->andWhere(['type'=>0])->asArray()->all();
		$day_list=DateHelper::getDaylist($start_time,$end_time);
		$legend=['????','????'];
		$template=[];
		$register=[];
		$login=[];
		foreach($day_list as $day){

			if(isset($register_user_count[$day]['count(*)'])){
				$register[]=$register_user_count[$day]['count(*)'];
			}else{
				$register[]=0;
			}
			if(isset($login_user_count[$day]['count(*)'])){
				$login[]=$login_user_count[$day]['count(*)'];
			}else{
				$login[]=0;
			}
		}

		$template=[
			[
				'name'=>'????',
				'data'=>$login,
				'type'=>'bar'
			],
			[
				'name'=>'????',
				'data'=>$register,
				'type'=>'bar'
			]

		];
//		var_dump($template);exit;
		return $this->render('user',['legend'=>json_encode($legend),'data'=>json_encode($template),'day_list'=>json_encode($day_list)]);
	}
	public function actionUserTest(){
		$a=[['name'=>'zhangsan','age'=>'lisi','sex'=>'1']];
		foreach($a as &$v){
			$v['sex']=$v['sex']?'男':'女';
		}
		var_dump($a);
	}
	public function actionEarnings(){
		$searchModel=new BidataEarningsSearch();
		$dataProvider=$searchModel->search(\Yii::$app->request->queryParams);
		$data=BidataEarnings::find()->where(['between','day_str',date('Ymd',strtotime('-30 day')),date('Ymd',strtotime('-1 day'))])->select(['day_str','platform_day_earnings'])->asArray()->orderBy('day_str ASC')->all();
		$array=ArrayHelper::map($data,'day_str','platform_day_earnings');
		$total_earnings=0;

		foreach(array_values($array) as $v){
			$total_earnings+=$v;
		}
		$avg_earnings=sprintf('%.2f',$total_earnings/count($data));
		$data=['keys'=>json_encode(array_keys($array)),'value'=>json_encode(array_values($array))];
		return $this->render('test',['data'=>$data,'total'=>$total_earnings,'avg'=>$avg_earnings,'dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
	}
	public function actionTotal(){
		$data=BidataEarnings::find()->where(['between','day_str',date('Ymd',strtotime('-30 day')),date('Ymd',strtotime('-1 day'))])->select(['day_str','num_uv','num_register_user','num_active_user'])->asArray()->orderBy('day_str ASC')->all();
		$template=[
			[
				'name'=>'访客数量(uv)',
				'type'=>'line',
				'smooth'=> true,
			],

			[
				'name'=>'活跃用户',
				'type'=>'line',
				'smooth'=> true,
			],
			[
			'name'=>'新增注册',
			'type'=>'line',
			'smooth'=> true,
		],
		];

		$legend=['访客数量(uv)','活跃用户','新增注册'];
		$keys=[];
		foreach($data as $v){
			$keys[]=$v['day_str'];
			$template[0]['data'][]=$v['num_uv'];
			$template[1]['data'][]=$v['num_active_user'];
			$template[2]['data'][]=$v['num_register_user'];
		}
		$searchModel=new BidataStatsSearch();
		$dataProvider=$searchModel->search(\Yii::$app->request->queryParams);
		return $this->render('total',['legend'=>json_encode($legend),'data'=>json_encode($template),'keys'=>json_encode($keys),'searchModel'=>$searchModel,'dataProvider'=>$dataProvider]);
	}
	public function actionPromote(){

		//子查询查询产品平均收益
		$sub_model=BidataProductStats::find()
			->select(['product_id','avg(one_apply_earning) avg_apply_earning'])
			->where(['between','day_str',date('Ymd',strtotime('-30 day')),date('Ymd',strtotime('-1 day'))])
			->groupBy('product_id');
//		var_dump($sub_model);exit;
		$model=BidataChannelApply::find()
			->from('bidata_channel_apply a')
			->where(['between','a.day_str',date('Ymd',strtotime('-7 day')),date('Ymd',strtotime('-1 day'))])
			->leftJoin(['b'=>$sub_model],'b.product_id=a.product_id')
			->leftJoin('bidata_channel_register c','c.user_name=a.user_name');
		//计算预估收益前十的渠道
		$data=(clone $model)
			->select('c.channel_id,b.avg_apply_earning*count(a.user_name) earnings')
			->groupBy('c.channel_id')
			->orderBy('earnings DESC')
			->limit(10);
			echo $data->createCommand()->rawSql;exit;
		//计算前十渠道对应每天的预估收益
		$rank=(clone $model)
			->andWhere(['channel_id'=>$data])
			->select('c.channel_id,b.avg_apply_earning*count(a.user_name) earnings,a.day_str,channel_name')
			->groupBy('c.channel_id,a.day_str')
			->asArray()
			->all();
		var_dump($rank);
	}
	public function XXX($arr,$key){//第一个参数是一个二维数组,第二个参数是一个键
		$tmp_arr=[];//保存这个二维数组下的所有一维数组中键为$key的元素值
		foreach($arr as $k=>$v){//循环这个二维数组,注意区别这里的$k和$v分别是什么
			if(in_array($v[$key],$tmp_arr)){//在循环出的子元素中,也就是普通的一维数组中找键为$key的元素并判断是否存在于$tmp_arr中,存在就直接将整个$v删除掉
				unset($arr[$k]);
			}else{
				$tmp_arr[]=$v[$key];//不存在的话就存到里面,作为之后循环的去重的元素
			}
		}
		return $arr;
	}
	public function actionXxx(){
		return $this->render('xxx');
	}
	public function actionDecode($code){
		static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
		if (strrpos($code, '0') !== false)
			$code = substr($code, strrpos($code, '0')+1);
		$len = strlen($code);
		$code = strrev($code);
		$num = 0;
		for ($i=0; $i < $len; $i++) {
			$num += strpos($source_string, $code[$i]) * pow(35, $i);
		}
		return $num;
	}
	public function actionTable(){
		$result=(new Query())->from('department')->select(['name','description','create_time','sort'])->orderBy(['sort'=>SORT_ASC,'create_time'=>SORT_DESC])->all();
		return $this->render('table',['data'=>$result]);
	}
	public function actionHongbao($amount,$num=10){

		$total=0;
		for($i=1;$i<=$num;$i++){
			$rand_max=doubleval(($amount-$total)/($num-$i+1)*2);
			if($i<$num){
				$rand=doubleval(rand(1,$rand_max*100)/100);

				$total+=$rand;

			}else{
				return ($amount-$total);
			}

		}
	}
	public function actionRecures(){
		for($i=0;$i<=100;$i++){
			echo self::actionHongbao(100,10).'<br>';
		}
	}
	public function actionIsIdcard()
	{
		if(\Yii::$app->request->isPost){
			$id = strtoupper($_POST['idcard']);
			$regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
			$arr_split = array();
			if(!preg_match($regx, $id))
			{
				return 0;
			}
			if(15==strlen($id)) //检查15位
			{
				$regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

				@preg_match($regx, $id, $arr_split);
				//检查生日日期是否正确
				$dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
				if(!strtotime($dtm_birth))
				{
					return 0;
				} else {
					return 1;
				}
			}
			else      //检查18位
			{
				$regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
				@preg_match($regx, $id, $arr_split);
				$dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
				if(!strtotime($dtm_birth)) //检查生日日期是否正确
				{
					return 0;
				}
				else
				{
					//检验18位身份证的校验码是否正确。
					//校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
					$arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
					$arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
					$sign = 0;
					for ( $i = 0; $i < 17; $i++ )
					{
						$b = (int) $id{$i};
						$w = $arr_int[$i];
						$sign += $b * $w;
					}
					$n = $sign % 11;
					$val_num = $arr_ch[$n];
					if ($val_num != substr($id,17, 1))
					{
						return 0;
					}
					else
					{
						return 1;
					}
				}
			}
		}else{
			return $this->render('isidcard');///testeste
		}

	}

}