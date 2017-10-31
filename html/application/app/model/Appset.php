<?php

/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-23
 * Time: 上午9:35
 */
namespace app\app\model;

use think\Model;

class Appset extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'app_setting';


    public function getSemester()
    {
        $result = $this->where(['type'=>'semester'])->find();
        return $result['value'];
    }

    public function getSchoolYear()
    {
        $result = $this->where(['type'=>'schoolYear'])->find();
        return $result['value'];
    }


    public function getVersion()
    {
        $result = $this->where(['type'=>'version'])->find();
        return $result['value'];
    }

    public function getDownUrl()
    {
        $result = $this->where(['type'=>'app_url'])->find();
        return $result['value'];
    }

}