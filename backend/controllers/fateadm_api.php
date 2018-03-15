<?php 
	function GetSign($usr_id, $usr_key, $timestamp){
		$chk_sign1 	= md5( $timestamp . $usr_key);
		$chk_sign2	= md5( $usr_id . $timestamp . $chk_sign1);
		return $chk_sign2;
	}
    function GetCardSign($cardid, $cardkey, $timestamp, $usrkey){
		$sign = md5( $usrkey . $timestamp . $cardid . $cardkey);
        return $sign;
    }
	function Post($url, $post_data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);	//设置本机的post请求超时时间
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	function ArrayToPostData( $data){
		$post_data 		= "";
		$first_flag 	= true;
		foreach( $data as $key => $val){
			if( $first_flag == true){
				$first_flag = false;
			}else{
				$post_data = $post_data . "&";
			}
			$post_data = $post_data . $key . "=" . $val;
		}
		return $post_data;
	}

	class FateadmAPI{
        function __construct( $app_id, $app_key, $usr_id, $usr_key){
            $this->app_id   = $app_id;
            $this->app_key  = $app_key;
            $this->usr_id   = $usr_id;
            $this->usr_key  = $usr_key;
            $this->host     = "http://pred.fateadm.com";
        }

        function SetHost($url){
            $this->host     = $url;
        }

        function PFunc(){
            echo "appid: " . $this->app_id . "\n";
            echo "appkey: " . $this->app_key . "\n";
            echo "usr_id: " . $this->usr_id . "\n";
            echo "usr_key: " . $this->usr_key . "\n";
        }
        function Predict($predict_type, $img_data){
            $timestamp 		= time();
            $sign 			= GetSign( $this->usr_id, $this->usr_key, $timestamp);
            $data 			= array(
                'user_id' => $this->usr_id,
                'timestamp' => $timestamp,
                'sign' => $sign,
                'predict_type' => $predict_type,
                'img_data' => $img_data,
            );
            if( $name == ""){
                $asing      = GetSign( $this->app_id, $this->app_key,  $timestamp);
                $data["appid"]  = $this->app_id;
                $data["asign"]  = $this->asign;
            }
            $url 			= $this->host . "/api/capreg";
            $post_data		= ArrayToPostData($data);
            $rsp 			= Post($url, $post_data);
            $json_rsp 		= json_decode( $rsp);
            if( $json_rsp->RetCode == 0){
                $result 			= json_decode($json_rsp->RspData);
                $json_rsp->rsp 		= $result;
            }
            return $json_rsp;
        }
        function Justice($request_id){
            $timestamp 	= time();
            $sign 		= GetSign( $this->usr_id, $this->usr_key, $timestamp); 
            $data 	= array(
                'user_id' => $this->usr_id,
                'timestamp'=> $timestamp,
                'sign' => $sign,
                'request_id' => $request_id,
            );
            $url 		= $this->host . "/api/capjust";
            $post_data 	= ArrayToPostData($data);
            $rsp 		= Post($url, $post_data);
            $json_rsp 	= json_decode( $rsp);
            return $json_rsp;
        }
	    function QueryBalanc(){
    		$timestamp 	= time();
    		$sign 		= GetSign( $this->usr_id, $this->usr_key, $timestamp); 
    		$data 	= array(
    			'user_id' => $this->usr_id,
    			'timestamp'=> $timestamp,
    			'sign' => $sign,
    			);
    		$url 		= $this->host . "/api/custval";
    		$post_data 	= ArrayToPostData($data);
    		$rsp 		= Post($url, $post_data);
    		$json_rsp 	= json_decode( $rsp);
    		return $json_rsp;
    	}
        function Charge($cardid, $cardkey){
            $timestamp 		= time();
            $sign 			= GetSign( $this->usr_id, $this->usr_key, $timestamp);
            $csign          = GetCardSign( $cardid, $cardkey, $timestamp, $this->usr_key);
    		$data 	= array(
    			'user_id' => $this->usr_id,
    			'timestamp'=> $timestamp,
    			'sign' => $sign,
                'cardid' => $cardid,
                'csign' => $csign,
    			);
    		$url 		= $this->host . "/api/charge";
    		$post_data 	= ArrayToPostData($data);
    		$rsp 		= Post($url, $post_data);
    		$json_rsp 	= json_decode( $rsp);
    		return $json_rsp;
        }
        function RTT($predict_type){
            $timestamp 		= time();
            $sign 			= GetSign( $this->usr_id, $this->usr_key, $timestamp);
            $data 			= array(
                'user_id' => $this->usr_id,
                'timestamp' => $timestamp,
                'sign' => $sign,
                'predict_type' => $predict_type,
            );
            if( $name == ""){
                $asing      = GetSign( $this->app_id, $this->app_key,  $timestamp);
                $data["appid"]  = $this->app_id;
                $data["asign"]  = $this->asign;
            }
            $url 			= $this->host . "/api/qcrtt";
            $post_data		= ArrayToPostData($data);
            $rsp 			= Post($url, $post_data);
            $json_rsp 		= json_decode( $rsp);
            if( $json_rsp->RetCode == 0){
                $result 			= json_decode($json_rsp->RspData);
                $json_rsp->rsp 		= $result;
            }
            return $json_rsp;
        }

	}

    function Test(){
        //开发者appid&key
        $app_id 		= 100001;
        $app_key 		= "123456";
        //pd账号id&key
        $usr_id 		= 100000;
        $usr_key 		= "123456";

        $api            = new FateadmApi($app_id, $app_key, $usr_id, $usr_key);
        //$api->PFunc();

        // 查询余额
        $rsp            = $api->QueryBalanc();
        var_dump( "<br>query balc result: ", $rsp);

        // 识别验证码
        $file_name 		= "3ypqyh.jpg";
        $predict_type 	= 100010018;
        $img_data 		= urlencode(base64_encode( file_get_contents($file_name)));
        $rsp            = $api->Predict($predict_type, $img_data);
        var_dump( "<br>predict result: ", $rsp);

        // 识别错误时，进行退款 
        $jflag          = false;
        if( $jflag == true && $rsp->RetCode == 0){
            $request_id = $rsp->RequestId;
            $rsp        = $api->Justice($request_id);
            var_dump( "<br>justice result: ", $rsp);
        }

        // 用户可以直接用充值卡充值
        $cardid         = "08167103";
        $cardkey        = "dfcea31eff83";
        $rsp            = $api->Charge( $cardid, $cardkey);
        var_dump( "<br>charge result: ", $rsp);

        // 可以查询网络服务状况
        //$rsp            = $api->RTT(100010018);
        //var_dump( "<br>rtt result: ", $rsp);
    }
    Test();
?>
