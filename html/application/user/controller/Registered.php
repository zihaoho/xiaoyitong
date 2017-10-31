<?php
/**
 * Created by PhpStorm.
 * User: SuanCaiYu
 * Date: 17-7-8
 * Time: 下午1:29
 */
namespace app\user\controller;

use app\user\model\User;
/**
 * Class Registered
 * @package app\user\controller
 */
class Registered
{
    public function index(){
        $data['phoneNum'] = input('get.phoneNumber/s');
        $data['timestamp'] = input('get.timestamp/d');
        $data['password'] = input('get.password/s');
        $data['code'] = input('get.code/s');
        $user = new User();
        return $user->registered($data);
    }
}