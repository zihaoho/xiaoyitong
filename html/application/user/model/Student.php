<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:51
 */

namespace app\user\model;


use think\Db;
use think\Model;

class Student extends  Model
{
    protected $connection = 'db_config1';
    protected $table = 'stu_info';
    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化

    }

    public function get_stu_info($StuNo)
    {
        $result = Db::connect('db_config1')
            ->view('stu_info','bankCard,idcard,phoneNumber,email,StuNo,nativePlace,ticket,name,nation')
            ->view('stu_info_class',['value'=>'class'],'stu_info.class = stu_info_class.id')
            ->view('stu_info_profession',['value' => 'profession'],'stu_info_profession.id = stu_info.profession')
            ->view('stu_info_dept',['value' => 'dept'],'stu_info_profession.deptId = stu_info_dept.id')
            ->where(['stu_info.StuNo' => $StuNo])
            ->find();

        if($result['nation'] != null)
        {
            $nation = Db::connect('db_config1')
                ->table('stu_info_basedata')
                ->where(['type' => 'nation','keyCode'=>$result['nation']])
                ->find();
            $result['nation'] = $nation['value'];
        }
        return $result;
    }
}