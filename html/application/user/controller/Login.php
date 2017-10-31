<?php
/**
 * Created by PhpStorm.
 * User: SuanCaiYu
 * Date: 17-7-8
 * Time: 上午10:34
 */

namespace app\user\controller;

use app\user\model\User;
use think\cache\driver\Redis;
use think\Db;

/**
 * Class Login
 * @package app\user\controller
 */
class Login
{
    public function index()
    {
        $data['phoneNum'] = input('get.phoneNumber/s');
        $data['timestamp'] = input('get.timestamp/d');
        $data['password'] = input('get.password/s');
        $data['device'] = input('get.device/s');
        $data['ip'] = request()->ip();
        $user = new User();
        return $user->login($data);
    }
}
