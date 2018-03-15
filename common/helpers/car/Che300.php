<?php
/**
 * 车300接口类
 */
namespace common\helpers\car;

use yii\httpclient\Client;

class Che300 {
	/**
	 * 参数配置
	 * @var array
	 * @access private
	 */
	private $config;

	public function __construct() {
		$this->config = \Yii::$app->params['car_config']['che300'];
	}

	/**
	 * 根据vin获取车辆信息
	 */
	public function getInfoByVin($vin='LFV3A24F3A3026881')
	{
		$url = $this->config['api_url'] . "/service/identifyModelByVIN?vin=LFV3A24F3A3026881&token=" . $this->config['token'];
		$this->httpRequest($url, '', 'GET');
	}

	/**
	 * 根据vin获取车辆列表
	 */
	public function getModelListByVin($vin)
	{
		$url = $this->config['vin_model_list_url'] . '?token='.$this->config['token'] .'&vin='.$vin;
		$response = $this->httpRequest($url, '', 'GET');
		if (isset($response['status']) && $response['status'] == 0){
			return $response['error_msg'];
		}
		return is_array($response['modelInfo']) ? $response['modelInfo'] : [];
	}

	/**
	 * 详细配置
	 */
	public function getModelParameters($modelId)
	{
		$url = $this->config['parameters_url'] . '?token='.$this->config['token'] .'&modelId='.$modelId;
		$response = $this->httpRequest($url, '', 'GET');
		dump($response);
	}

	/**
	 * 估价
	 * modelId 车型ID
	 * regDate 车辆上牌日期，如2012-01
	 * mile 车辆行驶里程，单位是万公里
	 * zone 城市id 默认成都22
	 */
	public function getPrice($data = [])
	{
		$params = [
			'token' => $this->config['token'],
			'zone' => 22,
			'color' => '白色', //默认白色
			'interior' => '优', //内饰状况（中文），可选列表：优、良、中、差
			'surface' => '优', //漆面状况（中文），可选列表：优、良、中、差
			'work_state' => '优', // 工况状况（中文），可选列表：优、良、中、差
		];
		$url = $this->config['price_url'] . '?' . http_build_query(array_merge($params, $data));
		$response = $this->httpRequest($url, '', 'GET');
		return $response;
	}

	private function httpRequest($url, $json_string = '', $method = 'POST')
	{
		$response = (new Client([
			'transport' => 'yii\httpclient\CurlTransport'
		]))
			->createRequest()
			->setMethod($method)
			->setOptions([
				CURLOPT_CONNECTTIMEOUT => 15,
				CURLOPT_TIMEOUT => 15,
			])
			->setUrl($url)
			->setHeaders(['Content-Type: application/json'])
			->setContent($json_string)
			->send();
		$result = json_decode($response->content, true);
		if(!$result){
			throw new \Exception('che300  cURL Error #: url->'. $url .' msg->' . $response->content);
		}
		return $result;
	}

}