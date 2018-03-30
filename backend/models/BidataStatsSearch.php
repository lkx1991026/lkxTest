<?php
namespace backend\models;

use yii\data\ActiveDataProvider;

class BidataStatsSearch extends BidataStats{
	public function search($params){
		$query=BidataStats::find();
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
		$query->andWhere(['between','day_str',$start_time,$end_time])
			->andFilterWhere(['app_id'=>$this->app_id])
			->andFilterWhere(['front'=>$this->front])
			->groupBy('day_str')
			->orderBy('day_str ASC')
			->select([
				  'day_str',
				  'sum(num_pv) num_pv',
				  'sum(num_uv) num_uv',
				  'sum(num_register_user) num_register_user',
				  'sum(num_active_user) num_active_user',
				  'sum(num_pv_product) num_pv_product',
				  'sum(num_uv_product) num_uv_product',
				  'sum(num_apply_product) num_apply_product',
				  'sum(num_click_director) num_click_director',
				  'sum(num_uv_director) num_uv_director',
				  'sum(num_contact_director) num_contact_director',
				  'sum(num_click_creditcard) num_click_creditcard',
				  'sum(num_uv_creditcard) num_uv_creditcard',
				  'sum(num_apply_creditcard) num_apply_creditcard',
			]);
		return $dataprovider;
	}
}