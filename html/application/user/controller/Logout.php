<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-23
 * Time: 上午9:17
 */

namespace app\user\controller;


use app\user\model\User;

class Logout
{
    public function index()
    {
        $token = input('get.token/s');
        $user = new User();
        return $user->logout($token);
    }
}