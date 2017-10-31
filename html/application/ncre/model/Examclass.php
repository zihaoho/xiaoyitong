<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午1:43
 */

namespace app\ncre\model;


use think\Model;

class Examclass extends  Model
{
    protected $connection = 'db_config2';
    protected $table = 'exam_class';

    public function get_class($deptId)
    {
        $result = $this->where(['deptId' => $deptId])->select();
        if(count($result) < 1)
        {
            return returnInfo('数据查询失败',217);
        }
        $items = [];
        foreach ($result as $item)
        {
            $items[] = ['value'=>$item['id'],'text'=>$item['clsName']];
        }
        return returnInfo('查询成功',200,$items);
    }
}