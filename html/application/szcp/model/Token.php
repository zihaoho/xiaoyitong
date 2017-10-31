<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/21
 * Time: 下午1:44
 */
namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class  Token extends Model
{

    protected $connection = 'db_config1';
    protected $table = 'user_auth';
    function index()
    {

    }

    function getPhoneNUmber($token)
    {
        return $this->where('token',$token)->find()['mobile'];
    }
}