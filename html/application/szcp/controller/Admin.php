<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/24
 * Time: 上午10:15
 */

//管理员操作
namespace app\szcp\controller;
use app\szcp\model\Token;
use app\szcp\model\User;

class Admin
{
    function index()
    {

    }
    //判断用户是否是该测评活动的管理员  需要参数1.用户token 2.活动id
    function isAdmin()
    {
        $token = input('get.token/s');
        $eventName = input('get.eventName/s');
        $re = new Token();
        $phoneNUmber = $re->getPhoneNUmber($token);
        //获取到手机号之后，获取userid  查看是否为管理员
        $us = new User();
        $userId = $us->getUserId($phoneNUmber);
        $re1 = new \app\szcp\model\Release();
        $eventId =  $re1->getEventId($eventName);
        $re2 = new \app\szcp\model\Admin();
        if(!$re2->isAdmin($userId,$eventId))
        {
            return returnInfo('该用户不是该活动的管理员','217');
        }
        return returnInfo('该用户是管理员','200');
    }


    function adminLogin()
    {

    }
}