<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:44
 */

namespace app\user\controller;


use app\user\model\User;

class Bind
{
    public function index()
    {
        $data['token'] = input('get.token/s');
        $data['StuNo'] = input('get.StuNo/s');
        $data['idcard'] = input('get.idcard/s');
        $bind = new User();
        return $bind->userBind($data);
    }
}