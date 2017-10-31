<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-15
 * Time: 下午1:41
 */

namespace app\ncre\model;


use think\Cache;
use think\Db;
use think\Session;
use think\Validate;

class Userinfo
{
    public function get_user_info($data)
    {
        $relu = [
            'token' => 'require|length:32'
        ];

        $msg = [
            'token.require' => 'token是必须的',
            'token.length' => 'token格式错误'
        ];

        $vali = new Validate($relu,$msg);

        if(!$vali->check($data))
        {
            return returnInfo($vali->getError(),210);
        }

        if(!isLogin($data['token']))
        {
            return returnInfo('该用户未登录',218);
        }


        $result = Db::connect('db_config1')
            ->view('xyt_token','phoneNum')
            ->view('xyt_user','studentId','xyt_user.mobile = xyt_token.phoneNum')
            ->view('xyt_studentinfo','StuName,StuClass,StuIDCard,StuTelephone,StuEmail,StuNationa,StuDept,StuGender','xyt_user.studentId = xyt_studentinfo.stuNum')
            ->where(['xyt_token.token' => $data['token']])
            ->select();

        if(count($result)>0)
        {
            $idCard = $result[0]['StuIDCard'];
            $photoPath = '';
            $exts = ['.jpg','.jpeg','.png'];
            foreach ($exts as $ext)
            {
                $photoPath = '/public/static/ncre/photos/'.substr($idCard,0,6).'/'.$idCard.$ext;
                if(is_file(ROOT_PATH.$photoPath))
                {break;}
            }
            $result[0]['photo'] = $photoPath;
            return returnInfo('查询成功',200,$result[0]);
        }
        return returnInfo('未找到该用户数据',217);
    }
}