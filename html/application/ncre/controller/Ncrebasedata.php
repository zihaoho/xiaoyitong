<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 上午10:33
 */
namespace app\ncre\controller;

use app\ncre\model\BaseData;
use app\ncre\model\Dept;
use app\ncre\model\Examinfo;
use app\ncre\model\Level;
use think\Cache;
use think\cache\driver\Redis;
use think\Db;

/**
 * Class NcreBaseData
 * @package app\ncre\controller
 * 二级基础信息获取
 */
class NcreBaseData
{
    public function index()
    {
        $result = Cache::get('ncre_basedata','');
        if($result != '')
        {
            return returnInfo('查询成功',200,$result);
        }
        $baseData = new BaseData();
        $dept = new Dept();
        $exam = new Examinfo();
        $level = new Level();
        $result = $baseData->baseData();
        $result['dept'] = $dept->get_dept();
        $result['exam'] = $exam->get_info();
        $result['level'] = $level->get_level();
        Cache::set('ncre_basedata',$result,5400);
        return returnInfo('查询成功',200,$result);
    }
}
