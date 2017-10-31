<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 下午5:21
 */

namespace app\user\controller;


use app\user\model\Userbind;

class Isbind
{
    public function index()
    {
       $data['token'] = input('get.token/s');
       $bind = new Userbind();
       return $bind->isBind($data);
    }
}