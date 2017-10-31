<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午1:42
 */

namespace app\ncre\controller;


use app\ncre\model\Examclass;

class Getclass
{
    function index()
    {
        $deptId = input('get.deptId/d');
        if($deptId == '')
        {
            return returnInfo('deptId参数是必须的',210);
        }
        $eclass = new Examclass();
        return $eclass->get_class($deptId);
    }
}