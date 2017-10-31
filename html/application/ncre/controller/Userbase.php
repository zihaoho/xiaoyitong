<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-15
 * Time: 下午1:30
 */

namespace app\ncre\controller;

use app\ncre\model\Userinfo;
use app\news\model\News;

class Userbase
{
    public function index()
    {
       $args['token'] = input('get.token/s');
        $userInfo = new Userinfo();
        return $userInfo->get_user_info($args);
    }
}