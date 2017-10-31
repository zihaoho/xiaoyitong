<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午11:44
 */

namespace app\user\controller;


use app\user\model\User;

class Repwd
{
    public function index()
    {
        $data['phoneNum'] = input('get.phoneNumber/s');
        $data['timestamp'] = input('get.timestamp/d');
        $data['password'] = input('get.password/s');
        $data['code'] = input('get.code/s');
        $user = new User();
        return $user->forgetPwd($data);
    }
}