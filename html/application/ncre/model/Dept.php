<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午12:50
 */

namespace app\ncre\model;

use think\Model;

/**
 * Class Dept
 * @package app\ncre\model
 * 获取系部信息
 */
class Dept extends Model
{
    protected $connection = 'db_config2';
    protected $table = 'exam_dept';

    public function get_dept()
    {
        $depts = $this->select();
        $items = [];
        foreach($depts as $dept)
        {
            $items[] = ['value'=>$dept['id'],'text'=>$dept['deptName']];
        }
        return $items;
    }
}