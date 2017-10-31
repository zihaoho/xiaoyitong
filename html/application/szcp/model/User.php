<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/21
 * Time: 下午1:52
 */
namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class User extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_user';
    function index()
    {

    }
    function getUserId($phoneNumber)
    {
        return $this->where('mobile',$phoneNumber)->find()['id'];
    }
    function userNameGetUserId($userName)
    {
        return $this->where('username',$userName)->find()['id'];
    }
}