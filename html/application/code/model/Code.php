<?php

/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:18
 */
namespace app\code\model;
use think\cache\driver\Redis;
use think\Loader;
use think\Model;

class Code extends Model
{
    public function getCode($data)
    {
        $vali = Loader::validate('Codeargs');
        if(!$vali->check($data)){
            return returnInfo($vali->getError(),210);
        }
        return $this->verificationCode($data['mobile'],$data['tag']);
    }


    /**
     * @param $phone
     * @param $tag
     * 生成短信验证码并发送
     */
    function verificationCode($phone,$tag){
        $redis = new Redis();
        if($redis->get($tag.$phone.'wait',0))
        {
            return returnInfo('验证短信发送间隔时间为60秒',221);
        }
        $appkey = 'c5cf0a9c75a5ec28';
        $mobile = $phone;
        $str = mt_rand(10000,99999);
        $content = '您的验证码为'.$str.',请勿向任何人透露您的验证码。【scy测试短信】';
        $url = "http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
        $result = juhecurl($url);
        $jsonarr = json_decode($result, true);
        if($jsonarr['status'] != 0)
        {
            return returnInfo($jsonarr['msg'],220);
        }
        $redis->set($tag.$phone,$str,600);
        $redis->set($tag.$phone.'wait',1,60);
        return returnInfo('短信发送成功',200,array('phoneNumber'=>$phone,'code'=>$str,'tag'=>$tag));
    }
}