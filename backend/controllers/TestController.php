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
use backend\models\UserCount;
use backend\models\UserTest;
use common\helpers\car\Che300;
use common\helpers\DateHelper;
use common\models\WxxCity;
use function GuzzleHttp\Psr7\str;
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
		$legend=['登录用户','注册用户'];
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
				'name'=>'登录用户',
				'data'=>$login,
				'type'=>'bar'
			],
			[
				'name'=>'注册用户',
				'data'=>$register,
				'type'=>'bar'
			]

		];
//		var_dump($template);exit;
		return $this->render('user',['legend'=>json_encode($legend),'data'=>json_encode($template),'day_list'=>json_encode($day_list)]);
	}
	public function actionUserTest(){
		$model=new UserTest();

		return $this->render('user-test',['model'=>$model]);
	}
	public function actionWeather($n){
		echo $n.' ';
		if($n>0){
			$this->actionWeather($n-1);
		}
	}
}