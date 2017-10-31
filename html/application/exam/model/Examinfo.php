<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/7/29
 * Time: 下午6:58
 */

namespace app\exam\model;
use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

class Examinfo extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'stu_test';

    function getExamInfo($stuNo,$schoolYear,$semester)
    {
        $map['schoolYear'] = $schoolYear;
        $map['semester'] = $semester;
        $map['StuNo'] = $stuNo;
        return $this->where($map)->select();
    }
}