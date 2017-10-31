<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/8/1
 * Time: 上午10:49
 */

namespace app\exam\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;
class Stuinfo extends Model
{

    protected $connection = 'db_config1';
    protected $table = 'stu_info';

    function getStuName($stuNo)
    {
        return $this->where('stuNo',$stuNo)->find()['name'];
    }
}