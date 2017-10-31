<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-13
 * Time: 下午4:26
 */
namespace app\user\model;
use think\Db;
use think\Loader;
use think\Model;
use think\Session;
use think\cache\driver\Redis;
use think\Validate;

/**
 * Class User
 * @package app\user\model\
 * 用户操作类
 */
class Token extends Model
{
	protected $connection = 'db_config1';
    protected $table = 'user_auth';
    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化

    }

    public function token_check($token)
    {
        $rule = [
            'token' => 'length:32|require',
        ];
        $msg = [
            'token.length' => 'token必须不少于32位',
            'token.require' => 'token是必须的'
        ];
        $data['token']=$token;
        $vali = new Validate($rule,$msg);
        if(!$vali->check($data))
        {
            return returnInfo($vali->getError(),210);
        }
        return returnInfo('',200);
    }

    public function get_userId($token)
    {
        if(!isLogin($token))
        {
            return returnInfo('用户未登录',0);
        }
        $result = Db::connect('db_config1')
            ->view('user_auth','mobile')
            ->view('user_user','id','user_user.mobile = user_auth.mobile')
            ->where(['user_auth.token'=>$token])
            ->find();
        return returnInfo('',1,array('user_id'=>$result['id']));
    }
}

