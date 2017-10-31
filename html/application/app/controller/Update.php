<?php

/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-23
 * Time: 上午9:31
 */


namespace app\app\controller;
use app\app\model\Appset;

class Update
{
    public function index()
    {
        $timestamp = input('get.timestamp/s');
        $appSet = new Appset();
        if(timestampValidate($timestamp))
        {

        }
        return returnInfo('手机时间错误',211,$appSet->getSemester());
    }
}