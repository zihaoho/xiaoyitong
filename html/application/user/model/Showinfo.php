<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/30
 * Time: 上午11:22
 */

namespace app\user\model;
header('content-type:text/html;charset=utf-8');

use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Showinfo extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_info';
    function showInfo($userId)
    {
        return $this->where('userId',$userId)->find();
    }
}