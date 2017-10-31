<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 上午10:33
 */
namespace app\ncre\model;
use think\Loader;
use think\Model;
use think\Session;
use think\cache\driver\Redis;
/**
 * Class BaseData
 * @package app\user\model\
 * 二级考试基础信息
 */
class BaseData extends Model
{
    protected $connection = 'db_config2';
    protected $table = 'sys_basedata';


    function get_items($item)
    {
        $map['keyType'] = $item;
        $nations = $this->where($map)->select();
        $items = [];
        foreach ($nations as $nation) {
            $items[]  = ['value'=>$nation['keyCode'],'text'=>$nation['keyDescription']];
        }
        return $items;
    }


    public function baseData()
    {
        $items = ['nation','education','carrera','sex'];
        $result = [];
        foreach ($items as $item)
        {
            $result[$item] = $this->get_items($item);
        }
        return $result;
    }
}
