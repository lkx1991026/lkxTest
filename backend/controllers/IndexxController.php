<?php
namespace backend\controllers;



use function PHPSTORM_META\type;
use yii\web\Controller;

class IndexxController  extends Controller {
    /**
     * curl方式:发送
     */
    function actionTest01(){
        $url     = 'http://open.aichezaixian.com/route/rest';
        $content = array(
            'method'            => 'jimi.oauth.token.get',
            'timestamp'         => date('Y-m-d H:i:s',time()),
            'app_key'           => '8FB345B8693CCD00D126B8F92445E66F',
            'sign_method'       => 'md5',
            'v'                 => '1.0',
            'format'            => 'json',
            'user_id'           => '成都晟思',
            'user_pwd_md5'      => '21218cca77804d2ba1922c33e0151105',
            'expires_in'        => '7200',
        );
        $secret = '8c5117690cb349d09803357f6aaee371';
        $key    = ['method','timestamp','app_key','sign_method','v','format','user_id','user_pwd_md5','expires_in'];
        $sign   = self::SignArray($content,$secret);   //api签名
        $content['sign'] = $sign;
        $response   =  $this->request($url,$content);
        var_dump($response);die;
        $result     = json_decode($response, true);
        return $result;
    }

    /**
     * 请求接口
     * @param $url
     * @param $params
     * @return mixed
     */
    function request($url,$params){
        $ch = curl_init();
        $this_header = array("Context-Type:application/x-www-form-urlencoded;charset=utf-8");
        curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//如果不加验证,就设false,商户自行处理
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $output = curl_exec($ch);

        curl_close($ch);
        return  $output;
    }

    /**
     * 将参数数组签名
     */
    public static function SignArray($array,$secret){
		// 将key放到数组中一起进行排序和组装
        ksort($array);
        $blankStr  = self::ToUrlParams($array);
		echo $blankStr;exit;
        $autograph = $secret.$blankStr.$secret;

        $sign = md5($autograph,false);

        return $sign;
    }

    /**
     * 对参数排名组成字符串
     * @param array $array
     * @return string
     */
    public static function ToUrlParams(array $array)
    {
        $buff = "";
        foreach ($array as $k => $v) {
            if($v != "" && !is_array($v)){
                $buff .= $k  . $v ;
            }
        }
        return $buff;
    }
}
