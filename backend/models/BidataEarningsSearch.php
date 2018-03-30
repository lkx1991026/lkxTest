<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/26
 * Time: 15:44
 */
namespace backend\models;

use yii\data\ActiveDataProvider;

class BidataEarningsSearch extends BidataEarnings {
	public function rules(){
		return [
			['day_str','string','max'=>255]
		];
	}
	public function search($params){
		$query=BidataEarnings::find();
		$dataprovider=new ActiveDataProvider([
			'query'=>$query,
		]);
		$this->load($params);
		if(!$this->validate()){
			return $dataprovider;
		}
		$date=$params['date']??'';
		if(isset($date) && strpos($date,' - ')!==false){
			list($start_time,$end_time)=explode(' - ',$date);
			$start_time=str_replace('-','',$start_time);
			$end_time=str_replace('-','',$end_time);
		}else{
			$start_time=date('Ymd',strtotime('-30 day'));
			$end_time=date('Ymd',strtotime('-1 day'));
		}
		$query->andWhere(['between','day_str',$start_time,$end_time]);
		$query->groupBy('day_str')
			->select(
				[
					'day_str',
					'num_uv',
					'num_register_user',
					'num_active_user',
					'num_pv_product',
					'num_uv_product',
					'num_apply_product',
					'round(platform_day_earnings,2) platform_day_earnings',
					'round(each_uv_earnings,2) each_uv_earnings',
					'round(each_apply_earnings,2) each_apply_earnings'
				]
			);
//		echo $query->createCommand()->rawSql;
		return $dataprovider;
	}
}