<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/16
 * Time: 下午1:57
 */

namespace app\szcp\controller;

use app\szcp\model\Token;
use app\szcp\model\User;

class Release
{
    public function index()
    {
        $data['eventName'] = input('post.eventName/s');
        $data['eventStartTime'] = input('post.eventStartTime/s');
        $data['eventEndTime'] = input('post.eventEndTime/s');
        $data['eventPlace'] = input('post.eventPlace/s');
        $data['eventScore'] = input('post.eventScore/s');
        $data['eventDescribe'] = input('post.eventDescribe/s');
        $data['eventContent'] = input('post.eventContent/s');
        $data['eventType'] = input('post.eventType/s');
        $data['peopleNumber'] = input('post.peopleNumber/s');
        $data['eventBackgrounds'] = input('post.eventBackgrounds/s');
        $data['eventState'] = input('post.eventState/s');
        $data['eventProject'] = input('post.eventProject/s');
        $data['eventCompany'] = input('post.eventCompany/s');
        $data['eventCategory'] = input('post.eventCategory/s');
        $data['eventProcess'] = input('post.eventProcess/s');
        $data['eventExplain'] = input('post.eventExplain/s');
        $data['schoolYear'] = input('post.schoolYear/s');
        //这里还需要传入一个username 获取到用户id  然后把该用户作为该活动的默认管理员
        $username = input('post.username/s');
        $getid = new User();
        $userId=$getid->userNameGetUserId($username);


        $rease = new \app\szcp\model\Release();
        //写入的时候要保证eventName不能同名。
        if($rease->hadEvent($data['eventName']))
        {
            return returnInfo('已经有同名的活动名称','215');
        }

        if($rease->test($data))
        {
            //发布成功之后获取该活动的活动id
            $eventId = $rease->getEventId($data['eventName']);
            //将该用户设置为该活动的管理员
            $ad = new \app\szcp\model\Admin();
            if($ad->setAdmin($userId,$eventId))
            {
                return returnInfo('发布成功','200');
            }
            else
            {
                return returnInfo('发布失败','215');
            }

        }
        else{
            return returnInfo('发布失败','215');
        }

    }


}