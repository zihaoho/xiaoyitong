<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/20
 * Time: 上午11:07
 */

namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Eventlist extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'szcp_list';
    function addList($data)
    {
        $this->insert($data);
    }

    function stuEvnet($stuId,$eventId)
    {
        $map['stuId'] = $stuId;
        $map['eventId'] = $eventId;
        return $this->where($map)->select();
    }
    //获取学生参加的活动列表
    function getEvents($stuNo)
    {

        return $this->where('stuId',$stuNo)->select();
    }
}
