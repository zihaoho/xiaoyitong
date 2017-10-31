<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/30
 * Time: 上午11:20
 */

namespace app\user\controller;
header('content-type:text/html;charset=utf-8');

class Showinfo
{
    function showInfo()
    {
        $token = input('get.token/s');
        $userId = $this->getUserId($token);
        $re = new \app\user\model\Showinfo();
        $data = $re->showInfo($userId);
        if(is_null($data))
        {
            return returnInfo('用户还未上传信息','217');

        }
        $data['photoPath'] = 'http://47.92.82.112/' . 'public/UserPhoto' . DS.$data['photoPath'];
        $birthday = $data['birthday'];
        $data['age'] = $this->getAge($birthday);


        return returnInfo('用户信息','200',$data);
    }

    function getAge($birthday){
        $age = strtotime($birthday);
        if($age === false){
            return 0;
        }
        list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));
        $now = strtotime("now");
        list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));
        $age = $y2 - $y1;
        if((int)($m2.$d2) < (int)($m1.$d1))
            $age -= 1;
        return $age;
    }


    function getUserId($token)
    {
        $re = new \app\szcp\model\Token();
        $phoneNumber = $re->getPhoneNUmber($token);
        $re1 = new \app\szcp\model\User();
        $userId = $re1 ->getUserId($phoneNumber);
        return $userId;
    }
}