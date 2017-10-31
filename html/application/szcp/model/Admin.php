<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/24
 * Time: 上午10:34
 */

namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Admin extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'szcp_admin';
    function index()
    {

    }


    function setAdmin($userId,$eventId)
    {
        $data['userId'] = $userId;
        $data['eventId'] = $eventId;
        return $this->insert($data);
    }

    function isAdmin($userId,$eventId)
    {
        $map['userId'] = $userId;
        $map['eventId'] = $eventId;
        return $this->where($map)->find();
    }
}