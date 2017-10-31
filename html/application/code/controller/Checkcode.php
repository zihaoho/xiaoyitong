<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:17
 */
namespace app\code\controller;

use app\code\model\Code;

class Checkcode
{
    public function index(){
        $data['mobile'] = input('get.phoneNumber/s');
        $data['tag'] = input('get.tag/s');
        $code = new Code();
        return $code->getCode($data);
    }
}