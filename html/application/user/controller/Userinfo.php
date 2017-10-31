<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/30
 * Time: 上午10:02
 */
namespace app\user\controller;
use app\user\model\User;
use think\Request;
header('content-type:text/html;charset=utf-8');
class  Userinfo
{
    public function upload()
    {

        $token = input('post.token/s');
        $userId = $this->getUserId($token);
        $file = request()->file('img');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'UserPhoto');
        if(!file_exists(ROOT_PATH.'public'.DS.'UserPhoto'))
        {
            mkdir(ROOT_PATH.'public'.DS.'UserPhoto');
        }
        if($info)
        {
            $path =  $info->getSaveName();
            $re = new \app\user\model\Userinfo();
            if($re->savePhoto($userId,$path))
            {
                return returnInfo('头像上传成功','200');
            }
            return returnInfo('头像上传失败','215');
        }
        else
        {
            return returnInfo('上传失败',$file->getError());
        }

    }

    function savePickName()
    {
        $token = input('get.token/s');
        $userId = $this->getUserId($token);
        $pickName = input('get.pickName/s');
        $re = new \app\user\model\Userinfo();
        if($re->savePickName($userId,$pickName))
        {
            return returnInfo('用户名修改成功','200');
        }
        return returnInfo('用户名修改失败','215');
    }

    function saveIntroduce()
    {


        $token = input('get.token/s');
        $userId = $this->getUserId($token);
        $introduce = input('get.introduce/s');
        $re = new \app\user\model\Userinfo();
        if($re->saveIntroduce($userId,$introduce))
        {
            return returnInfo('签名修改成功','200');
        }
        return returnInfo('签名修改失败','215');

    }

    function savaGender()
    {
        $token = input('get.token/s');
        $userId = $this->getUserId($token);
        $gender = input('gender/s');
        $re = new \app\user\model\Userinfo();

        if($re->saveGender($userId,$gender))
        {
            return returnInfo('保存成功','200');
        }
        return returnInfo('保存失败','215');
    }


    function saveBirthday()
    {
        $token = input('get.token/s');
        $userId = $this->getUserId($token);
        $birthday = input('get.birthday/s');
        $re = new \app\user\model\Userinfo();

        if($re->saveBirthday($userId,$birthday))
        {
            return returnInfo('保存成功','200');
        }
        return returnInfo('保存失败','215');
    }




    function getUserId($token)
    {
        $re = new \app\szcp\model\Token();
        $phoneNumber = $re->getPhoneNUmber($token);
        $re1 = new \app\szcp\model\User();
        $userId = $re1 ->getUserId($phoneNumber);
        return $userId;
    }

}