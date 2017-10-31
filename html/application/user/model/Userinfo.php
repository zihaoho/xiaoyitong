<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/30
 * Time: 上午10:45
 */

namespace app\user\model;

use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;


class Userinfo extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_info';
    function savePhoto($userId,$path)
    {
        if(!$this->where('userId',$userId)->find())
        {
            $data['userId'] = $userId;
            $data['photoPath'] = $path;
            return $this->insert($data);
        }
        else
        {
           return $this->where('userId',$userId)->setField('photoPath',$path);
        }
    }

    function savePickName($userId,$pickName)
    {
        if(!$this->where('userId',$userId)->find())
        {
            $data['userId'] = $userId;
            $data['pickName'] = $pickName;
            return $this->insert($data);
        }
        else{
            return $this->where('userId',$userId)->setField('pickName',$pickName);
        }
    }

    function saveGender($userId,$gender)
    {
        if(!$this->where('userId',$userId)->find())
        {
            $data['userId'] = $userId;
            $data['gender'] = $gender;
            return $this->insert($data);
        }
        else{
            return $this->where('userId',$userId)->setField('gender',$gender);
        }
    }

    function saveBirthday($userId,$birthday)
    {
        if(!$this->where('userId',$userId)->find())
        {
            $data['userId'] = $userId;
            $data['birthday'] = $birthday;
            return $this->insert($data);
        }
        else{
            return $this->where('userId',$userId)->setField('birthday',$birthday);
        }
    }


    function saveIntroduce($userId,$introduce)
    {

        if(!$this->where('userId',$userId)->find())
        {
            $data['userId'] = $userId;
            $data['introduce'] = $introduce;
            echo $data['userId'];
            echo $data['introduce'];
            return $this->insert($data);
        }
        else{
            return $this->where('userId',$userId)->update(['introduce' => $introduce]);
        }
    }

}