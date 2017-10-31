<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/20
 * Time: 下午3:40
 */
namespace app\szcp\model;

use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class stuInfo extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'stu_info';
    public function index()
    {

    }

    public function isStu($stuNo)
    {
        if($this->where('stuNo',$stuNo)->select())
        {
            return true;
        }
        else
            return false;
    }

}