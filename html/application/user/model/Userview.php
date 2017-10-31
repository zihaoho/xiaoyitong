<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 下午7:09
 */

namespace app\user\model;


use think\Db;

class Userview
{
    public function getInfo($token)
    {
        $result = Db::connect('db_config1')
            ->view('user_auth','ip,token,device,mobile')
            ->view('user_user','username,email,idcard,header_img','user_user.mobile = user_auth.mobile')
            ->view('user_bind','StuNo,user_id','user_bind.user_id = user_user.id')
            ->where(['user_auth.token' => $token])
            ->select();
        if(count($result)>0)
        {
            return $result[0];
        }
        else
        {
            return 0;
        }
    }
}