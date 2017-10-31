<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/16
 * Time: 下午1:56
 */


namespace app\szcp\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Release extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'szcp_info';
    function test($data)
    {
        return $this->insert($data);
    }

    public function getEventType($eventType)
    {
        return $this->where('eventType',$eventType)->select();
    }

    public function getEventState($state)
    {
        return $this->where('eventState',$state)->select();
    }


    //查询活动是否存在 存在返回ture 不存在返回false
    public function isEvent($eventId)
    {
        if($this->where('id',$eventId)->select())
        {
            return true;
        }
        else
            return false;
    }
    public function getEvent($eventId,$stuNo)
    {
        $data = $this->where('id', $eventId)->find();
        $event['stuNo'] = $stuNo;
        $event['eventName'] = $data['eventName'];
        $event['eventId'] = $data['id'];
        $event['eventState'] = $data['eventState'];
        $event['eventScore'] = $data['eventScore'];
        $event['eventType'] = $data['eventType'];
        $event['eventStartTime'] = $data['eventStartTime'];
        $event['eventEndTime'] = $data['eventEndTime'];
        return $event;
    }

    function getAllEvents()
    {
        $data =  $this->select();
        $countEvents =  count($data);
        for ($i = 0;$i<$countEvents;$i++)
        {
            $event[$i]['eventName'] = $data[$i]['eventName'];
            $event[$i]['eventId'] = $data[$i]['id'];
            $event[$i]['eventState'] = $data[$i]['eventState'];
            $event[$i]['eventScore'] = $data[$i]['eventScore'];
            $event[$i]['eventStartTime'] = $data[$i]['eventStartTime'];
            $event[$i]['eventType'] = $data[$i]['eventType'];
            $event[$i]['eventEndTime'] = $data[$i]['eventEndTime'];
        }
        return $event;
    }

    function getEventDetails($eventId)
    {
        return $this->where('id',$eventId)->find();
    }


    function getEventId($eventName)
    {
        return $this->where('eventName',$eventName)->find()['id'];
    }

    function hadEvent($eventName)
    {
        return $this->where('eventName',$eventName)->find();
    }
}