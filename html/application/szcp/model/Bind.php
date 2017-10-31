<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/21
 * Time: 下午6:22
 */

namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Bind extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_bind';
    function index()
    {

    }

    function getStuNo($userId)
    {
        return $this->where('user_id',$userId)->find()['StuNo'];
    }
}