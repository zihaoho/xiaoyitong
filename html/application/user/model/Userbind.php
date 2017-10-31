<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:54
 */

namespace app\user\model;


use think\Db;
use think\Model;
use think\Validate;

class Userbind extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_bind';
    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化

    }


    public function isBind($data)
    {
        $rule = [
            'token' => 'length:32|require',
        ];
        $msg = [
            'token.length' => 'token必须不少于32位',
            'token.require' => 'token是必须的'
        ];

        $vali = new Validate($rule,$msg);
        if(!$vali->check($data))
        {
            return returnInfo($vali->getError(),210);
        }

        $user = new Userview();

        $result = $user->getInfo($data['token']);
        if(!$result['StuNo']){
            return returnInfo('该用户未绑定',200,array('result'=>'false'));

        }
        return returnInfo('该用户已绑定',200,array('result'=>'true','StuNo' => $result['StuNo']));
    }
}