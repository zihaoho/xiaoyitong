<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/20
 * Time: 下午5:11
 */
namespace app\szcp\controller;
//获取"我的活动"列表
class Myevents
{
    public function index()
    {

    }

    public function getMyEvents()
    {
        $token =  input('get.token');
//        $re = new \app\szcp\model\Token();
//        $phoneNumber = $re->getPhoneNUmber($token);
//        $re = new  \app\szcp\model\User();
//        //通过电话号码获取用户的userid
//        $userId = $re->getUserId($phoneNumber);
//        //通过userid去绑定表获取用户的学号
//        $re = new \app\szcp\model\Bind();
//        //如果没有绑定，也就是校外人员，就不能使用素质测评模块
//        if(!$re->getStuNo($userId))
//        {
//            return returnInfo('该用户还未绑定未学生','222');
//        }

        if(getStuNo($token) == '222')
        {
            returnInfo('该用户还未绑定学生','222');
        }
        $stuNo = getStuNo($token);

        $rest = new \app\szcp\model\Eventlist();
        //获得该学生参加的活动列表
        $data = $rest->getEvents($stuNo);
        $stuEventsCount = count($data);
        if ($stuEventsCount == 0)
        {
            $states['stateCode'] = '219';
            return $states;
        }
        for ($i =0;$i<$stuEventsCount;$i++)
        {
            $eventId = $data[$i]['eventId'];
            $rest2 = new \app\szcp\model\Release();
            $list[$i] = $rest2->getEvent($eventId,$stuNo);
        }
        $states['list'] = $list;
        return returnInfo('我的所有活动','200',$states);
    }
    //活动所有的活动列表
    function getAllEvents()
    {
        $re = new \app\szcp\model\Release();
        $states['list'] = $re->getAllEvents();
        return returnInfo('所有的活动列表：','200',$states);
    }


//获取制定类型的活动列表
    function getEventType()
    {
        $eventType = input('get.eventType/s');
        $re = new \app\szcp\model\Release();
        return returnInfo('活动列表','200',$re->getEventType($eventType));
    }

    function getEventState()
    {
        $eventState = input('get.state/s');
        $re = new \app\szcp\model\Release();
        return returnInfo('活动列表','200',$re->getEventState($eventState));
    }

    function getEventDetails()
    {
        $eventId = input('get.eventId/s');
        $re =new \app\szcp\model\Release();
        $states['eventDetails']  = $re ->getEventDetails($eventId);
        return returnInfo('活动详细信息','200',$states);
    }


}