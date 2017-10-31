<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午11:05
 */

namespace app\user\controller;


use think\Validate;

class Islogin
{
    public function index()
    {
        $data['token'] = input('get.token/s');
        $rule = [
            'token'  =>  'require|length:32',
        ];
        $msg = [
            'token.require' => 'token是必须的',
            'token.length' => 'token的长度必须为32位'
        ];

        $vali = new Validate($rule,$msg);
        if(!$vali->check($data))
        {
            return returnInfo($vali->getError(),210);
        }
        if(!isLogin($data['token']))
        {
            return returnInfo('查询成功',200,['result'=>'false']);
        }
        return returnInfo('查询成功',200,['result'=>'true']);
    }
}