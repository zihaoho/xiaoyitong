<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use app\user\model\Token;
use think\cache\driver\Redis;

use think\Session;

/**
 * @param int $time
 * @return bool
 * 用于验证时间戳是否在15分钟内
 */
function timestampValidate($time=0){
    $curTimestamp = time();
    if(abs($curTimestamp - $time ) > 900)
    {
        return false;
    }
    return true;
}


function getStuNo($token)
{
    $re = new \app\szcp\model\Token();
    $phoneNumber = $re->getPhoneNUmber($token);
    $re1 = new \app\szcp\model\User();
    $userId = $re1 ->getUserId($phoneNumber);
    $re2 = new \app\szcp\model\Bind();
    if(!$re2->getStuNo($userId))
    {
        return '222';
    }
    return $re2->getStuNo($userId);
}

/**
 * @param $msg
 * @param $code
 * @param array $data
 * @return array
 */
function returnInfo($msg,$code,$data=array()){
    return array('msg'=>$msg,'code'=>$code,'data'=>$data);
}

/**
 * @param $token
 * @return bool
 */
function isLogin($token)
{
    $tokenModel = new Token();
    $count = $tokenModel->where(['token' => $token])->count();
    if($count > 0)
    {
        return true;
    }
    return false;
}


/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}
