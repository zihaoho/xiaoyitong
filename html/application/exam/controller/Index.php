<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/29
 * Time: 下午6:55
 */
namespace app\exam\controller;

use app\app\model\Appset;
use app\exam\model\Examinfo;
use app\exam\model\Stuinfo;

class index
{
    public function index()
    {

    }

    public function getExamInfo()
    {
        $token = input('get.token/s');
        $schoolYear = input('get.schoolYear/s');
        $semester = input('get.semester/s');
        $re = new Appset();
        if(!isset($schoolYear))
        {
            $schoolYear = $re->getSemester();

        }
        if(!isset($semester))
        {
            $semester = $re->getSchoolYear();
        }

        $stuNO = getStuNo($token);
        $re =  new Examinfo();
        $examInfo = $re ->getExamInfo($stuNO,$schoolYear,$semester);
        $re1 = new Stuinfo();
        $data['examInfo'] = $examInfo;
        $data['stuName'] = $re1->getStuName($examInfo[0]['StuNo']);
        return returnInfo('考试信息','200',$data);
    }
}
