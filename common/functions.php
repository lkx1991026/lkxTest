<?php


use common\models\City;
/**
 * @name 扩展Thinkphp的dump()函数，便于数组等的直观调试
 * @param unknown $var
 * @param string $echo
 * @param string $label
 * @param string $strict
 * @return NULL|string
 */

if (!function_exists('uuid_create')) {
    function uuid_create() {
        return md5(time() . uniqid('', true));
    }
}
if (!function_exists('dump')) {
    function dump($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }
}

/**
 * 打印Yii2 SQL语句
 * @param unknown $query
 */
function dumpSql($query){
    if($query){
        $commandQuery = clone $query;
        dump($commandQuery->createCommand()->getRawSql());
    }
}






/**
 *
 * @name 抓取接口Https函数
 * @param unknown $type 1返回json格式 2返回数组格式
 * @param unknown $data post提交数据
 * @param unknown $url post提交地址
 * @return mixed|unknown
 */
function Mycurl($type, $data, $url)
{
    $timeout = 5;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    //if ($SSL && $CA) {
    //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
    //    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 检查证书中是否设置域名（为0也可以，就是连域名存在与否都不验证了）
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);   // 只信任CA颁布的证书
        //curl_setopt($ch, CURLOPT_CAINFO, $cacert); // CA根证书（用来验证的网站证书是否是CA颁布）
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配
    //} else if ($SSL && !$CA) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
    //}
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); //避免data数据过长问题
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); //data with URLEncode
    $file_contents = curl_exec($ch);
    //	var_dump(curl_error($ch));  //查看报错信息
    curl_close($ch);
    if ($type == 1) {
        return $file_contents;
    } elseif ($type == 2) {
        $data = json_decode($file_contents, true);
        return $data;
    } else {
        return $file_contents;
    }
}


/**
 * @name 抓取接口函数
 * @param unknown $type 1返回json格式 2返回数组格式
 * @param unknown $data post提交数据
 * @param unknown $url post提交地址
 * @return mixed|unknown
 */
function Mycurl_http($type,$data,$url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1); // 启用POST提交
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $file_contents = curl_exec($ch);
    curl_close($ch);
    if ($type==1) {
        return $file_contents;
    }elseif ($type==2){
        $data = json_decode($file_contents,true);
        return $data;
    }else{
        return $file_contents;
    }
}



/**
 * 格式化字符串
 * @param string $str 源字符串
 * @param int $len 长度
 * @param string $symbols 格式化字符
 */
function Format($str,$len,$symbols){
    return preg_replace('/(\d{'.$len.'})(?=\d)/','$1'.$symbols,$str);
}



/**
 * 设置选择器数据
 * @param unknown $unit
 * @return string
 */
function dateY($start,$end,$unit){
    for($i=$start;$i<=$end;$i++){
        $dateY[$i] = $i.$unit;
    }
    return $dateY;
}

/**
 * 字符串A-Z转数组
 * @return string
 */
function charlist(){
    $str = "@ABCDEFGHIJKLMNOPQRSTUVWXYZ#";
    for($i=0;$i<strlen($str);$i++){
        $arr[$i] = $str[$i];
    }
    return $arr;
}



/**
 * 字符是否在字符串中
 * @param unknown $str
 * @param unknown $string
 * @param string $commas
 */
function stringIn($str,$string,$commas = ','){
    return in_array($str,explode($commas,$string));
}



/**
 * 解析参数成最小字符串链接
 * @param unknown $data
 * @return unknown
 */
function partsSearch($data){
    foreach ($data as $n=>$Item){
        foreach ($Item as $k=>$m){
            //如果是数组，则组合成字符串再连接
            is_array($m)?$arr[$n][] = $k.'_'.implode(',',$m):$arr[$n][] = $k.'_'.$m;
        }
    }
    foreach ($arr as $Item){
        $res[] =  implode('@',$Item);
    }
    return $res;
}


/**
 * 解析PC端筛选参数
 * @param unknown $search
 * @return unknown
 */
function analyticParams($search){
    if (isset($search)) {
        $parms = explode('@',$search);
        foreach ($parms as $m=>$vm){
            $parms[$m] = explode('_',$vm);
            if(strpos($parms[$m][1],',')){
                $data['filter'][str_replace('|','_',$parms[$m][0])] = explode(',',$parms[$m][1]);
            }else{
                //$data['filter'][$parms[$m][0]] = explode('-',$parms[$m][1]);
                $data['filter'][str_replace('|','_',$parms[$m][0])] = $parms[$m][1];
            }
        }
    }
    return isset($data)?$data:$data=[];
}

/**
 * 获取唯一随机数
 */
function getUniqid(){
    return uniqid();
}


/**
 * 跳转至get的url地址
 * @param unknown $url
 * @return unknown
 */
function goRedirectUrl($url=null){
    if(!empty(Yii::$app->request->get('redirectUrl'))){
        $userUrl = Yii::$app->request->get('redirectUrl');
    }else{
        $userUrl = $url;
    }
    return $userUrl;
}

/**
 * 获取当前完整地址URL
 * @return string
 */
function getThisUrl(){
    $url = Yii::$app->request->getHostInfo().Yii::$app->request->url;
    return $url;
}


/**
 * 获取渠道ID
 * @return number
 */
function getChannelId()
{
    return (int) Yii::$app->request->cookies->getValue('channel_id', 0);
}


/**
 * 根据IP获取相应城市信息
 * @param string $ip
 * @return unknown
 */
function getCityByIp($ip=''){
    if(empty($ip)) $ip = Yii::$app->request->getUserIP();
    //$ip = '58.22.127.255';
    $url = 'http://api.map.baidu.com/location/ip?ak=IpNPXco3ZMSaitpVOVnOg9ik&ip='.$ip.'&coor=bd09ll';
    $info = Mycurl(2, [], $url);
    if($info['status'] == "0"){
        $lotx = $info['content']['point']['y'];
        $loty = $info['content']['point']['x'];
        $citytemp = $info['content']['address_detail']['city'];
        $keywords = explode("市",$citytemp);
        $cityName = $keywords[0];
        $city['point'] = $loty.','.$lotx;
    }else{
        $cityName = '成都';
    }
    $city['city'] = City::find()->where(['like','name',$cityName])->andWhere(['active'=>1,'type'=>2])->asArray()->one();
    if(!empty($city['city'])){
        $city['pro'] = City::find()->where(['id'=>$city['city']['chief']])->andWhere(['active'=>1,'type'=>1])->asArray()->one();
    }
    return $city;
}


/**
 * @name 判断是否手机终端
 * @return boolean true 是  false 不是
 */
function is_mobile_request()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $_SERVER['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $_SERVER['HTTP_ACCEPT'] = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser=0;
    // But WP7 is also Windows, with a slightly different characteristic
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if($mobile_browser>0)
        return true;
    else
        return false;
}


/**
 * @name 判断是否是微信
 * @return boolean
 */
function is_weixin()
{
    if (isset($_SERVER['HTTP_USER_AGENT'])&&strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

/**
 * @name 判断是否淘钱宝APP，包括安卓和IOS
 * @return boolean
 */
function is_app(){
    if (!empty($_SERVER['HTTP_FRONT'])||Yii::$app->request->get('nav')=='0'){
        return true;
    }
    return false;
}


/**
 * @name 获取安卓和IOS版本
 * @return boolean
 */
function getAppVersion(){
    return isset($_SERVER['HTTP_VERSION'])?$_SERVER['HTTP_VERSION']:Yii::$app->request->get('version');
}


/**
 * @name 获取APP类型front
 * @return int
 */
function getAppFront(){
    return isset($_SERVER['HTTP_FRONT'])?$_SERVER['HTTP_FRONT']:(!empty($_GET['front'])?$_GET['front']:$_POST['front']);
}

/**
 * @name 获取用户类型 0普通用户 1经理
 * @return int
 */
function getUserType(){
    return isset($_SERVER['HTTP_TYPE'])?$_SERVER['HTTP_TYPE']:$_POST['type'];
}


/**
 * @name 数组转url字符链
 * @return string
 */
function arrToStrings($arr){
    $string = '';
    foreach ($arr as $k=>$Item){
        $string .= $k.'='.$Item.'&';
    }
    return substr($string,0,strlen($string)-1);
}

/**
 * @name 判断空，数据默认值
 * @return string
 */
function isEmpty($obj,$default = ''){
    return !empty($obj)?$obj:$default;
}

/**
 * @name 判断是否存在，空数据默认值
 * @return string
 */
function iSet($obj,$default = ''){
    return !isset($obj)?$obj:$default;
}


/**
 * @name 获取城市目录
 * @return string
 */
function getCityPath(){
    return strtolower(\Yii::$app->session->get('full_index'));
}


/**
 * @name 修改变量SEO配置
 * @return string
 */
function editSeo($rep,$pageConfig = '',$str = '{%$%}'){
    if(empty($pageConfig))$pageConfig = Yii::$app->params['pageConfig'][Yii::$app->controller->module->requestedRoute];
    foreach($pageConfig as $k=>$Item){
        $pageConfig[$k] = str_replace($str,$rep,$Item);
    }
    Yii::$app->params['webConfig'] = $pageConfig;
}




/*
 * 根据传入地区信息 查询对应经纬度
 */
// function cityApi($city){
//     $ch = curl_init();
//     $url = 'http://api.map.baidu.com/geocoder?address='.$city.'&output=json&key=IpNPXco3ZMSaitpVOVnOg9ik&city='.$city;
//
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     // 执行HTTP请求
//     curl_setopt($ch , CURLOPT_URL , $url);
//     $res = curl_exec($ch);
//
//    return json_decode($res,true);
// }
