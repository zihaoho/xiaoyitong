<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/20
 * Time: 上午11:06
 */

namespace app\szcp\controller;

//存储参与活动的信息
class EventList
{
    public function index()
    {
        $token =  input('get.token');
        if(getStuNo($token) == '222')
        {
            returnInfo('该用户还未绑定学生','222');
        }

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
//            $states['stateCode'] = '222';
//            return $states;
//        }
        $stuNo = getStuNo($token);
        $data['stuId'] = $stuNo;
        $data['eventId'] = input('get.eventId');
        $data['signTime'] = input('get.signTime');
        $data['getScore'] = input('get.getScore');

        //判断获取到的学号和活动id是否有效
        if(!($this->isStu($data['stuId']) && $this->isEvent($data['eventId'])))
        {
            return returnInfo('学生不存在或活动不存在','210');
        }
        // 判断学生是否重复签到
        if($this->stuEvent($data['stuId'],$data['eventId'])) {
            return returnInfo('请勿重复签到','215');
        }
        $rest = new \app\szcp\model\Eventlist();
        if (!$rest->addList($data))
        {
            return returnInfo('签到成功','200');
        }
        return returnInfo('签到失败','215');
    }
//查询是否有此学生
    public function isStu($stuNo)
    {
        $rest = new \app\szcp\model\stuInfo();
        return $rest->isStu($stuNo);
    }
//查询是否有此活动
    public function isEvent($eventId)
    {
        $rest = new \app\szcp\model\Release();
        return $rest->isEvent($eventId);
    }
    //判断学生是否重复签到
    public function stuEvent($stuId,$eventId)
    {
        $rest = new \app\szcp\model\Eventlist();
        if($rest->stuEvnet($stuId,$eventId))
        {
            return true;
        }
        else
            return false;
    }
}